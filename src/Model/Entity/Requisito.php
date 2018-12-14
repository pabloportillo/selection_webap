<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Requisito Entity
 *
 * @property int $id
 * @property string $Descripcion
 * @property int $convocatoria_id
 *
 * @property \App\Model\Entity\Convocatoria $convocatoria
 */
class Requisito extends Entity
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
        'Descripcion' => true,
        'motivo_exclusion' => true,
        'convocatoria_id' => true,
        'convocatoria' => true
    ];
}
