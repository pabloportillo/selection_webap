<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Accione Entity
 *
 * @property int $id
 * @property string $metodo
 * @property string $controlador
 * @property string $descripcion
 *
 * @property \App\Model\Entity\PerfilAccione[] $perfil_acciones
 */
class Accione extends Entity
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
        'metodo' => true,
        'controlador' => true,
        'descripcion' => true,
        'perfil_acciones' => true
    ];
}
