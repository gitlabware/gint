<?php
/**
 * InventarioFixture
 *
 */
class InventarioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'insumo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tipo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cantidad' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '15,2', 'unsigned' => false),
		'total' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '15,2', 'unsigned' => false),
		'observacion' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'micraje' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '15,2', 'unsigned' => false),
		'alto' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '15,2', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'insumo_id' => 1,
			'tipo' => 'Lorem ip',
			'cantidad' => '',
			'total' => '',
			'observacion' => 'Lorem ipsum dolor sit amet',
			'micraje' => '',
			'alto' => '',
			'created' => '2015-02-19 17:10:36',
			'modified' => '2015-02-19 17:10:36'
		),
	);

}
