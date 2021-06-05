<?php

namespace Commentable\Model\Table;

use App\Model\Table\UsersTable;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\Behavior\TreeBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Commentable\Model\Entity\Comment;

/**
 * Comments Model
 *
 * @property UsersTable&BelongsTo $Users
 * @property CommentsTable&BelongsTo $ParentComments
 * @property CommentsTable&HasMany $ChildComments
 *
 * @method Comment get($primaryKey, $options = [])
 * @method Comment newEntity($data = null, array $options = [])
 * @method Comment[] newEntities(array $data, array $options = [])
 * @method Comment|false save(EntityInterface $entity, $options = [])
 * @method Comment saveOrFail(EntityInterface $entity, $options = [])
 * @method Comment patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Comment[] patchEntities($entities, array $data, array $options = [])
 * @method Comment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 * @mixin TreeBehavior
 */
class CommentsTable extends Table
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

        $this->setTable('comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Commentable.Users',
        ]);
        $this->belongsTo('ParentComments', [
            'className' => 'Commentable.Comments',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildComments', [
            'className' => 'Commentable.Comments',
            'foreignKey' => 'parent_id',
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
            ->scalar('model_name')
            ->maxLength('model_name', 200)
            ->notEmptyString('model_name');

        $validator
            ->scalar('model_identifier')
            ->maxLength('model_identifier', 50)
            ->notEmptyString('model_identifier');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentComments'));

        return $rules;
    }
}
