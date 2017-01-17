<?php
App::uses('AppModel', 'Model');
/**
 * ClientesCtp Model
 *
 * @property TrabajosCtp $TrabajosCtp
 */
class ClientesCtp extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'clientes_ctp';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TrabajosCtp' => array(
			'className' => 'TrabajosCtp',
			'foreignKey' => 'clientes_ctp_id',
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
