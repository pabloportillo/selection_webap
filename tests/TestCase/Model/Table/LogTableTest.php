<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogTable Test Case
 */
class LogTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LogTable
     */
    public $Log;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.log',
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
        'app.exclusion_motivos',
        'app.solicitud_has_requisitos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Log') ? [] : ['className' => LogTable::class];
        $this->Log = TableRegistry::get('Log', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Log);

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
