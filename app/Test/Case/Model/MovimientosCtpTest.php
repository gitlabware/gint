<?php
App::uses('MovimientosCtp', 'Model');

/**
 * MovimientosCtp Test Case
 *
 */
class MovimientosCtpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.movimientos_ctp',
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
		'app.insumos_ctp',
		'app.totales_ctp',
		'app.ventas_ctp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MovimientosCtp = ClassRegistry::init('MovimientosCtp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MovimientosCtp);

		parent::tearDown();
	}

}
