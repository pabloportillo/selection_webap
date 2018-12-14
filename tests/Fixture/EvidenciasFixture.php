<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EvidenciasFixture
 *
 */
class EvidenciasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'evidencia' => ['type' => 'binary', 'length' => 16777215, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'descripcionEvidencia' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nombre_archivo' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'extension' => ['type' => 'string', 'length' => 5, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'tamanho' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'solicitud_has_requisitos_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'solicitud_has_meritos_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'reclamacion_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_evidencias_solicitud_has_requisitos1_idx' => ['type' => 'index', 'columns' => ['solicitud_has_requisitos_id'], 'length' => []],
            'fk_evidencias_solicitud_has_meritos1_idx' => ['type' => 'index', 'columns' => ['solicitud_has_meritos_id'], 'length' => []],
            'fk_evidencias_reclamaciones1' => ['type' => 'index', 'columns' => ['reclamacion_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'evidencias_ibfk_1' => ['type' => 'foreign', 'columns' => ['reclamacion_id'], 'references' => ['reclamaciones', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_evidencias_solicitud_has_meritos1' => ['type' => 'foreign', 'columns' => ['solicitud_has_meritos_id'], 'references' => ['solicitud_has_meritos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_evidencias_solicitud_has_requisitos1' => ['type' => 'foreign', 'columns' => ['solicitud_has_requisitos_id'], 'references' => ['solicitud_has_requisitos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'evidencia' => 'Lorem ipsum dolor sit amet',
            'descripcionEvidencia' => 'Lorem ipsum dolor sit amet',
            'nombre_archivo' => 'Lorem ipsum dolor sit amet',
            'extension' => 'Lor',
            'tamanho' => 'Lorem ipsum dolor sit amet',
            'solicitud_has_requisitos_id' => 1,
            'solicitud_has_meritos_id' => 1,
            'reclamacion_id' => 1
        ],
    ];
}
