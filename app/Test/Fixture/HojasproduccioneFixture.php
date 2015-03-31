<?php
/**
 * HojasproduccioneFixture
 *
 */
class HojasproduccioneFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'trabajo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'descripcion' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 250, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cantidad' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'metrajeini' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'metrajefin' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'cara' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'costo' => array('type' => 'float', 'null' => true, 'default' => null, 'unsigned' => false),
		'precio' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'tipo_nota' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 14, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tipotrabajo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'hojastipostrabajo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'numero_hruta' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'sucursale_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'trabajo_id' => 1,
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'cantidad' => 1,
			'metrajeini' => 1,
			'metrajefin' => 1,
			'cara' => 'Lorem ipsum dolor sit amet',
			'costo' => 1,
			'precio' => 1,
			'tipo_nota' => 'Lorem ipsum ',
			'user_id' => 1,
			'tipotrabajo_id' => 1,
			'hojastipostrabajo_id' => 1,
			'numero_hruta' => 1,
			'sucursale_id' => 1,
			'created' => '2015-02-24 18:20:03',
			'modified' => '2015-02-24 18:20:03'
		),
	);

}
