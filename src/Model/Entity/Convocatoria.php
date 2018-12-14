<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Convocatoria Entity
 *
 * @property int $id
 * @property string $Nombre
 * @property string $Descripcion
 * @property \Cake\I18n\FrozenDate $FechaCreacion
 * @property \Cake\I18n\FrozenDate $FechaAltaConvocatoria
 * @property \Cake\I18n\FrozenDate $FechaBajaConvocatoria
 * @property \Cake\I18n\FrozenDate $FechaAltaReclamacion
 * @property \Cake\I18n\FrozenDate $FechaBajaReclamacion
 * @property \Cake\I18n\FrozenDate $FechaEvaluacion
 * @property string $ListadoProvisional
 * @property string $ListadoDefinitivo
 * @property string $UltimaFase
 * @property bool $Visible
 * @property int $Usuario_id
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Archivossubido[] $archivossubidos
 * @property \App\Model\Entity\Categoria[] $categorias
 * @property \App\Model\Entity\ExclusionMotivo[] $exclusion_motivos
 * @property \App\Model\Entity\Merito[] $meritos
 * @property \App\Model\Entity\Requisito[] $requisitos
 * @property \App\Model\Entity\Solicitude[] $solicitudes
 */
class Convocatoria extends Entity
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
        'Descripcion' => true,
        'FechaCreacion' => true,
        'FechaAltaConvocatoria' => true,
        'FechaBajaConvocatoria' => true,
        'FechaAltaReclamacion' => true,
        'FechaBajaReclamacion' => true,
        'FechaAltaReclamacionEvaluacion' => true,
        'FechaBajaReclamacionEvaluacion' => true,        
        'FechaEvaluacion' => true,
        'FechaAdmitidos' => true,
        'ListadoAdmitidos' => true,
        'ListadoEvaluados' => true,
        'UltimaFase' => true,
        'Visible' => true,
        'Usuario_id' => true,
        'usuario' => true,
        'archivossubidos' => true,
        'categorias' => true,
        'exclusion_motivos' => true,
        'meritos' => true,
        'requisitos' => true,
        'solicitudes' => true
    ];
}
