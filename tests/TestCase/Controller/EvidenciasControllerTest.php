<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EvidenciasController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EvidenciasController Test Case
 */
class EvidenciasControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.evidencias',
        'app.solicitud_has_meritos',
        'app.solicitud_has_requisitos',
        'app.solicitudes',
        'app.convocatorias',
        'app.usuarios',
        'app.perfiles',
        'app.empresas',
        'app.archivossubidos',
        'app.categorias',
        'app.meritos',
        'app.requisitos',
        'app.solicitud_has_exclusion_motivos',
        'app.exclusion_motivos'
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
