<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PerfilAccionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PerfilAccionesTable Test Case
 */
class PerfilAccionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PerfilAccionesTable
     */
    public $PerfilAcciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.perfil_acciones',
        'app.perfiles',
        'app.acciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PerfilAcciones') ? [] : ['className' => PerfilAccionesTable::class];
        $this->PerfilAcciones = TableRegistry::get('PerfilAcciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PerfilAcciones);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
