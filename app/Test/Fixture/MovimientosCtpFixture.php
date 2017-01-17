<?php
/**
 * MovimientosCtpFixture
 *
 */
class MovimientosCtpFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'movimientos_ctp';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'sucursale_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'insumos_ctp_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'unidad' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cantidad' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tipo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'sucursale_id' => 1,
			'insumos_ctp_id' => 1,
			'unidad' => 'Lorem ipsum dolor sit amet',
			'cantidad' => 1,
			'user_id' => 1,
			'tipo' => 'Lorem ipsum dolor sit amet',
			'created' => '2017-01-08 17:01:40',
			'modified' => '2017-01-08 17:01:40',
			'deleted' => '2017-01-08 17:01:40'
		),
	);

}
