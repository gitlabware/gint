<?php
App::uses('Maquinaria', 'Model');

/**
 * Maquinaria Test Case
 *
 */
class MaquinariaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.maquinaria',
		'app.empleadostrabajo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Maquinaria = ClassRegistry::init('Maquinaria');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Maquinaria);

		parent::tearDown();
	}

}
