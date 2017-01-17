<?php
App::uses('ClientesCtp', 'Model');

/**
 * ClientesCtp Test Case
 *
 */
class ClientesCtpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.clientes_ctp',
		'app.trabajos_ctp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientesCtp = ClassRegistry::init('ClientesCtp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientesCtp);

		parent::tearDown();
	}

}
