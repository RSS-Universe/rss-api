<?php

namespace App\Controller;

use App\Model\Entity\FeedItem;
use App\Model\Table\FeedItemsTable;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;

/**
 * FeedItems Controller
 *
 * @property FeedItemsTable $FeedItems
 *
 * @method FeedItem[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeedItemsController extends AppController
{
    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DomainFeeds'],
        ];
        $feedItems = $this->paginate($this->FeedItems);

        $this->set(compact('feedItems'));
    }

}
