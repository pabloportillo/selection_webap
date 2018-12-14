<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MeritosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MeritosTable Test Case
 */
class MeritosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MeritosTable
     */
    public $Meritos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.meritos',
        'app.convocatorias',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.archivossubidos',
        'app.categorias',
        'app.exclusion_motivos',
        'app.solicitud_has_exclusion_motivos',
        'app.solicitudes',
        'app.solicitud_has_meritos',
        'app.evidencias',
        'app.solicitud_has_requisitos',
        'app.requisitos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Meritos') ? [] : ['className' => MeritosTable::class];
        $this->Meritos = TableRegistry::get('Meritos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Meritos);

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
