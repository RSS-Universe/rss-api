<?php

namespace Commentable\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Commentable\Model\Table\CommentVotesTable;

/**
 * Commentable\Model\Table\CommentVotesTable Test Case
 */
class CommentVotesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var CommentVotesTable
     */
    public $CommentVotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Commentable.CommentVotes',
        'plugin.Commentable.Users',
        'plugin.Commentable.Comments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CommentVotes') ? [] : ['className' => CommentVotesTable::class];
        $this->CommentVotes = TableRegistry::getTableLocator()->get('CommentVotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommentVotes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
