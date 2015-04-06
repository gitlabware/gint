<?php
App::uses('AppModel', 'Model');
/**
 * Categoriasmonto Model
 *
 * @property Cajachica $Cajachica
 */
class Categoriasmonto extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Cajachica' => array(
			'className' => 'Cajachica',
			'foreignKey' => 'categoriasmonto_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
