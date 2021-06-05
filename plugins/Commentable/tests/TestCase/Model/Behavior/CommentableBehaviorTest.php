<?php
namespace Commentable\Test\TestCase\Model\Behavior;

use Cake\TestSuite\TestCase;
use Commentable\Model\Behavior\CommentableBehavior;

/**
 * Commentable\Model\Behavior\CommentableBehavior Test Case
 */
class CommentableBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Commentable\Model\Behavior\CommentableBehavior
     */
    public $Commentable;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Commentable = new CommentableBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Commentable);

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
