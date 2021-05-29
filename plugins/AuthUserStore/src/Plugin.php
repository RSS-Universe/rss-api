<?php

namespace AuthUserStore;

use AuthUserStore\Event\AuthUserStore;
use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Event\EventManager;

/**
 * Plugin for AuthUserStore
 */
class Plugin extends BasePlugin
{
    public function bootstrap(PluginApplicationInterface $app)
    {
        parent::bootstrap($app);
        EventManager::instance()->on(new AuthUserStore());
    }
}
