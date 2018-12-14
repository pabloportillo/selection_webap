<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolicitantesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolicitantesTable Test Case
 */
class SolicitantesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SolicitantesTable
     */
    public $Solicitantes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.solicitantes',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.evaluadorsolicitanterequisitos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Solicitantes') ? [] : ['className' => SolicitantesTable::class];
        $this->Solicitantes = TableRegistry::get('Solicitantes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Solicitantes);

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
