<?php
/**
 * InsumoFixture
 *
 */
class InsumoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 35, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'micraje' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '15,2', 'unsigned' => false),
		'alto' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '15,2', 'unsigned' => false),
		'peso' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '15,2', 'unsigned' => false),
		'observacion' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 60, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'categoria_id' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'micraje' => '',
			'alto' => '',
			'peso' => '',
			'observacion' => 'Lorem ipsum dolor sit amet',
			'created' => '2015-02-18 18:03:11',
			'modified' => '2015-02-18 18:03:11'
		),
	);

}
