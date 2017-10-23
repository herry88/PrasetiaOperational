<?php
namespace App\Model\Table;

use App\Model\Entity\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 */
class EventsTable extends Table
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

        $this->table('events');
        $this->displayField('ID');
        $this->primaryKey('ID');
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
            ->add('DATE_START', 'valid', ['rule' => 'date'])
            ->allowEmpty('DATE_START');

        $validator
            ->add('DATE_END', 'valid', ['rule' => 'date'])
            ->allowEmpty('DATE_END');

        $validator
            ->allowEmpty('REMARK');

        $validator
            ->add('MIN_PARTICIPANT', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('MIN_PARTICIPANT');

        $validator
            ->add('MAX_PARTICIPANT', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('MAX_PARTICIPANT');

        $validator
            ->allowEmpty('LOCATION');

        $validator
            ->allowEmpty('LOCATION_ADDRESS');

        $validator
            ->allowEmpty('TUTOR');

        $validator
            ->allowEmpty('PHONE');

        $validator
            ->allowEmpty('EMAIL');

        $validator
            ->add('REGISTRATION_FEE', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('REGISTRATION_FEE');

        $validator
            ->add('PRICE', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('PRICE');

        $validator
            ->allowEmpty('FACILITY');

        $validator
            ->add('EVENT_STATUS_ID', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('EVENT_STATUS_ID');

        $validator
            ->allowEmpty('DOCUMENT');

        $validator
            ->allowEmpty('DOCUMENT_NAME');

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

        return $validator;
    }
}
