<?php

App::uses('AppController', 'Controller');

class ClientesController extends AppController {

    public $layout = 'general';
    public $uses = array('Cliente');

    public function index() {
        $clientes = $this->Cliente->find('all');
        $this->set(compact('clientes'));
    }

    public function add() {
        $this->layout = 'ajax';
        if ($this->request->is('post')) {

            $this->Cliente->create();
            if ($this->Cliente->save($this->request->data)) {
                $this->Session->setFlash('Se registro correctamente.', 'msgbueno');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(' Error al registrar', 'msgerror');
            }
        }
    }

    public function edit($id = null) {
        $this->layout = 'ajax';
        if (!$this->Cliente->exists($id)) {
            throw new NotFoundException('Invalido', 'msgerror');
        }
        if ($this->request->is(array('post', 'put'))) {

            if ($this->Cliente->save($this->request->data)) {
                $this->Session->setFlash('Modificacion correcta', 'msgbueno');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('No se pudo guardar', 'msgerror');
            }
        } else {
            $options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id));
            $this->request->data = $this->Cliente->find('first', $options);
        }
    }

    public function delete($id = null) {
        $this->Cliente->id = $id;
        if (!$this->Cliente->exists()) {
            //throw new NotFoundException('Costo Invalido');
            $this->Session->setFlash('Invalido');
        }
        //$this->request->allowMethod('post', 'delete');
        if ($this->Cliente->delete()) {
            $this->Session->setFlash('Se elimino correctamente', 'msgbueno');
        } else {
            $this->Session->setFlash('no se pudo eliminar', 'msgerror');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
