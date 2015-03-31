<?php
App::uses('AppModel', 'Model');
/**
 * Inventario Model
 *
 * @property Insumo $Insumo
 * @property Movimiento $Movimiento
 * @property Hojasproduccione $Hojasproduccione
 * @property Trabajo $Trabajo
 * @property User $User
 * @property Sucursale $Sucursale
 */
class Inventario extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Insumo' => array(
			'className' => 'Insumo',
			'foreignKey' => 'insumo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Movimiento' => array(
			'className' => 'Movimiento',
			'foreignKey' => 'movimiento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Hojasproduccione' => array(
			'className' => 'Hojasproduccione',
			'foreignKey' => 'hojasproduccione_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		'Sucursale' => array(
			'className' => 'Sucursale',
			'foreignKey' => 'sucursale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
