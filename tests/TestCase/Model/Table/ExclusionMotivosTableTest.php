<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExclusionMotivosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExclusionMotivosTable Test Case
 */
class ExclusionMotivosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExclusionMotivosTable
     */
    public $ExclusionMotivos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exclusion_motivos',
        'app.convocatorias',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.archivossubidos',
        'app.categorias',
        'app.meritos',
        'app.requisitos',
        'app.solicitud_has_exclusion_motivos',
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
        $config = TableRegistry::exists('ExclusionMotivos') ? [] : ['className' => ExclusionMotivosTable::class];
        $this->ExclusionMotivos = TableRegistry::get('ExclusionMotivos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExclusionMotivos);

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
