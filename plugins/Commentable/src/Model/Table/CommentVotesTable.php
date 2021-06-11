<?php

namespace Commentable\Model\Table;

use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Commentable\Model\Entity\CommentVote;

/**
 * CommentVotes Model
 *
 * @property UsersTable&BelongsTo $Users
 * @property CommentsTable&BelongsTo $Comments
 *
 * @method CommentVote get($primaryKey, $options = [])
 * @method CommentVote newEntity($data = null, array $options = [])
 * @method CommentVote[] newEntities(array $data, array $options = [])
 * @method CommentVote|false save(EntityInterface $entity, $options = [])
 * @method CommentVote saveOrFail(EntityInterface $entity, $options = [])
 * @method CommentVote patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method CommentVote[] patchEntities($entities, array $data, array $options = [])
 * @method CommentVote findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 */
class CommentVotesTable extends Table
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

        $this->setTable('comment_votes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Commentable.Users',
        ]);

        $this->addBehavior('CounterCache', [
            'Comments' => [
                'vote_count',
                'vote_positive' => [
                    'conditions' => ['CommentVotes.is_positive' => true]
                ],
            ]
        ]);
        $this->belongsTo('Comments', [
            'foreignKey' => 'comment_id',
            'joinType' => 'INNER',
            'className' => 'Commentable.Comments',
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
            ->boolean('is_positive')
            ->requirePresence('is_positive', 'create')
            ->notEmptyString('is_positive');

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
        $rules->add($rules->existsIn(['comment_id'], 'Comments'));

        return $rules;
    }

    /**
     * @param User $user
     * @param string $comment_id
     * @param bool $is_positive
     * @return bool|CommentVote
     */
    public function saveVote(User $user, string $comment_id, bool $is_positive)
    {
        $user_id = $user->id;
        /** @var CommentVote $vote */
        $vote = $this->find()->where(compact('user_id', 'comment_id'))->first();

        if ($vote) {
            if ($vote->is_positive === $is_positive) {
                return $vote;
            } else {
                return $this->delete($vote);
            }
        } else {
            $vote = $this->newEntity(compact('user_id', 'comment_id', 'is_positive'));
            return !!$this->save($vote);
        }
    }
}
