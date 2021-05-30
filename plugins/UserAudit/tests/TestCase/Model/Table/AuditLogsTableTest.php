<?php
namespace UserAudit\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use UserAudit\Model\Table\AuditLogsTable;

/**
 * UserAudit\Model\Table\AuditLogsTable Test Case
 */
class AuditLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \UserAudit\Model\Table\AuditLogsTable
     */
    public $AuditLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.UserAudit.AuditLogs',
        'plugin.UserAudit.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AuditLogs') ? [] : ['className' => AuditLogsTable::class];
        $this->AuditLogs = TableRegistry::getTableLocator()->get('AuditLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AuditLogs);

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

    /**
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test logControllerAction method
     *
     * @return void
     */
    public function testLogControllerAction()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test logModelBeforeSave method
     *
     * @return void
     */
    public function testLogModelBeforeSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test logModelBeforeDelete method
     *
     * @return void
     */
    public function testLogModelBeforeDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
