<?php

App::uses('AppModel', 'Model');

/**
 * Movimiento Model
 *
 * @property Sucursale $Sucursale
 * @property User $User
 * @property Cliente $Cliente
 * @property Inventario $Inventario
 */
class Movimiento extends AppModel {
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
        'Tsucursale' => array(
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
        'Cliente' => array(
            'className' => 'Cliente',
            'foreignKey' => 'cliente_id',
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
        'Inventario' => array(
            'className' => 'Inventario',
            'foreignKey' => 'movimiento_id',
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
