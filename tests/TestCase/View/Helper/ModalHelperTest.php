<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ModalHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ModalHelper Test Case
 */
class ModalHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ModalHelper
     */
    public $Modal;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Modal = new ModalHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Modal);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
