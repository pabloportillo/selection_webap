<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Evidencia Entity
 *
 * @property int $id
 * @property string|resource $evidencia
 * @property string $descripcionEvidencia
 * @property string $nombre_archivo
 * @property string $extension
 * @property string $tamanho
 * @property int $solicitud_has_requisitos_id
 * @property int $solicitud_has_meritos_id
 * @property int $reclamacion_id
 *
 * @property \App\Model\Entity\SolicitudHasRequisito $solicitud_has_requisito
 * @property \App\Model\Entity\SolicitudHasMerito $solicitud_has_merito
 */
class Evidencia extends Entity
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
        'evidencia' => true,
        'descripcionEvidencia' => true,
        'nombre_archivo' => true,
        'extension' => true,
        'tamanho' => true,
        'solicitud_has_requisitos_id' => true,
        'solicitud_has_meritos_id' => true,
        'reclamacion_id' => true,
        'solicitud_has_requisito' => true,
        'solicitud_has_merito' => true
    ];
}