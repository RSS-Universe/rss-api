<?php

namespace App\Controller;

use App\Model\Entity\DomainFeed;
use App\Model\Table\DomainFeedsTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;

/**
 * DomainFeeds Controller
 *
 * @property DomainFeedsTable $DomainFeeds
 *
 * @method DomainFeed[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class DomainFeedsController extends AppController
{

    public $paginate = [
        'DomainFeeds' => [
            'limit' => 10,
            'order' => [
                'last_fetch' => 'asc'
            ],
        ],
        'FeedItems' => [
            'limit' => 10,
            'order' => [
                'published' => 'desc'
            ],
        ],

    ];

    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RssDomains'],
        ];
        $domainFeeds = $this->paginate($this->DomainFeeds);

        $this->set(compact('domainFeeds'));
    }

    /**
     * View method
     *
     * @param string|null $id Domain Feed id.
     * @return Response|null
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $domainFeed = $this->DomainFeeds->get($id, [
            'contain' => ['RssDomains'],
        ]);

        $feedItems = $this->paginate(
            TableRegistry::getTableLocator()
                ->get('FeedItems')
                ->find()
                ->where([
                    'domain_feed_id' => $domainFeed->id
                ])
        );

        $this->set(compact('domainFeed', 'feedItems'));
    }

    /**
     * @param null $id
     * @return Response|null
     */
    public function add($id = null)
    {
        $domainFeed = $this->DomainFeeds->newEntity([
            'rss_domain_id' => $id
        ]);
        if ($this->request->is('post')) {
            $domainFeed = $this->DomainFeeds->patchEntity($domainFeed, $this->request->getData());
            $domainFeed = $this->DomainFeeds->patchEntity($domainFeed, [
                'is_active' => false,
                'user_id' => $this->Auth->user('id'),
                'feed_count' => 0
            ]);
            if ($this->DomainFeeds->save($domainFeed)) {
                $this->Flash->success(__('The domain feed has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domain feed could not be saved. Please, try again.'));
        }
        $rssDomains = $this->DomainFeeds->RssDomains->find('list', ['limit' => 200]);
        $this->set(compact('domainFeed', 'rssDomains'));
    }
}
