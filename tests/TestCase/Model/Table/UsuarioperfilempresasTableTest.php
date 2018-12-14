<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsuarioperfilempresasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsuarioperfilempresasTable Test Case
 */
class UsuarioperfilempresasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsuarioperfilempresasTable
     */
    public $Usuarioperfilempresas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.usuarioperfilempresas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Usuarioperfilempresas') ? [] : ['className' => UsuarioperfilempresasTable::class];
        $this->Usuarioperfilempresas = TableRegistry::get('Usuarioperfilempresas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Usuarioperfilempresas);

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
}
