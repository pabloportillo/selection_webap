<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SolicitudHasExclusionMotivo Entity
 *
 * @property int $id
 * @property int $exclusion_motivo_id
 * @property int $solicitude_id
 *
 * @property \App\Model\Entity\ExclusionMotivo $exclusion_motivo
 * @property \App\Model\Entity\Solicitude $solicitude
 */
class SolicitudHasExclusionMotivo extends Entity
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
        'exclusion_motivo_id' => true,
        'solicitude_id' => true,
        'exclusion_motivo' => true,
        'solicitude' => true
    ];
}
