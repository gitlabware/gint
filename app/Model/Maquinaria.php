<?php
App::uses('AppModel', 'Model');
/**
 * Maquinaria Model
 *
 * @property Empleadostrabajo $Empleadostrabajo
 */
class Maquinaria extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Empleadostrabajo' => array(
			'className' => 'Empleadostrabajo',
			'foreignKey' => 'maquinaria_id',
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
