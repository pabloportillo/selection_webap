<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PerfilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PerfilesTable Test Case
 */
class PerfilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PerfilesTable
     */
    public $Perfiles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.perfiles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Perfiles') ? [] : ['className' => PerfilesTable::class];
        $this->Perfiles = TableRegistry::get('Perfiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Perfiles);

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
