<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Http\Response;
use Crud\Controller\Component\CrudComponent;
use Crud\Controller\ControllerTrait;
use Crud\Error\Exception\ListenerNotConfiguredException;
use Crud\Error\Exception\MissingListenerException;
use Exception;

/**
 * ApiApp Controller
 * @property-read CrudComponent $Crud
 */
class ApiAppController extends AppController
{
    use ControllerTrait;

    public $paginate = [
        'maxLimit' => 100,
        'limit' => 20,
        'relatedModels' => []
    ];

    /**
     * @param Event $event
     * @return Response|null
     * @throws ListenerNotConfiguredException
     * @throws MissingListenerException
     */
    public function beforeFilter(Event $event): ?Response
    {
        $this->Crud->listener('relatedModels')->relatedModels($this->paginate['relatedModels']);
        return parent::beforeFilter($event);
    }

    /**
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'index' => [
                    'className' => 'Crud.Index',
                    'relatedModels' => true
                ],
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete'
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog',
            ]
        ]);
        $this->Crud->addListener('relatedModels', 'Crud.RelatedModels');
    }
}
