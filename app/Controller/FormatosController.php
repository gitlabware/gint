<?php

class FormatosController extends AppController {

    public $layout = 'general';
    public $uses = array('Formato', 'Tipotrabajo');

    public function lista34() {
        $formatos = $this->Formato->find('all', array('conditions' => array('tipotrabajo_id' => array(3, 4))));
        $this->set(compact('formatos'));
    }

    public function lista6() {
        $formatos = $this->Formato->find('all', array('conditions' => array('tipotrabajo_id' => 6)));
        $tipotrabajo = $this->Tipotrabajo->findByid(6, null, null, -1);
        $this->set(compact('formatos', 'tipotrabajo'));
    }

    public function lista15() {
        $formatos = $this->Formato->find('all', array('conditions' => array('tipotrabajo_id' => 15)));
        $tipotrabajo = $this->Tipotrabajo->findByid(15, null, null, -1);
        $this->set(compact('formatos', 'tipotrabajo'));
    }

    public function lista16() {
        $formatos = $this->Formato->find('all', array('conditions' => array('tipotrabajo_id' => 16)));
        $tipotrabajo = $this->Tipotrabajo->findByid(16, null, null, -1);
        $this->set(compact('formatos', 'tipotrabajo'));
    }

    public function lista17() {
        $formatos = $this->Formato->find('all', array('conditions' => array('tipotrabajo_id' => 17)));
        $tipotrabajo = $this->Tipotrabajo->findByid(17, null, null, -1);
        $this->set(compact('formatos', 'tipotrabajo'));
    }

    public function lista18() {
        $formatos = $this->Formato->find('all', array('conditions' => array('tipotrabajo_id' => 18)));
        $tipotrabajo = $this->Tipotrabajo->findByid(18, null, null, -1);
        $this->set(compact('formatos', 'tipotrabajo'));
    }

    public function guardaformato() {
        $this->Formato->create();
        if ($this->Formato->save($this->request->data['Formato'])) {
            $this->Session->setFlash('se registro correctamente', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo guardar', 'msgerror');
        }
        $this->redirect(array('action' => $this->request->data['Formato']['url']));
    }

    public function formato34($idformato = null) {
        $this->layout = 'ajax';
        $this->Formato->id = $idformato;
        $this->request->data = $this->Formato->read();
    }

    public function formato6($idformato = null) {
        $this->layout = 'ajax';
        $this->Formato->id = $idformato;
        $this->request->data = $this->Formato->read();
    }

    public function formato15($idformato = null) {
        $this->layout = 'ajax';
        $this->Formato->id=$idformato;
        $this->request->data = $this->Formato->read();
    }

    public function formato16($idformato = null) {
        $this->layout = 'ajax';
        $this->Formato->id=$idformato;
        $this->request->data = $this->Formato->read();
    }

    public function formato17($idformato = null) {
        $this->layout = 'ajax';
        $this->Formato->id=$idformato;
        $this->request->data = $this->Formato->read();
    }

    public function formato18($idformato = null) {
        $this->layout = 'ajax';
        $this->Formato->id=$idformato;
        $this->request->data = $this->Formato->read();
    }

    public function delete($id = null,$url=null) {
        $this->Formato->id = $id;
        if ($this->Formato->exists()) {
            $this->Session->setFlash('No se pudo eliminar', 'msgerror');
        }
        if ($this->Formato->delete()) {
            $this->Session->setFlash('se elimino correctamnete', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo eliminar', 'msgerror');
        }
        $this->redirect(array('action' => $url));
    }

}
