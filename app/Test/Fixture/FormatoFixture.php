<?php
/**
 * FormatoFixture
 *
 */
class FormatoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'desdemedini' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'desdemedfin' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'hastamedini' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'hastamedfin' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'rangoini' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'rangofin' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'cantidadinicial' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'cantidadfinal' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tipotrabajo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'precio' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'unidad' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'desdemedini' => 1,
			'desdemedfin' => 1,
			'hastamedini' => 1,
			'hastamedfin' => 1,
			'rangoini' => 1,
			'rangofin' => 1,
			'cantidadinicial' => 1,
			'cantidadfinal' => 1,
			'tipotrabajo_id' => 1,
			'precio' => 1,
			'unidad' => 'Lorem ipsum dolor sit amet'
		),
	);

}
