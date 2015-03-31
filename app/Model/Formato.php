<?php
App::uses('AppModel', 'Model');
/**
 * Formato Model
 *
 * @property Tipotrabajo $Tipotrabajo
 */
class Formato extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tipotrabajo' => array(
			'className' => 'Tipotrabajo',
			'foreignKey' => 'tipotrabajo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
