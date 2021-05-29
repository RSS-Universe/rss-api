<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RssDomainsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RssDomainsTable Test Case
 */
class RssDomainsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var RssDomainsTable
     */
    public $RssDomains;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RssDomains',
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
        $config = TableRegistry::getTableLocator()->exists('RssDomains') ? [] : ['className' => RssDomainsTable::class];
        $this->RssDomains = TableRegistry::getTableLocator()->get('RssDomains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RssDomains);

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
