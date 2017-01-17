<?php
/**
 * VentasCtpFixture
 *
 */
class VentasCtpFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ventas_ctp';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'trabajos_ctp_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'insumos_ctp_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'precio_venta' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false),
		'cantidad' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'pinza' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 150, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lineatura' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'trabajos_ctp_id' => 1,
			'insumos_ctp_id' => 1,
			'precio_venta' => '',
			'cantidad' => 1,
			'pinza' => 'Lorem ipsum dolor sit amet',
			'lineatura' => 'Lorem ipsum dolor ',
			'created' => '2017-01-08 17:03:37',
			'modified' => '2017-01-08 17:03:37',
			'deleted' => '2017-01-08 17:03:37'
		),
	);

}
