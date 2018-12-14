<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Log Entity
 *
 * @property int $id
 * @property int $solicitudes_id
 * @property int $usuarios_id
 * @property string $descripcion
 * @property \Cake\I18n\FrozenTime $fecha
 *
 * @property \App\Model\Entity\Solicitude $solicitude
 * @property \App\Model\Entity\Usuario $usuario
 */
class Log extends Entity
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
        'solicitudes_id' => true,
        'usuarios_id' => true,
        'descripcion' => true,
        'fecha' => true,
        'solicitude' => true,
        'usuario' => true
    ];
}
