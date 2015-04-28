<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.nota'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
