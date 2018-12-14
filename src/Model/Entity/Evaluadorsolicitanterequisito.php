<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Evaluadorsolicitanterequisito Entity
 *
 * @property int $id
 * @property string $DescripcionEvaluacion
 * @property bool $Validado
 * @property \Cake\I18n\FrozenDate $FechaCreacion
 * @property \Cake\I18n\FrozenDate $FechaEvaluacion
 * @property bool $Reclamacion
 * @property int $Usuario_id
 * @property int $Requisito_id
 * @property int $solicitante_id
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Requisito $requisito
 */
class Evaluadorsolicitanterequisito extends Entity
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
        'DescripcionEvaluacion' => true,
        'Validado' => true,
        'FechaCreacion' => true,
        'FechaEvaluacion' => true,
        'Reclamacion' => true,
        'Usuario_id' => true,
        'Requisito_id' => true,
        'solicitante_id' => true,
        'usuario' => true,
        'requisito' => true
    ];
}
