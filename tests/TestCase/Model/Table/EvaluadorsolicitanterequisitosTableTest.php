<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EvaluadorsolicitanterequisitosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EvaluadorsolicitanterequisitosTable Test Case
 */
class EvaluadorsolicitanterequisitosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EvaluadorsolicitanterequisitosTable
     */
    public $Evaluadorsolicitanterequisitos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.evaluadorsolicitanterequisitos',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.requisitos',
        'app.solicitudes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Evaluadorsolicitanterequisitos') ? [] : ['className' => EvaluadorsolicitanterequisitosTable::class];
        $this->Evaluadorsolicitanterequisitos = TableRegistry::get('Evaluadorsolicitanterequisitos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Evaluadorsolicitanterequisitos);

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
