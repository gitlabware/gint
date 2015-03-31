<?php
App::uses('Sucursale', 'Model');

/**
 * Sucursale Test Case
 *
 */
class SucursaleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sucursale',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sucursale = ClassRegistry::init('Sucursale');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sucursale);

		parent::tearDown();
	}

}
