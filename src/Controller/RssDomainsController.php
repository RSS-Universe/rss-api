<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RssDomains Controller
 *
 * @property \App\Model\Table\RssDomainsTable $RssDomains
 *
 * @method \App\Model\Entity\RssDomain[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RssDomainsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $rssDomains = $this->paginate($this->RssDomains);

        $this->set(compact('rssDomains'));
    }

    /**
     * View method
     *
     * @param string|null $id Rss Domain id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rssDomain = $this->RssDomains->get($id, [
            'contain' => ['DomainFeeds'],
        ]);

        $this->set('rssDomain', $rssDomain);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rssDomain = $this->RssDomains->newEntity();
        if ($this->request->is('post')) {
            $rssDomain = $this->RssDomains->patchEntity($rssDomain, $this->request->getData());
            if ($this->RssDomains->save($rssDomain)) {
                $this->Flash->success(__('The rss domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rss domain could not be saved. Please, try again.'));
        }
        $this->set(compact('rssDomain'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rss Domain id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rssDomain = $this->RssDomains->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rssDomain = $this->RssDomains->patchEntity($rssDomain, $this->request->getData());
            if ($this->RssDomains->save($rssDomain)) {
                $this->Flash->success(__('The rss domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rss domain could not be saved. Please, try again.'));
        }
        $this->set(compact('rssDomain'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rss Domain id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rssDomain = $this->RssDomains->get($id);
        if ($this->RssDomains->delete($rssDomain)) {
            $this->Flash->success(__('The rss domain has been deleted.'));
        } else {
            $this->Flash->error(__('The rss domain could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
