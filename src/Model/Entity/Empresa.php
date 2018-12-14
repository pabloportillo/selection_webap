<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Empresa Entity
 *
 * @property int $id
 * @property string $CIF
 * @property string $NombreEmpresa
 * @property string $NombreContacto
 * @property string $ApellidoContacto
 * @property string $TelefonoContacto
 * @property string $DeclaracionResponsable
 */
class Empresa extends Entity
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
        'CIF' => true,
        'NombreEmpresa' => true,
        'NombreContacto' => true,
        'ApellidoContacto' => true,
        'TelefonoContacto' => true,
        'DeclaracionResponsable' => true
    ];
}
