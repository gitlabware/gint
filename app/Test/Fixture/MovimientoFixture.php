<?php
/**
 * MovimientoFixture
 *
 */
class MovimientoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'tipo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sucursale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'total' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'tsucursale_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'cliente_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'tipo' => 'Lorem ip',
			'sucursale_id' => 1,
			'user_id' => 1,
			'total' => '',
			'tsucursale_id' => 1,
			'cliente_id' => 1,
			'created' => '2015-02-20 10:42:02',
			'modified' => '2015-02-20 10:42:02'
		),
	);

}
