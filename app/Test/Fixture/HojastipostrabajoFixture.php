<?php
/**
 * HojastipostrabajoFixture
 *
 */
class HojastipostrabajoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'trabajo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'sucursale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5, 'unsigned' => false),
		'tipotrabajo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'numero_hojaruta' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'unsigned' => false),
		'descripcion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cantidad_nominal' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12, 'unsigned' => false),
		'caras' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
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
			'sucursale_id' => 1,
			'numero' => 1,
			'tipotrabajo_id' => 1,
			'numero_hojaruta' => 1,
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'cantidad_nominal' => 1,
			'caras' => 'Lorem ip',
			'created' => '2015-02-12 13:03:14',
			'modified' => '2015-02-12 13:03:14'
		),
	);

}
