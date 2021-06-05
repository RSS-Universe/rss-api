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
}
