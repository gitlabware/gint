<?php

class MaquinariasController extends AppController {

    public $layout = 'general';
    public $uses = array('Maquinaria');

    public function index() {
        $maquinarias = $this->Maquinaria->find('all');
        $this->set(compact('maquinarias'));
    }

    public function add() {
        $this->layout = 'ajax';
        if ($this->request->is('post')) {
            $this->Maquinaria->create();
            if ($this->Maquinaria->save($this->request->data)) {
                $this->Session->setFlash('Se registro correctamente.', 'msgbueno');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(' Error al registrar', 'msgerror');
            }
        }
    }
    
   public function edit($id = null) {
        $this->layout = 'ajax';
        if (!$this->Maquinaria->exists($id)) {
            throw new NotFoundException('Invalido', 'msgerror');
        }
        if ($this->request->is(array('post', 'put'))) {

            if ($this->Maquinaria->save($this->request->data)) {
                $this->Session->setFlash('Modificacion correcta', 'msgbueno');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('No se pudo guardar', 'msgerror');
            }
        } else {
            $options = array('conditions' => array('Maquinaria.' . $this->Maquinaria->primaryKey => $id));
            $this->request->data = $this->Maquinaria->find('first', $options);
        }
    }

    public function delete($id = null) {
        $this->Maquinaria->id = $id;
        if (!$this->Maquinaria->exists()) {
            //throw new NotFoundException('Costo Invalido');
            $this->Session->setFlash('Invalido');
        }
        //$this->request->allowMethod('post', 'delete');
        if ($this->Maquinaria->delete()) {
            $this->Session->setFlash('Se elimino correctamente', 'msgbueno');
        } else {
            $this->Session->setFlash('no se pudo eliminar', 'msgerror');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
