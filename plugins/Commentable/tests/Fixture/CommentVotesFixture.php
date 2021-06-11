<?php

namespace Commentable\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CommentVotesFixture
 */
class CommentVotesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'comment_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null],
        'is_positive' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'comment_id' => ['type' => 'index', 'columns' => ['comment_id'], 'length' => []],
            'is_positive' => ['type' => 'index', 'columns' => ['is_positive'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'user_commnet_vote' => ['type' => 'unique', 'columns' => ['user_id', 'comment_id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => '61773720-b3a6-468d-bb8b-74766770fd4f',
                'user_id' => 1,
                'comment_id' => '5768ce76-f2bd-41b5-bfbf-9984ee826a28',
                'is_positive' => 1,
                'created' => '2021-06-06 00:20:15',
                'modified' => '2021-06-06 00:20:15',
            ],
        ];
        parent::init();
    }
}
