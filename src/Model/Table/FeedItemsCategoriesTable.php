<?php

namespace App\Model\Table;

use App\Model\Entity\FeedItemsCategory;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeedItemsCategories Model
 *
 * @property FeedItemsTable&BelongsTo $FeedItems
 * @property CategoriesTable&BelongsTo $Categories
 *
 * @method FeedItemsCategory get($primaryKey, $options = [])
 * @method FeedItemsCategory newEntity($data = null, array $options = [])
 * @method FeedItemsCategory[] newEntities(array $data, array $options = [])
 * @method FeedItemsCategory|false save(EntityInterface $entity, $options = [])
 * @method FeedItemsCategory saveOrFail(EntityInterface $entity, $options = [])
 * @method FeedItemsCategory patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method FeedItemsCategory[] patchEntities($entities, array $data, array $options = [])
 * @method FeedItemsCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 */
class FeedItemsCategoriesTable extends Table
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

        $this->setTable('feed_items_categories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('FeedItems', [
            'foreignKey' => 'feed_item_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

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
        $rules->add($rules->existsIn(['feed_item_id'], 'FeedItems'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
