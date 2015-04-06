<?php
/**
 * CajachicaFixture
 *
 */
class CajachicaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'categoriasmonto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'recibo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'entrada' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'salida' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'total' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '15,2', 'unsigned' => false),
		'observaciones' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'date', 'null' => true, 'default' => null),
		'modified' => array('type' => 'date', 'null' => true, 'default' => null),
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
			'categoriasmonto_id' => 1,
			'recibo' => 'Lorem ipsum dolor sit amet',
			'entrada' => 1,
			'salida' => 1,
			'total' => 1,
			'observaciones' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2015-03-30',
			'modified' => '2015-03-30'
		),
	);

}
