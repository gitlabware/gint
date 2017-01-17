<?php
App::uses('RegistrosCtp', 'Model');

/**
 * RegistrosCtp Test Case
 *
 */
class RegistrosCtpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.registros_ctp',
		'app.user',
		'app.sucursale',
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
		'app.movimientos_ctp',
		'app.insumos_ctp',
		'app.totales_ctp',
		'app.ventas_ctp',
		'app.trabajos_ctp',
		'app.clientes_ctp',
		'app.pagos_ctp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RegistrosCtp = ClassRegistry::init('RegistrosCtp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RegistrosCtp);

		parent::tearDown();
	}

}
