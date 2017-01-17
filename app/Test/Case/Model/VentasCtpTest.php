<?php
App::uses('VentasCtp', 'Model');

/**
 * VentasCtp Test Case
 *
 */
class VentasCtpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ventas_ctp',
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
		'app.pagos_ctp',
		'app.insumos_ctp',
		'app.totales_ctp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->VentasCtp = ClassRegistry::init('VentasCtp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->VentasCtp);

		parent::tearDown();
	}

}
