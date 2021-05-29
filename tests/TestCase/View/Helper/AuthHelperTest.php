<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\AuthHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\AuthHelper Test Case
 */
class AuthHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var AuthHelper
     */
    public $Auth;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Auth = new AuthHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Auth);

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
