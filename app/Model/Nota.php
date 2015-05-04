<?php

App::uses('AppModel', 'Model');

/**
 * Nota Model
 *
 * @property Trabajo $Trabajo
 * @property Sucursale $Sucursale
 */
class Nota extends AppModel {
  //The Associations below have been created with all possible keys, those that are not needed can be removed

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $belongsTo = array(
    'Trabajo' => array(
      'className' => 'Trabajo',
      'foreignKey' => 'trabajo_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
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
    )
  );
  
  public $validate = array(
        'numero' => array(
            'limitDuplicates' => array(
                'rule' => array('limitDuplicates', 1),
                'message' => 'La nota ya existe, no se puede registrar mas de una vez!!'
            )
        )
    );

  public function limitDuplicates($check, $limit) {
    if (!empty($this->data['Nota']['id'])) {
      $check['Nota.id !='] = $this->data['Nota']['id'];
    }
    $check['Nota.numero'] = $this->data['Nota']['numero'];
    $check['Nota.sucursale_id'] = $this->data['Nota']['sucursale_id'];
    $check['Nota.tipo'] = $this->data['Nota']['tipo'];
    $existingPromoCount = $this->find('count', array(
      'conditions' => $check,
      'recursive' => -1
    ));
    return $existingPromoCount < $limit;
  }

}
