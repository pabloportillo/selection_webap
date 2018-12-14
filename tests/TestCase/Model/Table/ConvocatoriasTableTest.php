<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConvocatoriasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConvocatoriasTable Test Case
 */
class ConvocatoriasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConvocatoriasTable
     */
    public $Convocatorias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.convocatorias',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.archivossubidos',
        'app.categorias',
        'app.meritos',
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
        $config = TableRegistry::exists('Convocatorias') ? [] : ['className' => ConvocatoriasTable::class];
        $this->Convocatorias = TableRegistry::get('Convocatorias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Convocatorias);

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
