<?php

App::uses('AppController', 'Controller');

/**
 * Cajachicas Controller
 *
 * @property Cajachica $Cajachica
 * @property PaginatorComponent $Paginator
 */
class CajachicasController extends AppController {

  /**
   * Components
   *
   * @var array
   */
  public $components = array('Paginator');
  public $layout = 'general';
  public $uses = array('Cajachica', 'Categoriasmonto');
  
  public function beforeFilter() {
    parent::beforeFilter();    
  }

  /**
   * index method
   *
   * @return void
   */
  public function index() {
    $this->Cajachica->recursive = 0;
    $this->set('cajachicas', $this->Paginator->paginate());
  }

  /**
   * view method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
  public function view($id = null) {
    if (!$this->Cajachica->exists($id)) {
      throw new NotFoundException(__('Invalid cajachica'));
    }
    $options = array('conditions' => array('Cajachica.' . $this->Cajachica->primaryKey => $id));
    $this->set('cajachica', $this->Cajachica->find('first', $options));
  }

  /**
   * add method
   *
   * @return void
   */
  public function add() {
    if ($this->request->is('post')) {
      $this->Cajachica->create();
      if ($this->Cajachica->save($this->request->data)) {
        $this->Session->setFlash(__('The cajachica has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The cajachica could not be saved. Please, try again.'));
      }
    }
    $categoriasmontos = $this->Cajachica->Categoriasmonto->find('list');
    $this->set(compact('categoriasmontos'));
  }

  public function nuevo() {

    if ($this->request->is('post')) {
      //debug($this->request->data);
      //$sesionUsuario = $this->Session->read['Auth']['User']['id'];
      $sesionUsuario = $this->Session->read('Auth.User.id');
      //debug($sesionUsuario);die;
      $ultimoTotal = $this->Cajachica->find('first', array(
        'recursive' => -1,
        'order' => 'Cajachica.id DESC'
      ));
      //debug($ultimoTotal);
      $tipo = $this->request->data['Cajachica']['tipo'];

      if (empty($this->request->data['Cajachica']['categoriasmonto_id'])) {
        $this->Categoriasmonto->create();
        $this->request->data['Categoriasmonto']['nombre'] = $this->request->data['Cajachica']['nuevoDetalle'];
        if ($this->Categoriasmonto->save($this->request->data['Categoriasmonto'])) {
          $idCategoria = $this->Categoriasmonto->getLastInsertID();
          $this->request->data['Cajachica']['categoriasmonto_id'] = $idCategoria;
        } else {
          $this->Session->setFlash('Grrr hubo un error', 'msgerror');
          return $this->redirect(array('action' => 'nuevo'));
        }
      }
      $this->Cajachica->create();
      $this->request->data['Cajachica']['user_id']=$sesionUsuario;
      if ($tipo == 'ingreso') {
        $this->request->data['Cajachica']['entrada'] = $this->request->data['Cajachica']['monto'];
        $this->request->data['Cajachica']['total'] = $ultimoTotal['Cajachica']['total'] + $this->request->data['Cajachica']['monto'];
      } else {
        $this->request->data['Cajachica']['salida'] = $this->request->data['Cajachica']['monto'];
        if ($ultimoTotal['Cajachica']['total'] < $this->request->data['Cajachica']['monto']) {
          $this->Session->setFlash('No puede gastar mas de lo que tiene.', 'msgerror');
          return $this->redirect(array('action' => 'nuevo'));
        } else {
          $this->request->data['Cajachica']['total'] = $ultimoTotal['Cajachica']['total'] - $this->request->data['Cajachica']['monto'];
        }
      }
      if($this->Cajachica->save($this->request->data['Cajachica'])){
        $this->Session->setFlash('Registro Correctamente.', 'msgbueno');
        return $this->redirect(array('action' => 'nuevo'));
      }else{
        $this->Session->setFlash('Registro Correctamente.', 'msgerror');
        return $this->redirect(array('action' => 'nuevo'));
      }
      
    } else {
      $hoy = date("Y-m-d");      
      $ultimo = $this->Cajachica->find('first', array(
        'recursive' => -1,
        'order' => 'Cajachica.id DESC'
      ));
      $movimientosHoy = $this->Cajachica->find('all', array(
        'recursive' => 0,
        'conditions' => array('Cajachica.fecha' => $hoy),
        'order' => array('Cajachica.id DESC')
      ));
      //debug($hoy);
      $this->set(compact('hoy', 'movimientosHoy', 'ultimo'));
    }
  }

  /**
   * edit method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
  public function edit($id = null) {
    if (!$this->Cajachica->exists($id)) {
      throw new NotFoundException(__('Invalid cajachica'));
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Cajachica->save($this->request->data)) {
        $this->Session->setFlash(__('The cajachica has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The cajachica could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('Cajachica.' . $this->Cajachica->primaryKey => $id));
      $this->request->data = $this->Cajachica->find('first', $options);
    }
    $categoriasmontos = $this->Cajachica->Categoriasmonto->find('list');
    $this->set(compact('categoriasmontos'));
  }

  /**
   * delete method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
  public function delete($id = null) {
    $this->Cajachica->id = $id;
    if (!$this->Cajachica->exists()) {
      throw new NotFoundException(__('Invalid cajachica'));
    }
    //$this->request->allowMethod('post', 'delete');
    if ($this->Cajachica->delete()) {
      $this->Session->setFlash('El registro fue eliminado.');
    } else {
      $this->Session->setFlash('El registro no fue eliminado.');
    }
    return $this->redirect(array('action' => 'nuevo'));
  }

  //----------- MODULO DE SELECTOR AJAX DETALLE ------------
  public function combodetalle1($campoform = null, $div = null) {
    $this->layout = 'ajax';
    //debug($campoform);exit;
    $this->set(compact('campoform', 'div'));
  }

  public function combodetalle2($campoform = null, $div = null) {
    $this->layout = 'ajax';
    //debug($this->request->data);exit;
    if (!empty($this->request->data['Caja']['detalle'])) {
      $listatipos = $this->Categoriasmonto->find('all', array(
        'recursive' => -1,
        'conditions' => array(
          'Categoriasmonto.nombre LIKE' => '%' . $this->request->data['Caja']['detalle'] . "%"
        ),
        'limit' => 8,
        'order' => 'Categoriasmonto.nombre ASC'
      ));
    }
    $this->set(compact('listatipos', 'div', 'campoform'));
  }

  public function combodetalle3($campoform = null, $div = null, $idCategoria = null) {
    $this->layout = 'ajax';
    $sdetalle = $this->Categoriasmonto->findByid($idCategoria, null, null, -1);
    $this->set(compact('campoform', 'sdetalle', 'div'));
  }

  //-------------- TERMINA SELECTOR CLIENTE--------------------
}
