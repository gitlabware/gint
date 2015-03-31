<?php
App::uses('AppModel', 'Model');
/**
 * Nota Model
 *
 * @property Trabajo $Trabajo
 * @property Sucursale $Sucursale
 */
class Nota extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Trabajo' => array(
			'className' => 'Trabajo',
			'foreignKey' => 'trabajo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Sucursale' => array(
			'className' => 'Sucursale',
			'foreignKey' => 'sucursale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
