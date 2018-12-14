<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MeritosFixture
 *
 */
class MeritosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'Descripcion' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Puntuacion' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'convocatoria_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'categoria_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tipos_meritos_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_Meritos_Categorias1_idx' => ['type' => 'index', 'columns' => ['categoria_id'], 'length' => []],
            'fk_Meritos_convocatorias1_idx' => ['type' => 'index', 'columns' => ['convocatoria_id'], 'length' => []],
            'fk_meritos_tipos_meritos1_idx' => ['type' => 'index', 'columns' => ['tipos_meritos_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_Meritos_Categorias1' => ['type' => 'foreign', 'columns' => ['categoria_id'], 'references' => ['categorias', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_Meritos_solicitudes1' => ['type' => 'foreign', 'columns' => ['convocatoria_id'], 'references' => ['convocatorias', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_meritos_tipos_meritos1' => ['type' => 'foreign', 'columns' => ['tipos_meritos_id'], 'references' => ['tipos_meritos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'Descripcion' => 'Lorem ipsum dolor sit amet',
            'Puntuacion' => 'Lorem ip',
            'convocatoria_id' => 1,
            'categoria_id' => 1,
            'tipos_meritos_id' => 1
        ],
    ];
}
