<?php
declare(strict_types=1);

namespace UserAudit\Event;

use Cake\Controller\Controller;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use UserAudit\Model\Table\AuditLogsTable;

/**
 * Class AuditLogger
 * @package UserAudit\Event
 */
class AuditLogger implements EventListenerInterface
{

    /**
     * @var AuditLogsTable
     */
    protected $AuditLogs;

    /**
     * AuditLogger constructor.
     */
    public function __construct()
    {
        $this->AuditLogs = TableRegistry::getTableLocator()->get('UserAudit.AuditLogs');
    }

    /**
     * @return array
     */
    public function implementedEvents(): array
    {
        return [
            'Model.beforeSave' => [
                'callable' => 'modelBeforeSave',
                'priority' => 100
            ],
            'Model.beforeDelete' => [
                'callable' => 'modelBeforeDelete',
                'priority' => 100
            ],
            'Controller.initialize' => [
                'callable' => 'controllerInitialize',
                'priority' => 100
            ],
        ];
    }

    public function modelBeforeSave(Event $event)
    {
        /** @var EntityInterface $entity */
        $entity = $event->getData()['entity'];
        $this->AuditLogs->logModelBeforeSave($entity);
    }

    public function modelBeforeDelete(Event $event)
    {
        /** @var EntityInterface $entity */
        $entity = $event->getData()['entity'];
        $this->AuditLogs->logModelBeforeDelete($entity);
    }

    public function controllerInitialize(Event $event)
    {
        /** @var Controller $controller */
        $controller = $event->getSubject();
        $this->AuditLogs->logControllerAction($controller);
    }
}
