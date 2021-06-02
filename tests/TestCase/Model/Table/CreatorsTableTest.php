<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CreatorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CreatorsTable Test Case
 */
class CreatorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var CreatorsTable
     */
    public $Creators;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Creators',
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
        $config = TableRegistry::getTableLocator()->exists('Creators') ? [] : ['className' => CreatorsTable::class];
        $this->Creators = TableRegistry::getTableLocator()->get('Creators', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Creators);

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
