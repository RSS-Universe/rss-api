<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DomainFeedsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DomainFeedsTable Test Case
 */
class DomainFeedsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var DomainFeedsTable
     */
    public $DomainFeeds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.DomainFeeds',
        'app.RssDomains',
        'app.FeedItems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DomainFeeds') ? [] : ['className' => DomainFeedsTable::class];
        $this->DomainFeeds = TableRegistry::getTableLocator()->get('DomainFeeds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DomainFeeds);

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
