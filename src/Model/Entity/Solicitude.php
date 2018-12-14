<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Solicitude Entity
 *
 * @property int $id
 * @property int $convocatoria_id
 * @property int $usuario_solicitante
 * @property int $usuario_evaluador
 * @property float $autoPuntuacion
 * @property bool $reclamacion
 * @property float $puntuacionEvaluacion
 * @property bool $aceptado
 * @property string $descripcion_reclamacion
 * @property \Cake\I18n\FrozenDate $fechaCreacion
 * @property \Cake\I18n\FrozenDate $fechaEvaluacion
 * @property \Cake\I18n\FrozenDate $fechaReclamacion
 *
 * @property \App\Model\Entity\Convocatoria $convocatoria
 * @property \App\Model\Entity\SolicitudHasExclusionMotivo[] $solicitud_has_exclusion_motivos
 * @property \App\Model\Entity\SolicitudHasMerito[] $solicitud_has_meritos
 * @property \App\Model\Entity\SolicitudHasRequisito[] $solicitud_has_requisitos
 */
class Solicitude extends Entity
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
        'convocatoria_id' => true,
        'usuario_solicitante' => true,
        'usuario_evaluador' => true,
        'estadoSolicitud' => true,
        'autoPuntuacion' => true,
        'puntuacionConocimiento' => true,
        'puntuacionPsicotecnico' => true,
        'puntuacionEntrevista' => true,
        'reclamacion' => true,
        'puntuacionEvaluacion' => true,
        'aceptado' => true,
        'reclamacionEvaluacion' => true,
        'fechaCreacion' => true,
        'fechaEvaluacion' => true,
        'fechaReclamacion' => true,
        'fechaReclamacionEvaluacion' => true,
        'convocatoria' => true,
        'solicitud_has_exclusion_motivos' => true,
        'solicitud_has_meritos' => true,
        'solicitud_has_requisitos' => true,
        'leido_declaracion_responsable' => true,
        'valido_evidencias_requisitos' => true,
        'valido_evidencias_meritos' => true,
        'valido_evaluacion_requisitos ' => true
    ];
}
