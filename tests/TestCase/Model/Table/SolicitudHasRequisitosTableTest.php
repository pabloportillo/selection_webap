<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolicitudHasRequisitosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolicitudHasRequisitosTable Test Case
 */
class SolicitudHasRequisitosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SolicitudHasRequisitosTable
     */
    public $SolicitudHasRequisitos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.exclusion_motivos',
        'app.solicitud_has_exclusion_motivos',
        'app.requisitos',
        'app.evidencias'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SolicitudHasRequisitos') ? [] : ['className' => SolicitudHasRequisitosTable::class];
        $this->SolicitudHasRequisitos = TableRegistry::get('SolicitudHasRequisitos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolicitudHasRequisitos);

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
