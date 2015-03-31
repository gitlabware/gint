<?php
App::uses('Formato', 'Model');

/**
 * Formato Test Case
 *
 */
class FormatoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.formato',
		'app.tipotrabajo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Formato = ClassRegistry::init('Formato');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Formato);

		parent::tearDown();
	}

}
