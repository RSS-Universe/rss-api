<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeedItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeedItemsTable Test Case
 */
class FeedItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var FeedItemsTable
     */
    public $FeedItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.FeedItems',
        'app.DomainFeeds',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeedItems') ? [] : ['className' => FeedItemsTable::class];
        $this->FeedItems = TableRegistry::getTableLocator()->get('FeedItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeedItems);

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
