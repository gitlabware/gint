<?php
App::uses('AppModel', 'Model');
/**
 * Hojastipostrabajo Model
 *
 * @property Trabajo $Trabajo
 * @property Sucursale $Sucursale
 * @property Tipotrabajo $Tipotrabajo
 */
class Hojastipostrabajo extends AppModel {


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
		'Tipotrabajo' => array(
			'className' => 'Tipotrabajo',
			'foreignKey' => 'tipotrabajo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
