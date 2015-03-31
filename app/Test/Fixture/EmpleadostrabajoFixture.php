<?php
/**
 * EmpleadostrabajoFixture
 *
 */
class EmpleadostrabajoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'empleado_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'maquinaria_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'trabajo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'empleado_id' => 1,
			'maquinaria_id' => 1,
			'trabajo_id' => 1,
			'created' => '2015-02-12 16:33:59',
			'modified' => '2015-02-12 16:33:59'
		),
	);

}
