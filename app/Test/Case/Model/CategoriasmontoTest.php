<?php
App::uses('Categoriasmonto', 'Model');

/**
 * Categoriasmonto Test Case
 *
 */
class CategoriasmontoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.categoriasmonto',
		'app.cajachica'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Categoriasmonto = ClassRegistry::init('Categoriasmonto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Categoriasmonto);

		parent::tearDown();
	}

}
