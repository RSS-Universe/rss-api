<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\GravatarHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\GravatarHelper Test Case
 */
class GravatarHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var GravatarHelper
     */
    public $Gravatar;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Gravatar = new GravatarHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Gravatar);

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
