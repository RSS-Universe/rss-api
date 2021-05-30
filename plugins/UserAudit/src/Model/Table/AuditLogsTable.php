<?php

namespace UserAudit\Model\Table;

use App\Model\Table\UsersTable;
use ArrayObject;
use AuthUserStore\Event\AuthUserStore;
use Cake\Controller\Controller;
use Cake\Database\Schema\TableSchema;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use UserAudit\Model\Entity\AuditLog;

/**
 * AuditLogs Model
 *
 * @property UsersTable&BelongsTo $Users
 *
 * @method AuditLog get($primaryKey, $options = [])
 * @method AuditLog newEntity($data = null, array $options = [])
 * @method AuditLog[] newEntities(array $data, array $options = [])
 * @method AuditLog|false save(EntityInterface $entity, $options = [])
 * @method AuditLog saveOrFail(EntityInterface $entity, $options = [])
 * @method AuditLog patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method AuditLog[] patchEntities($entities, array $data, array $options = [])
 * @method AuditLog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 */
class AuditLogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('audit_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'UserAudit.Users',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('session_uid')
            ->maxLength('session_uid', 100)
            ->allowEmptyString('session_uid');

        $validator
            ->scalar('class_name')
            ->maxLength('class_name', 200)
            ->notEmptyString('class_name');

        $validator
            ->scalar('context')
            ->maxLength('context', 100)
            ->requirePresence('context', 'create')
            ->notEmptyString('context');

        $validator
            ->scalar('action')
            ->maxLength('action', 100)
            ->requirePresence('action', 'create')
            ->notEmptyString('action');

        $validator
            ->isArray('diff')
            ->allowEmptyArray('diff');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param RulesChecker $rules The rules object to be modified.
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    protected function _initializeSchema(TableSchema $schema): TableSchema
    {
        $schema = parent::_initializeSchema($schema);
        $schema->setColumnType('diff', 'json');
        return $schema;
    }

    public function beforeSave(Event $event, AuditLog $entity, ArrayObject $options)
    {
        $entity->user_id = AuthUserStore::getUser()
            ? AuthUserStore::getUser()->id
            : null;

        $entity->session_uid = AuthUserStore::getSessionId();
    }

    protected function isBlackListedClassName(string $name): bool
    {
        $blackListPlugins = [
            'DebugKit',
            'UserAudit'
        ];

        list($plugin, $name) = pluginSplit($name);

        if (in_array($plugin, $blackListPlugins)) {
            return true;
        }

        return false;
    }

    protected function prepModelEntity(EntityInterface $entity, array $data): void
    {
        if ($this->isBlackListedClassName($entity->getSource())) {
            return;
        }

        $data = array_merge($data, [
            'class_name' => get_class($entity),
            'context' => 'entity',
        ]);

        $log = $this->newEntity($data);
        $this->save($log, ['atomic' => false]);
    }

    public function logControllerAction(Controller $controller): void
    {
        $name = str_replace('\\', '.', get_class($controller));
        if ($this->isBlackListedClassName($name)) {
            return;
        }

        $request = $controller->getRequest();
        $uri = (string)$request->getUri();
        $method = $request->getMethod();
        $data = $request->getData();
        if (array_key_exists('password', $data)) {
            $data['password'] = '__REDACTED__';
        }
        $data = [
            'class_name' => get_class($controller),
            'context' => 'controller',
            'action' => $method,
            'diff' => compact('uri', 'data'),
        ];

        if ($data['class_name'] === 'DebugKit\Controller\RequestsController') {
            debug($data);
            debug($controller->getName());
        }
        $log = $this->newEntity($data);
        $this->save($log, ['atomic' => false]);
    }

    public function logModelBeforeSave(EntityInterface $entity): void
    {
        $data = [
            'action' => $entity->isNew() ? 'created' : 'modified',
            'diff' => array_intersect_key($entity->toArray(), array_flip($entity->getDirty())),
        ];
        $this->prepModelEntity($entity, $data);
    }

    public function logModelBeforeDelete(EntityInterface $entity): void
    {
        $data = [
            'action' => 'deleted',
            'diff' => $entity->toArray(),
        ];
        $this->prepModelEntity($entity, $data);
    }
}
