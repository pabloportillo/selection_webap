<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EvidenciasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EvidenciasTable Test Case
 */
class EvidenciasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EvidenciasTable
     */
    public $Evidencias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.evidencias',
        'app.solicitud_has_requisitos',
        'app.solicitudes',
        'app.convocatorias',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.archivossubidos',
        'app.categorias',
        'app.meritos',
        'app.tipos_meritos',
        'app.solicitud_has_meritos',
        'app.requisitos',
        'app.solicitud_has_exclusion_motivos',
        'app.exclusion_motivos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Evidencias') ? [] : ['className' => EvidenciasTable::class];
        $this->Evidencias = TableRegistry::get('Evidencias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Evidencias);

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
