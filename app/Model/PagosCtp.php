<?php
App::uses('AppModel', 'Model');
/**
 * PagosCtp Model
 *
 * @property TrabajosCtp $TrabajosCtp
 */
class PagosCtp extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'pagos_ctp';


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
		),'VentasCtp' => array(
			'className' => 'VentasCtp',
			'foreignKey' => 'ventas_ctp_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
