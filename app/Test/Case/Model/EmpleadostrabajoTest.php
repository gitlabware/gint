<?php
App::uses('Empleadostrabajo', 'Model');

/**
 * Empleadostrabajo Test Case
 *
 */
class EmpleadostrabajoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.empleadostrabajo',
		'app.empleado',
		'app.maquinaria',
		'app.trabajo',
		'app.user',
		'app.sucursale',
		'app.c_liente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Empleadostrabajo = ClassRegistry::init('Empleadostrabajo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Empleadostrabajo);

		parent::tearDown();
	}

}
