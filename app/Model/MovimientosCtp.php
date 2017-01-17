<?php
App::uses('AppModel', 'Model');
/**
 * MovimientosCtp Model
 *
 * @property Sucursale $Sucursale
 * @property InsumosCtp $InsumosCtp
 * @property User $User
 */
class MovimientosCtp extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'movimientos_ctp';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Sucursale' => array(
			'className' => 'Sucursale',
			'foreignKey' => 'sucursale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'InsumosCtp' => array(
			'className' => 'InsumosCtp',
			'foreignKey' => 'insumos_ctp_id',
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
