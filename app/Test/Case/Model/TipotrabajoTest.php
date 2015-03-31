<?php
App::uses('Tipotrabajo', 'Model');

/**
 * Tipotrabajo Test Case
 *
 */
class TipotrabajoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tipotrabajo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tipotrabajo = ClassRegistry::init('Tipotrabajo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tipotrabajo);

		parent::tearDown();
	}

}
