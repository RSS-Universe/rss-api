<?php

namespace Commentable\Controller;

use AuthUserStore\Event\AuthUserStore;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\Utility\Hash;
use Commentable\Model\Entity\Comment;
use Commentable\Model\Table\CommentsTable;

/**
 * Comments Controller
 *
 * @property CommentsTable $Comments
 *
 * @method Comment[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{

    /**
     * Add method
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->getRequest()->getData();
            $comment = $this->Comments->newEntity([
                'user_id' => AuthUserStore::getUser()->id,
                'model_name' => Hash::get($data, 'model_name'),
                'model_identifier' => Hash::get($data, 'model_identifier'),
                'parent_id' => Hash::get($data, 'parent_id'),
                'comment' => Hash::get($data, 'comment'),
            ]);
            $this->Comments->saveOrFail($comment);
        }
        return $this->redirect($this->referer());
    }

    public function replyTo(string $comment_id)
    {
        $return = $this->getRequest()->getQuery('return');
        $comment = $this->Comments->get($comment_id, ['contain' => 'Users']);
        $defaults = [
            'user_id' => AuthUserStore::getUser()->id,
            'model_name' => $comment->model_name,
            'model_identifier' => $comment->model_identifier,
            'parent_id' => $comment->id,
        ];
        $reply = $this->Comments->newEntity($defaults);
        if ($this->request->is('post')) {
            $reply = $this->Comments->patchEntity($reply, $this->getRequest()->getData());
            $reply = $this->Comments->patchEntity($reply, $defaults);
            if ($this->Comments->save($reply)) {
                $this->Flash->success('Reply Successful');
                return $this->redirect($return ?? $this->referer());
            } else {
                $this->Flash->error('Can not save reply');
            }
        }
        $this->set(compact('comment', 'reply'));
    }
}
