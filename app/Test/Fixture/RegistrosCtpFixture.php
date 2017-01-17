<?php
/**
 * RegistrosCtpFixture
 *
 */
class RegistrosCtpFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'registros_ctp';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'proveedor' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 250, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fecha' => array('type' => 'date', 'null' => true, 'default' => null),
		'nro_orden_nota' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'nro_factura' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'reveladores_20_lts' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => false),
		'goma_arabiga_10_lts' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'sucursale_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'proveedor' => 'Lorem ipsum dolor sit amet',
			'fecha' => '2017-01-12',
			'nro_orden_nota' => 'Lorem ipsum dolor sit amet',
			'nro_factura' => 'Lorem ipsum dolor ',
			'reveladores_20_lts' => 1,
			'goma_arabiga_10_lts' => 1,
			'user_id' => 1,
			'sucursale_id' => 1,
			'created' => '2017-01-12 17:55:13',
			'modified' => '2017-01-12 17:55:13',
			'deleted' => '2017-01-12 17:55:13'
		),
	);

}
