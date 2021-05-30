<?php

namespace UserAudit;

use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Event\EventManager;
use UserAudit\Event\AuditLogger;

/**
 * Plugin for UserAudit
 */
class Plugin extends BasePlugin
{
    public function bootstrap(PluginApplicationInterface $app)
    {
        parent::bootstrap($app);
        $app->addPlugin('AuthUserStore');
        EventManager::instance()->on(new AuditLogger());
    }
}
