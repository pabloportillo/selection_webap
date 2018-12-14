<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Categoria Entity
 *
 * @property int $id
 * @property string $Descripcion
 * @property string $PuntuacionMax
 * @property int $convocatoria_id
 *
 * @property \App\Model\Entity\Convocatoria $convocatoria
 * @property \App\Model\Entity\Merito[] $meritos
 */
class Categoria extends Entity
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
        'PuntuacionMax' => true,
        'convocatoria_id' => true,
        'convocatoria' => true,
        'meritos' => true
    ];
}
