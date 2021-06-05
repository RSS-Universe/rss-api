<?php
namespace Commentable\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Commentable\View\Helper\CommentHelper;

/**
 * Commentable\View\Helper\CommentHelper Test Case
 */
class CommentHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Commentable\View\Helper\CommentHelper
     */
    public $Comment;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Comment = new CommentHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Comment);

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
