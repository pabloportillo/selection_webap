<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ExclusionMotivosController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ExclusionMotivosController Test Case
 */
class ExclusionMotivosControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}