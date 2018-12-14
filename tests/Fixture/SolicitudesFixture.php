<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolicitudesFixture
 *
 */
class SolicitudesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'convocatoria_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'usuario_solicitante' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'usuario_evaluador' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'autoPuntuacion' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'reclamacion' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'puntuacionEvaluacion' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'aceptado' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'descripcion_reclamacion' => ['type' => 'string', 'length' => 3550, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fechaCreacion' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'fechaEvaluacion' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'fechaReclamacion' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_solicitudes_convocatorias_idx' => ['type' => 'index', 'columns' => ['convocatoria_id'], 'length' => []],
            'fk_solicitudes_usuarios1_idx' => ['type' => 'index', 'columns' => ['usuario_solicitante'], 'length' => []],
            'fk_solicitudes_usuarios2_idx' => ['type' => 'index', 'columns' => ['usuario_evaluador'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_solicitudes_convocatorias' => ['type' => 'foreign', 'columns' => ['convocatoria_id'], 'references' => ['convocatorias', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_solicitudes_usuarios1' => ['type' => 'foreign', 'columns' => ['usuario_solicitante'], 'references' => ['usuarios', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_solicitudes_usuarios2' => ['type' => 'foreign', 'columns' => ['usuario_evaluador'], 'references' => ['usuarios', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'convocatoria_id' => 1,
            'usuario_solicitante' => 1,
            'usuario_evaluador' => 1,
            'autoPuntuacion' => 1.5,
            'reclamacion' => 1,
            'puntuacionEvaluacion' => 1.5,
            'aceptado' => 1,
            'descripcion_reclamacion' => 'Lorem ipsum dolor sit amet',
            'fechaCreacion' => '2018-05-29',
            'fechaEvaluacion' => '2018-05-29',
            'fechaReclamacion' => '2018-05-29'
        ],
    ];
}
