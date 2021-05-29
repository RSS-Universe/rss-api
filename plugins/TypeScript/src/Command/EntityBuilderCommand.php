<?php
declare(strict_types=1);

namespace TypeScript\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Console\Exception\ConsoleException;
use Cake\Core\Configure;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * EntityBuilder command.
 */
class EntityBuilderCommand extends Command
{
    /**
     * @var Arguments
     */
    protected $args;

    /**
     * @var ConsoleIo
     */
    protected $io;

    /**
     * @var Table[]
     */
    protected $models;

    /**
     * @var string
     */
    protected $file_path;

    protected function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser = parent::buildOptionParser($parser);
        $parser->addOption('orm', [
            'default' => false,
            'boolean' => true,
        ]);
        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param Arguments $args The command arguments.
     * @param ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->args = $args;
        $this->io = $io;
        $this->file_path = Configure::readOrFail('TypeScript.path');
        $this->loadModels();
        $buildOrm = $args->getOption('orm');
        return $buildOrm
            ? $this->createTypeOrmFiles()
            : $this->createInterfaceFile();
    }

    protected function getAppModelNames(): array
    {
        $tables = glob(APP . "Model" . DS . "Table" . DS . "*Table.php");
        $tablesNames = [];
        foreach ($tables as $name) {
            $item = explode('Table.php', basename($name));
            $tablesNames[] = $item[0];
        }
        return $tablesNames;
    }

    protected function loadModels()
    {
        $classes = Configure::read('TypeScript.models', []);
        if ($classes === true) {
            $classes = $this->getAppModelNames();
        }
        foreach ($classes as $class) {
            $model = TableRegistry::getTableLocator()->get($class);
            $this->models[$model->getAlias()] = $model;
        }
    }

    protected function createInterfaceFile()
    {
        $entities = $this->buildEntities();
        $str = $this->buildInterfaces($entities);
        file_put_contents($this->file_path, $str);
    }

    protected function createTypeOrmFiles()
    {
        $parts = explode('.', $this->file_path);
        array_pop($parts);

        $dir = implode('.', $parts) . DS;
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $entities = \collection($this->buildEntities())
            ->filter(function ($data) {
                return array_key_exists('id', $data);
            })
            ->toArray();
        foreach ($entities as $name => $props) {
            $str = $this->buildTypeOrmClass($name, $props);
            file_put_contents($dir . $name . '.ts', $str);
        }
    }

    protected function buildTypeOrmClass(string $name, array $props): string
    {
        $str = "import { Column, Entity, PrimaryColumn } from 'typeorm/browser';\n\n";
        $str .= "@Entity()\n";
        $str .= "export class {$name} {";
        foreach ($props as $prop_name => $prop_data) {
            $str .= "\n\t";
            if ($prop_name === 'id') {
                $str .= '@PrimaryColumn()';
            } elseif (array_key_exists('orm', $prop_data)) {
                $str .= '@Column({ ';
                $str .= "type: '" . $prop_data['orm'] . "',";
                $str .= $prop_data['optional'] ? 'nullable: true, default: null' : 'nullable: false';
                $str .= '})';
            }
            $str .= "\n\t";
            $str .= $prop_name;
            $str .= $prop_data['optional'] ? '?: ' : '!: ';
            $str .= $prop_data['type'] . ';';
            $str .= "\n";
        }
        $str .= "\n}\n\n";

        return $str;
    }

    protected function buildInterfaces(array $entities): string
    {
        $str = '';
        foreach ($entities as $name => $props) {
            $str .= "export interface {$name} {";
            foreach ($props as $prop_name => $prop_data) {
                $str .= "\n\t" . $prop_name;
                $str .= $prop_data['optional'] ? '?: ' : ': ';
                $str .= $prop_data['type'] . ';';
            }
            $str .= "\n}\n\n";
        }

        return $str;
    }

    /**
     * @return array
     */
    protected function buildEntities(): array
    {
        $entities = $this->buildPaginationData();
        foreach ($this->models as $name => $table) {
            $entities[$this->classnameToEntityName($table->getAlias())] = $this->buildEntityData($table);
            $entities[$table->getAlias() . 'List'] = [
                'success' => ['type' => 'boolean', 'optional' => false],
                'pagination' => ['type' => $this->getPaginationEntityName(), 'optional' => false],
                'data' => ['type' => $this->classnameToEntityName($table->getAlias()) . '[]', 'optional' => false],
            ];
        }

        return $entities;
    }

    protected function buildEntityData(Table $table): array
    {
        $props = $this->buildEntityPropsData($table);
        $associations = $this->buildEntityAssociatedData($table);
        return array_merge($props, $associations);
    }

    protected function buildEntityPropsData(Table $table): array
    {
        $props = [];
        $schema = $table->getSchema();
        $columns = $schema->columns();
        foreach ($columns as $column) {
            $props[$column] = [
                'type' => $this->phpTypeToTSMap($schema->getColumnType($column)),
                'orm' => $schema->getColumnType($column),
                'optional' => $schema->isNullable($column)
            ];
        }
        return $props;
    }

    protected function buildEntityAssociatedData(Table $table): array
    {
        $props = [];
        $associations = $table->associations();
        foreach ($associations as $association) {
            $name = $association->getName();
            $class = $association->getSource()->getAlias();
            $type = $this->entityClassToNormalizedEntityName($association->getEntityClass());
            if (!array_key_exists($class, $this->models)) {
                $this->io->info("Association '{$name}' of type '{$class}' not found in loaded models. Skipping.");
                continue;
            }
            $association_type = $association->type();

            switch ($association_type) {
                case 'oneToMany':
                case 'manyToMany':
                    $prop_name = Inflector::tableize($name);
                    $type = $type . '[]';
                    $optional = false;
                    break;

                case 'manyToOne':
                    $prop_name = Inflector::singularize(Inflector::tableize($name));
                    $optional = true;
                    break;

                default:
                    throw new ConsoleException("Unknown association type '{$association_type}'");
            }

            $props[$prop_name] = compact('type', 'optional');
        }
        return $props;
    }

    protected function phpTypeToTSMap(string $type): string
    {
        switch ($type) {
            case 'decimal':
            case 'float':
            case 'biginteger':
            case 'integer':
                return 'number';

            case 'boolean';
                return 'boolean';

            case 'string':
            case 'char':
            case 'text':
                return 'string';

            case 'datetime':
            case 'date':
                return 'Date';

            default:
                throw new ConsoleException("Unknown type '{$type}'");
        }
    }

    protected function entityClassToNormalizedEntityName(string $entityClass): string
    {
        $parts = explode('\\', $entityClass);
        $name = array_pop($parts);
        return $name . 'Entity';
    }

    protected function classnameToEntityName(string $name): string
    {
        return Inflector::singularize($name) . 'Entity';
    }

    protected function toSingularPropName(string $name): string
    {
        return Inflector::singularize(Inflector::tableize($name));
    }

    protected function getPaginationEntityName(): string
    {
        return 'PaginationEntity';
    }

    protected function buildPaginationData(): array
    {
        return [
            $this->getPaginationEntityName() => [
                'page_count' => ['type' => 'number', 'optional' => false],
                'current_page' => ['type' => 'number', 'optional' => false],
                'has_next_page' => ['type' => 'boolean', 'optional' => false],
                'has_prev_page' => ['type' => 'boolean', 'optional' => false],
                'count' => ['type' => 'number', 'optional' => false],
                'limit' => ['type' => 'number', 'optional' => true],
            ]
        ];
    }
}
