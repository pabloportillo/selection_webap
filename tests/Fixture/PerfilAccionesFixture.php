<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PerfilAccionesFixture
 *
 */
class PerfilAccionesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'perfile_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'accione_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_perfiles_entity_perfiles1_idx' => ['type' => 'index', 'columns' => ['perfile_id'], 'length' => []],
            'fk_perfiles_entity_acciones1_idx' => ['type' => 'index', 'columns' => ['accione_id'], 'length' => []],
        ],
        '_constraints' => [
            'fk_perfiles_entity_acciones1' => ['type' => 'foreign', 'columns' => ['accione_id'], 'references' => ['acciones', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_perfiles_entity_perfiles1' => ['type' => 'foreign', 'columns' => ['perfile_id'], 'references' => ['perfiles', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'perfile_id' => 1,
            'accione_id' => 1
        ],
    ];
}
