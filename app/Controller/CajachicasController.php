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
  
  public function nuevo(){
    $categorias = $this->Categoriasmonto->find('all', array(
      'recursive'=>-1      
    ));
    $this->set(compact('categorias'));
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
		$this->request->allowMethod('post', 'delete');
		if ($this->Cajachica->delete()) {
			$this->Session->setFlash(__('The cajachica has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cajachica could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
