<?php
App::uses('AppModel', 'Model');
/**
 * TotalesCtp Model
 *
 * @property Sucursale $Sucursale
 * @property InsumosCtp $InsumosCtp
 */
class TotalesCtp extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'totales_ctp';


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
		)
	);
}
