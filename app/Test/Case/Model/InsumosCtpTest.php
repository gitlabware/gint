<?php
App::uses('InsumosCtp', 'Model');

/**
 * InsumosCtp Test Case
 *
 */
class InsumosCtpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->InsumosCtp = ClassRegistry::init('InsumosCtp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InsumosCtp);

		parent::tearDown();
	}

}
