<?php
App::uses('AppModel', 'Model');
/**
 * Hojasproduccione Model
 *
 * @property Trabajo $Trabajo
 * @property User $User
 * @property Tipotrabajo $Tipotrabajo
 * @property Hojastipostrabajo $Hojastipostrabajo
 * @property Sucursale $Sucursale
 */
class Hojasproduccione extends AppModel {


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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
		),
		'Hojastipostrabajo' => array(
			'className' => 'Hojastipostrabajo',
			'foreignKey' => 'hojastipostrabajo_id',
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
		)
	);
}
