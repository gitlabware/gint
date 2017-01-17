<?php
App::uses('AppModel', 'Model');
/**
 * TrabajosCtp Model
 *
 * @property Sucursale $Sucursale
 * @property User $User
 * @property ClientesCtp $ClientesCtp
 * @property PagosCtp $PagosCtp
 * @property VentasCtp $VentasCtp
 */
class TrabajosCtp extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'trabajos_ctp';


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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ClientesCtp' => array(
			'className' => 'ClientesCtp',
			'foreignKey' => 'clientes_ctp_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PagosCtp' => array(
			'className' => 'PagosCtp',
			'foreignKey' => 'trabajos_ctp_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'VentasCtp' => array(
			'className' => 'VentasCtp',
			'foreignKey' => 'trabajos_ctp_id',
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
