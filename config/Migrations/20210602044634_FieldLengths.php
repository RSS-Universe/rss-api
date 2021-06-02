<?php
use Migrations\AbstractMigration;

class FieldLengths extends AbstractMigration
{

    public function up()
    {

        $this->table('feed_items')
            ->changeColumn('title', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ])
            ->changeColumn('url', 'string', [
                'default' => '',
                'limit' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('feed_items')
            ->addColumn('published', 'datetime', [
                'after' => 'description',
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('feed_items')
            ->changeColumn('title', 'string', [
                'default' => '',
                'length' => 100,
                'null' => false,
            ])
            ->changeColumn('url', 'string', [
                'default' => '',
                'length' => 200,
                'null' => false,
            ])
            ->removeColumn('published')
            ->update();
    }
}

