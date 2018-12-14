<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsuariosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsuariosTable Test Case
 */
class UsuariosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsuariosTable
     */
    public $Usuarios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.usuarios',
        'app.perfiles',
        'app.empresas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Usuarios') ? [] : ['className' => UsuariosTable::class];
        $this->Usuarios = TableRegistry::get('Usuarios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Usuarios);

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
     * Test encPasswordCheckFailed method
     *
     * @return void
     */
    public function testEncPasswordCheckFailed()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isValidIdNumber method
     *
     * @return void
     */
    public function testIsValidIdNumber()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isValidNIF method
     *
     * @return void
     */
    public function testIsValidNIF()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isValidNIFFormat method
     *
     * @return void
     */
    public function testIsValidNIFFormat()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getNIFCheckDigit method
     *
     * @return void
     */
    public function testGetNIFCheckDigit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isValidNIE method
     *
     * @return void
     */
    public function testIsValidNIE()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isValidNIEFormat method
     *
     * @return void
     */
    public function testIsValidNIEFormat()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test respectsDocPattern method
     *
     * @return void
     */
    public function testRespectsDocPattern()
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
