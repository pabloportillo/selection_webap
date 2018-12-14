<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArchivossubidosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArchivossubidosTable Test Case
 */
class ArchivossubidosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArchivossubidosTable
     */
    public $Archivossubidos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.archivossubidos',
        'app.convocatorias',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.categorias',
        'app.meritos',
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
        $config = TableRegistry::exists('Archivossubidos') ? [] : ['className' => ArchivossubidosTable::class];
        $this->Archivossubidos = TableRegistry::get('Archivossubidos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Archivossubidos);

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
