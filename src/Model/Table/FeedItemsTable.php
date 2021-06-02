<?php

namespace App\Model\Table;

use App\Model\Entity\FeedItem;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\BelongsToMany;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeedItems Model
 *
 * @property DomainFeedsTable&BelongsTo $DomainFeeds
 * @property CreatorsTable&BelongsTo $Creators
 * @property CategoriesTable&BelongsToMany $Categories
 *
 * @method FeedItem get($primaryKey, $options = [])
 * @method FeedItem newEntity($data = null, array $options = [])
 * @method FeedItem[] newEntities(array $data, array $options = [])
 * @method FeedItem|false save(EntityInterface $entity, $options = [])
 * @method FeedItem saveOrFail(EntityInterface $entity, $options = [])
 * @method FeedItem patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method FeedItem[] patchEntities($entities, array $data, array $options = [])
 * @method FeedItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 */
class FeedItemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('feed_items');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'DomainFeeds' => ['items_count']
        ]);
        $this->belongsTo('DomainFeeds', [
            'foreignKey' => 'domain_feed_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Creators', [
            'foreignKey' => 'creator_id',
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'feed_item_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'feed_items_categories',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 200)
            ->notEmptyString('title');

        $validator
            ->urlWithProtocol('url')
            ->maxLength('url', 255)
            ->notEmptyString('url')
            ->add('url', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->dateTime('published')
            ->requirePresence('published', 'create')
            ->notEmptyDateTime('published');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param RulesChecker $rules The rules object to be modified.
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['url']));
        $rules->add($rules->existsIn(['domain_feed_id'], 'DomainFeeds'));
        $rules->add($rules->existsIn(['creator_id'], 'Creators'));

        return $rules;
    }
}
