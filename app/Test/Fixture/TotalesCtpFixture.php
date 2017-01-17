<?php
/**
 * TotalesCtpFixture
 *
 */
class TotalesCtpFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'totales_ctp';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'sucursale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'insumos_ctp_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cantidad' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false),
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
			'cantidad' => 1
		),
	);

}
