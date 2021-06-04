<?php

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ActiveIndicatorHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ActiveIndicatorHelper Test Case
 */
class ActiveIndicatorHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var ActiveIndicatorHelper
     */
    public $ActiveIndicator;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->ActiveIndicator = new ActiveIndicatorHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActiveIndicator);

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
