<?php

use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('domain_feeds')
            ->addColumn('id', 'uuid', [
                'default' => '',
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('rss_domain_id', 'uuid', [
                'default' => '',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => '',
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('url', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('items_count', 'integer', [
                'default' => '0',
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('fetch_in_minutes', 'integer', [
                'default' => '5',
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('last_fetch', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'url',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'rss_domain_id',
                ]
            )
            ->create();

        $this->table('feed_items')
            ->addColumn('id', 'uuid', [
                'default' => '',
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('domain_feed_id', 'uuid', [
                'default' => '',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('title', 'string', [
                'default' => '',
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('url', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'url',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('rss_domains')
            ->addColumn('id', 'uuid', [
                'default' => '',
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'default' => '',
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('url', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('feed_count', 'integer', [
                'default' => '0',
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'url',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('users')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->addColumn('is_admin', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('is_active', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'email',
                ],
                ['unique' => true]
            )
            ->create();
    }

    public function down()
    {
        $this->table('domain_feeds')->drop()->save();
        $this->table('feed_items')->drop()->save();
        $this->table('rss_domains')->drop()->save();
        $this->table('users')->drop()->save();
    }
}
