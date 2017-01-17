<?php
App::uses('PagosCtp', 'Model');

/**
 * PagosCtp Test Case
 *
 */
class PagosCtpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pagos_ctp',
		'app.trabajos_ctp',
		'app.sucursale',
		'app.user',
		'app.cajachica',
		'app.categoriasmonto',
		'app.hojasproduccione',
		'app.trabajo',
		'app.cliente',
		'app.factura',
		'app.parametrosfactura',
		'app.tipotrabajo',
		'app.hojastipostrabajo',
		'app.inventario',
		'app.insumo',
		'app.categoria',
		'app.movimiento',
		'app.nota',
		'app.clientes_ctp',
		'app.ventas_ctp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PagosCtp = ClassRegistry::init('PagosCtp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PagosCtp);

		parent::tearDown();
	}

}
