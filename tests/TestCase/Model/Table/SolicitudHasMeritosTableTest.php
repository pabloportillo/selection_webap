<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolicitudHasMeritosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolicitudHasMeritosTable Test Case
 */
class SolicitudHasMeritosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SolicitudHasMeritosTable
     */
    public $SolicitudHasMeritos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.solicitud_has_meritos',
        'app.solicitudes',
        'app.convocatorias',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.archivossubidos',
        'app.categorias',
        'app.meritos',
        'app.tipos_meritos',
        'app.exclusion_motivos',
        'app.solicitud_has_exclusion_motivos',
        'app.requisitos',
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
        $config = TableRegistry::exists('SolicitudHasMeritos') ? [] : ['className' => SolicitudHasMeritosTable::class];
        $this->SolicitudHasMeritos = TableRegistry::get('SolicitudHasMeritos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SolicitudHasMeritos);

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
