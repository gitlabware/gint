<?php
App::uses('AppModel', 'Model');
/**
 * Empleadostrabajo Model
 *
 * @property Empleado $Empleado
 * @property Maquinaria $Maquinaria
 * @property Trabajo $Trabajo
 */
class Empleadostrabajo extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Empleado' => array(
			'className' => 'User',
			'foreignKey' => 'empleado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Maquinaria' => array(
			'className' => 'Maquinaria',
			'foreignKey' => 'maquinaria_id',
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
		)
	);
}
