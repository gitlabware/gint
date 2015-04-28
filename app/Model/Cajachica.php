<?php
App::uses('AppModel', 'Model');
/**
 * Cajachica Model
 *
 * @property Categoriasmonto $Categoriasmonto
 * @property User $User
 */
class Cajachica extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Categoriasmonto' => array(
			'className' => 'Categoriasmonto',
			'foreignKey' => 'categoriasmonto_id',
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
