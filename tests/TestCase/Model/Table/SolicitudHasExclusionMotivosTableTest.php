<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolicitudHasExclusionMotivosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolicitudHasExclusionMotivosTable Test Case
 */
class SolicitudHasExclusionMotivosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SolicitudHasExclusionMotivosTable
     */
    public $SolicitudHasExclusionMotivos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.solicitud_has_exclusion_motivos',
        'app.exclusion_motivos',
        'app.convocatorias',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.archivossubidos',
        'app.categorias',
        'app.meritos',
        'app.requisitos',
        'app.solicitudes',
        'app.solicitud_has_meritos',
        'app.solicitud_has_requisitos',
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
        $config = TableRegistry::exists('SolicitudHasExclusionMotivos') ? [] : ['className' => SolicitudHasExclusionMotivosTable::class];
        $this->SolicitudHasExclusionMotivos = TableRegistry::get('SolicitudHasExclusionMotivos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolicitudHasExclusionMotivos);

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
