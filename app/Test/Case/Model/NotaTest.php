<?php
App::uses('Nota', 'Model');

/**
 * Nota Test Case
 *
 */
class NotaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.nota',
		'app.trabajo',
		'app.user',
		'app.sucursale',
		'app.cliente',
		'app.hojasproduccione',
		'app.tipotrabajo',
		'app.hojastipostrabajo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Nota = ClassRegistry::init('Nota');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Nota);

		parent::tearDown();
	}

}
