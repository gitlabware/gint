<?php
/**
 * NotaFixture
 *
 */
class NotaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'tipo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'trabajo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false),
		'observaciones' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'tipo_pago' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sucursale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'saldo' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'total_pagado' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'numero_factura' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 14, 'unsigned' => false),
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
			'tipo' => 'Lorem ipsum dolor ',
			'trabajo_id' => 1,
			'numero' => 1,
			'observaciones' => 'Lorem ipsum dolor sit amet',
			'tipo_pago' => 'Lorem ipsum dolor ',
			'sucursale_id' => 1,
			'saldo' => '',
			'total_pagado' => '',
			'numero_factura' => 1,
			'created' => '2015-03-04 15:42:12',
			'modified' => '2015-03-04 15:42:12'
		),
	);

}
