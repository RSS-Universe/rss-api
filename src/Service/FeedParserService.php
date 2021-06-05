<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Entity\DomainFeed;
use App\Model\Entity\FeedItem;
use App\Model\Table\CategoriesTable;
use App\Model\Table\CreatorsTable;
use App\Model\Table\DomainFeedsTable;
use App\Model\Table\FeedItemsTable;
use Cake\Chronos\Chronos;
use Cake\Core\Exception\Exception;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Feed;
use FeedException;
use function collection;

/**
 * Class FeedParserService
 *
 * @package App\Service
 */
class FeedParserService
{

    /**
     * @var FeedItemsTable
     */
    protected $FeedItems;

    /**
     * @var CreatorsTable
     */
    protected $Creators;

    /**
     * @var CategoriesTable
     */
    protected $Categories;

    /**
     * @var DomainFeedsTable
     */
    protected $DomainFeeds;

    use SingletonTrait;

    protected $knows_feed_props = [
        'title', 'link', 'description', 'timestamp', 'guid', 'pubDate', 'dc:creator', 'category'
    ];

    /**
     * FeedParserService constructor.
     */
    public function __construct()
    {
        Feed::$cacheDir = CACHE;
        Feed::$cacheExpire = '5 minutes';
        Feed::$userAgent = "RSS Universe; (+http://rss-universe)";
        $this->FeedItems = TableRegistry::getTableLocator()->get('FeedItems');
        $this->Creators = TableRegistry::getTableLocator()->get('Creators');
        $this->Categories = TableRegistry::getTableLocator()->get('Categories');
        $this->DomainFeeds = TableRegistry::getTableLocator()->get('DomainFeeds');
    }

    /**
     * @param DomainFeed $domainFeed
     * @return FeedItem[]|ResultSetInterface
     * @throws FeedException
     * @throws Exception
     * @throws \Exception
     */
    public function parse(DomainFeed $domainFeed): array
    {
        $rssObj = Feed::loadRss($domainFeed->url);
        $rssArray = $rssObj->toArray();
        $feedItems = [];
        foreach ($rssArray['item'] as $item) {
            $this->checkFeedProps($item);
            $data = [
                'domain_feed_id' => $domainFeed->id,
                'title' => Hash::get($item, 'title'),
                'url' => Hash::get($item, 'link'),
                'description' => Hash::get($item, 'description'),
                'published' => Chronos::createFromTimestampUTC((int)Hash::get($item, 'timestamp')),
            ];
            $creator = Hash::get($item, 'creator');
            if ($creator) {
                $data['creator_id'] = $this->Creators->findOrCreate($creator);
            }

            $categories = Hash::get($item, 'category');
            if ($categories) {
                $data['categories'] = ['_ids'];
                foreach ($categories as $name) {
                    $category = $this->Categories->findOrCreate(compact('name'));
                    $data['categories']['_ids'][] = $category->id;
                }
            }
            $feedItems[] = $data;
        }
        $entities = $this->FeedItems->newEntities($feedItems);
        $entities = $this->filterKnownEntities($entities);
        $results = $this->FeedItems->saveManyOrFail($entities);

        $domainFeed->last_fetch = Chronos::now();
        $this->DomainFeeds->saveOrFail($domainFeed);

        return $results;
    }

    protected function checkFeedProps(array $item)
    {
        $unknown_keys = array_diff(array_keys($item), $this->knows_feed_props);
        if (count($unknown_keys)) {
            throw new Exception('Found unknown feed props: ' . print_r($unknown_keys, true));
        }
    }

    /**
     * @param FeedItem[] $entities
     * @return FeedItem[]
     */
    protected function filterKnownEntities(array $entities): array
    {
        return collection($entities)
            ->filter(function (FeedItem $feedItem) {
                return !$feedItem->getError('url');
            })->toArray();
    }
}
