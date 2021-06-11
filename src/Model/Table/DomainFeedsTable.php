<?php

namespace App\Model\Table;

use App\Model\Entity\DomainFeed;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DomainFeeds Model
 *
 * @property RssDomainsTable&BelongsTo $RssDomains
 * @property UsersTable&BelongsTo $Users
 * @property FeedItemsTable&HasMany $FeedItems
 *
 * @method DomainFeed get($primaryKey, $options = [])
 * @method DomainFeed newEntity($data = null, array $options = [])
 * @method DomainFeed[] newEntities(array $data, array $options = [])
 * @method DomainFeed|false save(EntityInterface $entity, $options = [])
 * @method DomainFeed saveOrFail(EntityInterface $entity, $options = [])
 * @method DomainFeed patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method DomainFeed[] patchEntities($entities, array $data, array $options = [])
 * @method DomainFeed findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 */
class DomainFeedsTable extends Table
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

        $this->setTable('domain_feeds');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Commentable.Commentable');
        $this->addBehavior('CounterCache', [
            'RssDomains' => ['feed_count']
        ]);
        $this->belongsTo('RssDomains', [
            'foreignKey' => 'rss_domain_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('FeedItems', [
            'foreignKey' => 'domain_feed_id',
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->notEmptyString('name');

        $validator
            ->urlWithProtocol('url')
            ->maxLength('url', 200)
            ->notEmptyString('url')
            ->add('url', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('items_count')
            ->notEmptyString('items_count');

        $validator
            ->integer('fetch_in_minutes')
            ->notEmptyString('fetch_in_minutes');

        $validator
            ->boolean('is_active')
            ->allowEmptyString('is_active');

        $validator
            ->dateTime('last_fetch')
            ->allowEmptyDateTime('last_fetch');

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
        $rules->add($rules->existsIn(['rss_domain_id'], 'RssDomains'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    /**
     * @param int $limit
     * @return ResultSetInterface|DomainFeed[]
     */
    public function fetchNextForParsing(int $limit = 10)
    {
        return $this->find()
            ->limit($limit)
            ->orderAsc('last_fetch')
            ->where([
                'OR' => [
                    'last_fetch IS NULL',
                    'TIMESTAMPDIFF(MINUTE, last_fetch, NOW()) > fetch_in_minutes'
                ]
            ])->all();
    }
}
