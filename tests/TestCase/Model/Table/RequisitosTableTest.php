<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequisitosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequisitosTable Test Case
 */
class RequisitosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequisitosTable
     */
    public $Requisitos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.requisitos',
        'app.convocatorias',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.archivossubidos',
        'app.categorias',
        'app.meritos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Requisitos') ? [] : ['className' => RequisitosTable::class];
        $this->Requisitos = TableRegistry::get('Requisitos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Requisitos);

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
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
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
