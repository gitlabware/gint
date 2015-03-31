<?php
App::uses('Hojastipostrabajo', 'Model');

/**
 * Hojastipostrabajo Test Case
 *
 */
class HojastipostrabajoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hojastipostrabajo',
		'app.trabajo',
		'app.user',
		'app.sucursale',
		'app.c_liente',
		'app.tipotrabajo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Hojastipostrabajo = ClassRegistry::init('Hojastipostrabajo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Hojastipostrabajo);

		parent::tearDown();
	}

}
