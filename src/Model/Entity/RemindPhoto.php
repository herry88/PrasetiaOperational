<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RemindPhoto Entity
 *
 * @property int $id
 * @property int $remind_id
 * @property string $name
 * @property string $photo
 *
 * @property \App\Model\Entity\Remind $remind
 */
class RemindPhoto extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'remind_id' => true,
        'name' => true,
        'photo' => true,
        'remind' => true
    ];
}
