<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 * @property Sucursale $Sucursale
 */
class User extends AppModel {

  public function beforeSave($options = array()) {

    $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    return true;
  }

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
    )
  );

}
