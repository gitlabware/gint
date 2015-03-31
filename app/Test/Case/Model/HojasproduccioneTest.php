<?php
App::uses('Hojasproduccione', 'Model');

/**
 * Hojasproduccione Test Case
 *
 */
class HojasproduccioneTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hojasproduccione',
		'app.trabajo',
		'app.user',
		'app.sucursale',
		'app.cliente',
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
		$this->Hojasproduccione = ClassRegistry::init('Hojasproduccione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Hojasproduccione);

		parent::tearDown();
	}

}
