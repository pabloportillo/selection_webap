<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SolicitudHasRequisito Entity
 *
 * @property int $id
 * @property int $solicitude_id
 * @property int $requisito_id
 * @property string $valido
 *
 * @property \App\Model\Entity\Solicitude $solicitude
 * @property \App\Model\Entity\Requisito $requisito
 * @property \App\Model\Entity\Evidencia $evidencia
 */
class SolicitudHasRequisito extends Entity
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
        'solicitude_id' => true,
        'requisito_id' => true,
        'valido' => true,
        'solicitude' => true,
        'requisito' => true,
        'evidencia' => true
    ];
}
