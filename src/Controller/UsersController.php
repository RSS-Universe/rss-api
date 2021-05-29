<?php

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use App\Service\EmailSendingService;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\Utility\Security;
use Exception;

/**
 * Users Controller
 *
 * @property UsersTable $Users
 *
 * @method User[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout', 'register', 'emailVerify']);
    }

    public function emailVerify(): ?Response
    {
        try {
            $id = $this->getRequest()->getQuery('id', '');
            $token = $this->getRequest()->getQuery('token', '');
            $user = $this->Users->verifyEmailToken($id, $token);
            $this->Flash->success('Your email has been verified. Please log in');
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        } catch (Exception $e) {
            $this->Flash->error('Unable to verify your email: ' . $e->getMessage());
        }

        return $this->redirect('/users/login');
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return Response|null
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * @return Response|null
     */
    public function register()
    {
        $this->ifLoggedInRedirect();
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'fieldList' => ['name', 'email', 'password']
            ]);
            $user->email_verification_code = Security::randomString(32);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                EmailSendingService::getInstance()->registrationEmail($user);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $this->ifLoggedInRedirect();
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                if ($user['is_email_verified'] !== true) {
                    $this->Flash->error('Your email is not verified');
                } else {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Flash->error('Your email or password is incorrect.');
            }
        }
    }

    protected function ifLoggedInRedirect()
    {
        if ($this->Auth->user('id')) {
            $this->Flash->error('You are already logged in.');
            return $this->redirect($this->referer());
        }
    }
}
