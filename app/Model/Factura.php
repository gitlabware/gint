<?php
App::uses('AppModel', 'Model');
/**
 * Factura Model
 *
 * @property Parametrosfactura $Parametrosfactura
 */
class Factura extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Parametrosfactura' => array(
			'className' => 'Parametrosfactura',
			'foreignKey' => 'parametrosfactura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
