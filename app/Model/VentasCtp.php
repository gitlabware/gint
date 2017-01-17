<?php
App::uses('AppModel', 'Model');
/**
 * VentasCtp Model
 *
 * @property TrabajosCtp $TrabajosCtp
 * @property InsumosCtp $InsumosCtp
 */
class VentasCtp extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'ventas_ctp';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'TrabajosCtp' => array(
			'className' => 'TrabajosCtp',
			'foreignKey' => 'trabajos_ctp_id',
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
