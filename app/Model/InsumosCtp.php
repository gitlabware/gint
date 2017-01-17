<?php
App::uses('AppModel', 'Model');
/**
 * InsumosCtp Model
 *
 * @property TotalesCtp $TotalesCtp
 * @property VentasCtp $VentasCtp
 */
class InsumosCtp extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'insumos_ctp';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TotalesCtp' => array(
			'className' => 'TotalesCtp',
			'foreignKey' => 'insumos_ctp_id',
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
			'foreignKey' => 'insumos_ctp_id',
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
