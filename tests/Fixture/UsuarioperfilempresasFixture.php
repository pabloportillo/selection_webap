<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsuarioperfilempresasFixture
 *
 */
class UsuarioperfilempresasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'Usuario_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Perfile_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Empresa_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_UsuarioPerfilEmpresa_Usuario_idx' => ['type' => 'index', 'columns' => ['Usuario_id'], 'length' => []],
            'fk_UsuarioPerfilEmpresa_Perfil1_idx' => ['type' => 'index', 'columns' => ['Perfile_id'], 'length' => []],
            'fk_UsuarioPerfilEmpresa_Empresa1_idx' => ['type' => 'index', 'columns' => ['Empresa_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['Usuario_id', 'Perfile_id', 'Empresa_id'], 'length' => []],
            'fk_UsuarioPerfilEmpresa_Empresa1' => ['type' => 'foreign', 'columns' => ['Empresa_id'], 'references' => ['empresas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_UsuarioPerfilEmpresa_Perfil1' => ['type' => 'foreign', 'columns' => ['Perfile_id'], 'references' => ['perfiles', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_UsuarioPerfilEmpresa_Usuario' => ['type' => 'foreign', 'columns' => ['Usuario_id'], 'references' => ['usuarios', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'Usuario_id' => 1,
            'Perfile_id' => 1,
            'Empresa_id' => 1
        ],
    ];
}
