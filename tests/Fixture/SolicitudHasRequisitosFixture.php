<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolicitudHasRequisitosFixture
 *
 */
class SolicitudHasRequisitosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'solicitude_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'requisito_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'valido' => ['type' => 'string', 'fixed' => true, 'length' => 1, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_solicitud_has_requisitos_solicitudes1_idx' => ['type' => 'index', 'columns' => ['solicitude_id'], 'length' => []],
            'fk_solicitud_has_requisitos_requisitos1_idx' => ['type' => 'index', 'columns' => ['requisito_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_solicitud_has_requisitos_requisitos1' => ['type' => 'foreign', 'columns' => ['requisito_id'], 'references' => ['requisitos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_solicitud_has_requisitos_solicitudes1' => ['type' => 'foreign', 'columns' => ['solicitude_id'], 'references' => ['solicitudes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'solicitude_id' => 1,
            'requisito_id' => 1,
            'valido' => 'Lorem ipsum dolor sit ame'
        ],
    ];
}