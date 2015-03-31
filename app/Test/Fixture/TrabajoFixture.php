<?php
/**
 * TrabajoFixture
 *
 */
class TrabajoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cliente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'sucursale_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'estado' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'user_id' => 1,
			'cliente_id' => 1,
			'sucursale_id' => 1,
			'estado' => 'Lorem ipsum dolor sit a',
			'created' => '2015-03-03 13:52:56',
			'modified' => '2015-03-03 13:52:56'
		),
	);

}
