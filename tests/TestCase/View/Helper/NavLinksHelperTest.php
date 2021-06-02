<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\NavLinksHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\NavLinksHelper Test Case
 */
class NavLinksHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var NavLinksHelper
     */
    public $NavLinks;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->NavLinks = new NavLinksHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NavLinks);

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
