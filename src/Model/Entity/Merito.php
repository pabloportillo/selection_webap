<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Merito Entity
 *
 * @property int $id
 * @property string $Descripcion
 * @property string $Puntuacion
 * @property int $convocatoria_id
 * @property int $categoria_id
 * @property int $tipos_meritos_id
 *
 * @property \App\Model\Entity\Convocatoria $convocatoria
 * @property \App\Model\Entity\Categoria $categoria
 */
class Merito extends Entity
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
        'Puntuacion' => true,
        'convocatoria_id' => true,
        'categoria_id' => true,
        'tipos_meritos_id' => true,
        'convocatoria' => true,
        'categoria' => true
    ];
}
