<?php

namespace App\Model\Table;

use App\Model\Entity\RssDomain;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Commentable\Model\Behavior\CommentableBehavior;

/**
 * RssDomains Model
 *
 * @property UsersTable&BelongsTo $Users
 * @property DomainFeedsTable&HasMany $DomainFeeds
 *
 * @method RssDomain get($primaryKey, $options = [])
 * @method RssDomain newEntity($data = null, array $options = [])
 * @method RssDomain[] newEntities(array $data, array $options = [])
 * @method RssDomain|false save(EntityInterface $entity, $options = [])
 * @method RssDomain saveOrFail(EntityInterface $entity, $options = [])
 * @method RssDomain patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method RssDomain[] patchEntities($entities, array $data, array $options = [])
 * @method RssDomain findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 * @mixin CommentableBehavior
 */
class RssDomainsTable extends Table
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

        $this->setTable('rss_domains');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Commentable.Commentable');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('DomainFeeds', [
            'foreignKey' => 'rss_domain_id',
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
            ->boolean('is_active')
            ->allowEmptyString('is_active');

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
            ->integer('feed_count')
            ->notEmptyString('feed_count');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
