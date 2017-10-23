<?php
namespace App\Model\Table;

use App\Model\Entity\Object;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Objects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Types
 * @property \Cake\ORM\Association\HasMany $Reminds
 */
class ObjectsTable extends Table
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

        $this->table('objects');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('Types', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER'
        ]);
		$this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinCompany' => 'INNER'
        ]);
        $this->hasMany('Reminds', [
            'foreignKey' => 'object_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('PIC');

        $validator
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
			->requirePresence('type_id', 'create')
            ->notEmpty('type_id');
			
		$validator
			->requirePresence('company_id', 'create')
            ->notEmpty('company_id');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('telp');

        $validator
            ->allowEmpty('location');

        $validator
            ->allowEmpty('coordinator');

        $validator
			->requirePresence('plat', 'create')
            ->notEmpty('plat');

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
        $rules->add($rules->existsIn(['type_id'], 'Types'));
        return $rules;
    }
}
