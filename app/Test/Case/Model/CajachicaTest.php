<?php
App::uses('Cajachica', 'Model');

/**
 * Cajachica Test Case
 *
 */
class CajachicaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cajachica',
		'app.categoriasmonto',
		'app.user',
		'app.sucursale'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Cajachica = ClassRegistry::init('Cajachica');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Cajachica);

		parent::tearDown();
	}

}
