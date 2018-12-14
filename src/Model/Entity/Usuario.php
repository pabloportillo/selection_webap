<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property string $Nombre
 * @property string $Apellidos
 * @property string $Dni
 * @property string $Direccion
 * @property string $Email
 * @property string $Contraseña
 * @property string $Telefono
 * @property int $Perfile_id
 * @property int $Empresa_id
 * @property bool $Activo
 * @property string $Localidad
 * @property string $Cp
 * @property string|resource $Foto
 *
 * @property \App\Model\Entity\Perfile $perfile
 * @property \App\Model\Entity\Empresa $empresa
 */
class Usuario extends Entity
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
        'Nombre' => true,
        'Apellidos' => true,
        'Dni' => true,
        'Direccion' => true,
        'Email' => true,
        'Contraseña' => true,
        'Telefono' => true,
        'Perfile_id' => true,
        'Empresa_id' => true,
        'Activo' => true,
        'Localidad' => true,
        'Cp' => true,
        'Foto' => true,
        'perfile' => true,
        'empresa' => true,
        'fecha_token' => true
    ];
}
