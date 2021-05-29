<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * FeedItems Controller
 *
 * @property \App\Model\Table\FeedItemsTable $FeedItems
 *
 * @method \App\Model\Entity\FeedItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DomainFeeds'],
        ];
        $feedItems = $this->paginate($this->FeedItems);

        $this->set(compact('feedItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Feed Item id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feedItem = $this->FeedItems->get($id, [
            'contain' => ['DomainFeeds'],
        ]);

        $this->set('feedItem', $feedItem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feedItem = $this->FeedItems->newEntity();
        if ($this->request->is('post')) {
            $feedItem = $this->FeedItems->patchEntity($feedItem, $this->request->getData());
            if ($this->FeedItems->save($feedItem)) {
                $this->Flash->success(__('The feed item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feed item could not be saved. Please, try again.'));
        }
        $domainFeeds = $this->FeedItems->DomainFeeds->find('list', ['limit' => 200]);
        $this->set(compact('feedItem', 'domainFeeds'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feed Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feedItem = $this->FeedItems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feedItem = $this->FeedItems->patchEntity($feedItem, $this->request->getData());
            if ($this->FeedItems->save($feedItem)) {
                $this->Flash->success(__('The feed item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feed item could not be saved. Please, try again.'));
        }
        $domainFeeds = $this->FeedItems->DomainFeeds->find('list', ['limit' => 200]);
        $this->set(compact('feedItem', 'domainFeeds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feed Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feedItem = $this->FeedItems->get($id);
        if ($this->FeedItems->delete($feedItem)) {
            $this->Flash->success(__('The feed item has been deleted.'));
        } else {
            $this->Flash->error(__('The feed item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
