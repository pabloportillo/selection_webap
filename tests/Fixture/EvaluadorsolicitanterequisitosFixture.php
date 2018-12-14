<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EvaluadorsolicitanterequisitosFixture
 *
 */
class EvaluadorsolicitanterequisitosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'DescripcionEvaluacion' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Validado' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'FechaCreacion' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'FechaEvaluacion' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'Reclamacion' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'Usuario_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Requisito_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'solicitante_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_EvaluadorSolicitanteRequisitos_Usuarios1_idx' => ['type' => 'index', 'columns' => ['Usuario_id'], 'length' => []],
            'fk_EvaluadorSolicitanteRequisitos_Requisitos1_idx' => ['type' => 'index', 'columns' => ['Requisito_id'], 'length' => []],
            'fk_evaluadorsolicitanterequisitos_solicitantes1_idx' => ['type' => 'index', 'columns' => ['solicitante_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'evaluadorsolicitanterequisitos_ibfk_1' => ['type' => 'foreign', 'columns' => ['solicitante_id'], 'references' => ['usuarios', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_EvaluadorSolicitanteRequisitos_Requisitos1' => ['type' => 'foreign', 'columns' => ['Requisito_id'], 'references' => ['requisitos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_EvaluadorSolicitanteRequisitos_Usuarios1' => ['type' => 'foreign', 'columns' => ['Usuario_id'], 'references' => ['usuarios', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'DescripcionEvaluacion' => 'Lorem ipsum dolor sit amet',
            'Validado' => 1,
            'FechaCreacion' => '2018-03-22',
            'FechaEvaluacion' => '2018-03-22',
            'Reclamacion' => 1,
            'Usuario_id' => 1,
            'Requisito_id' => 1,
            'solicitante_id' => 1
        ],
    ];
}
