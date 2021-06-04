<?php

namespace App\Controller;

use App\Model\Entity\RssDomain;
use App\Model\Table\RssDomainsTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;

/**
 * RssDomains Controller
 *
 * @property RssDomainsTable $RssDomains
 *
 * @method RssDomain[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class RssDomainsController extends AppController
{
    public $paginate = [
        'RssDomains' => [
            'limit' => 10,
            'order' => [
                'feed_count' => 'asc'
            ],
        ],
        'DomainFeeds' => [
            'limit' => 10,
            'order' => [
                'last_fetch' => 'asc'
            ],
        ]
    ];

    /**
     * Index method
     */
    public function index(): void
    {
        $rssDomains = $this->paginate($this->RssDomains);

        $this->set(compact('rssDomains'));
    }

    /**
     * View method
     *
     * @param string|null $id Rss Domain id.
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null): void
    {
        $rssDomain = $this->RssDomains->get($id, [
            'contain' => [],
        ]);

        $domainFeeds = $this->paginate(
            TableRegistry::getTableLocator()
                ->get('DomainFeeds')
                ->find()
                ->where([
                    'rss_domain_id' => $rssDomain->id
                ])
        );

        $this->set(compact('rssDomain', 'domainFeeds'));
    }

    /**
     * Add method
     *
     * @return void|Response
     */
    public function add()
    {
        $rssDomain = $this->RssDomains->newEntity();
        if ($this->request->is('post')) {
            $rssDomain = $this->RssDomains->patchEntity($rssDomain, $this->request->getData());
            $rssDomain = $this->RssDomains->patchEntity($rssDomain, [
                'is_active' => false,
                'user_id' => $this->Auth->user('id'),
                'feed_count' => 0
            ]);
            if ($this->RssDomains->save($rssDomain)) {
                $this->Flash->success(__('The rss domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rss domain could not be saved. Please, try again.'));
        }
        $this->set(compact('rssDomain'));
    }
}
