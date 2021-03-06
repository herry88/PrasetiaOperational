<?php
namespace App\Model\Table;

use App\Model\Entity\Remind;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reminds Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Objects
 * @property \Cake\ORM\Association\BelongsTo $Items
 */
class RemindsTable extends Table
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

        $this->table('reminds');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Objects', [
            'foreignKey' => 'object_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('RemindPhotos', [
            'foreignKey' => 'remind_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('deadline', 'valid', ['rule' => 'date'])
            ->requirePresence('deadline', 'create')
            ->notEmpty('deadline');

        $validator
            ->add('next', 'valid', ['rule' => 'date'])
            ->requirePresence('next', 'create')
            ->notEmpty('next');

        $validator
            ->requirePresence('state', 'create')
            ->notEmpty('state');
			
		$validator
            ->requirePresence('item_id', 'create')
            ->notEmpty('item_id');
			

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['object_id'], 'Objects'));
        $rules->add($rules->existsIn(['item_id'], 'Items'));
        return $rules;
    }
}
