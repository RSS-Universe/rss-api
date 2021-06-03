<?php

namespace App\Model\Table;

use App\Model\Entity\Creator;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Muffin\Slug\Model\Behavior\SlugBehavior;

/**
 * Creators Model
 *
 * @property FeedItemsTable&HasMany $FeedItems
 *
 * @method Creator get($primaryKey, $options = [])
 * @method Creator newEntity($data = null, array $options = [])
 * @method Creator[] newEntities(array $data, array $options = [])
 * @method Creator|false save(EntityInterface $entity, $options = [])
 * @method Creator saveOrFail(EntityInterface $entity, $options = [])
 * @method Creator patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Creator[] patchEntities($entities, array $data, array $options = [])
 * @method Creator findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 * @mixin SlugBehavior
 */
class CreatorsTable extends Table
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

        $this->setTable('creators');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Slug.Slug');

        $this->hasMany('FeedItems', [
            'foreignKey' => 'creator_id',
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
            ->maxLength('name', 200)
            ->notEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 200)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }

    public function findOrCreateId(string $name): string
    {
        $entity = $this->findOrCreate(compact('name'));
        return $entity->id;
    }
}
