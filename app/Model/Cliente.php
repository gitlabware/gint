<?php

App::uses('AppModel', 'Model');

/**
 * Cliente Model
 *
 */
class Cliente extends AppModel {
  /*public $validate = array(
        'nombre' => array(
            'limitDuplicates' => array(
                'rule' => array('limitDuplicates', 1),
                'message' => 'El cliente ya esta registrado!!'
            )
        )
    );

  public function limitDuplicates($check, $limit) {
    if (!empty($this->data['Cliente']['id'])) {
      $check['Cliente.id !='] = $this->data['Cliente']['id'];
    }
    $check['Cliente.nit'] = $this->data['Cliente']['nit'];
    $existingPromoCount = $this->find('count', array(
      'conditions' => $check,
      'recursive' => -1
    ));
    return $existingPromoCount < $limit;
  }*/

}
