<?php
declare(strict_types=1);

namespace App\Service;
/**
 * Trait SingletonTrait
 * @package App\Service
 */
trait SingletonTrait
{

    /**
     * @var static
     */
    private static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

}
