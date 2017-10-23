<?php
namespace App\Model\Table;

use App\Model\Entity\Customer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customer Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Groups
 */
class CustomerTable extends Table
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

        $this->table('customer');
        $this->displayField('ID');
        $this->primaryKey('ID');
        $this->belongsToMany('Groups', [
            'foreignKey' => 'customer_id',
            'targetForeignKey' => 'group_id',
            'joinTable' => 'customer_groups'
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
            ->add('ID', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('ID', 'create');

        $validator
            ->allowEmpty('NAME');

        $validator
            ->allowEmpty('ROLE');

        $validator
            ->allowEmpty('NIP');

        $validator
            ->allowEmpty('TELP');

        $validator
            ->allowEmpty('HANDPHONE');

        $validator
            ->allowEmpty('EMAIL');

        $validator
            ->allowEmpty('ADDRESS');

        $validator
            ->add('USER_CREATED', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('USER_CREATED');

        $validator
            ->add('USER_MODIFIED', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('USER_MODIFIED');

        $validator
            ->add('DATE_CREATED', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('DATE_CREATED');

        $validator
            ->add('DATE_MODIFIED', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('DATE_MODIFIED');

        $validator
            ->add('CUSTOMER_GROUP_ID', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('CUSTOMER_GROUP_ID');

        return $validator;
    }
}
