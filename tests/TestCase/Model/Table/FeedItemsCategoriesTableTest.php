<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeedItemsCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeedItemsCategoriesTable Test Case
 */
class FeedItemsCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var FeedItemsCategoriesTable
     */
    public $FeedItemsCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.FeedItemsCategories',
        'app.FeedItems',
        'app.Categories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeedItemsCategories') ? [] : ['className' => FeedItemsCategoriesTable::class];
        $this->FeedItemsCategories = TableRegistry::getTableLocator()->get('FeedItemsCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeedItemsCategories);

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
