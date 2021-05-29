<?php

namespace App\Controller;

use App\Model\Entity\DomainFeed;
use App\Model\Table\DomainFeedsTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;

/**
 * DomainFeeds Controller
 *
 * @property DomainFeedsTable $DomainFeeds
 *
 * @method DomainFeed[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class DomainFeedsController extends AppController
{
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
            'contain' => ['RssDomains', 'FeedItems'],
        ]);

        $this->set('domainFeed', $domainFeed);
    }

    /**
     * Add method
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $domainFeed = $this->DomainFeeds->newEntity();
        if ($this->request->is('post')) {
            $domainFeed = $this->DomainFeeds->patchEntity($domainFeed, $this->request->getData());
            if ($this->DomainFeeds->save($domainFeed)) {
                $this->Flash->success(__('The domain feed has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domain feed could not be saved. Please, try again.'));
        }
        $rssDomains = $this->DomainFeeds->RssDomains->find('list', ['limit' => 200]);
        $this->set(compact('domainFeed', 'rssDomains'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Domain Feed id.
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $domainFeed = $this->DomainFeeds->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $domainFeed = $this->DomainFeeds->patchEntity($domainFeed, $this->request->getData());
            if ($this->DomainFeeds->save($domainFeed)) {
                $this->Flash->success(__('The domain feed has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domain feed could not be saved. Please, try again.'));
        }
        $rssDomains = $this->DomainFeeds->RssDomains->find('list', ['limit' => 200]);
        $this->set(compact('domainFeed', 'rssDomains'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Domain Feed id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $domainFeed = $this->DomainFeeds->get($id);
        if ($this->DomainFeeds->delete($domainFeed)) {
            $this->Flash->success(__('The domain feed has been deleted.'));
        } else {
            $this->Flash->error(__('The domain feed could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
