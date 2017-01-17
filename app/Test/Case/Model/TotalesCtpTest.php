<?php
App::uses('TotalesCtp', 'Model');

/**
 * TotalesCtp Test Case
 *
 */
class TotalesCtpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.totales_ctp',
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
		'app.ventas_ctp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TotalesCtp = ClassRegistry::init('TotalesCtp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TotalesCtp);

		parent::tearDown();
	}

}