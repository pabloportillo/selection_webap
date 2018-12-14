<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolicitudHasExclusionMotivosFixture
 *
 */
class SolicitudHasExclusionMotivosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'exclusion_motivo_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'solicitude_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_solicitud_has_exclusion_motivos_exclusion_motivos1_idx' => ['type' => 'index', 'columns' => ['exclusion_motivo_id'], 'length' => []],
            'fk_solicitud_has_exclusion_motivos_solicitudes1_idx' => ['type' => 'index', 'columns' => ['solicitude_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_solicitud_has_exclusion_motivos_exclusion_motivos1' => ['type' => 'foreign', 'columns' => ['exclusion_motivo_id'], 'references' => ['exclusion_motivos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_solicitud_has_exclusion_motivos_solicitudes1' => ['type' => 'foreign', 'columns' => ['solicitude_id'], 'references' => ['solicitudes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'exclusion_motivo_id' => 1,
            'solicitude_id' => 1
        ],
    ];
}
