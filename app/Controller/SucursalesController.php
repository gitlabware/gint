<?php

App::uses('AppController', 'Controller');

class SucursalesController extends AppController {
    public $uses = array('Sucursale');
    public $layout = 'general';
    public function index(){
        $sucursales = $this->Sucursale->find('all');
        $this->set(compact('sucursales'));
    }
    public function sucursal($idSucursale = null){
        $this->layout = 'ajax';
        $this->Sucursale->id = $idSucursale;
        $this->request->data = $this->Sucursale->read();
    }
    public function guarda_sucursal(){
        if($this->request->data['Sucursale']){
            $this->Sucursale->create();
            $this->Sucursale->save($this->request->data['Sucursale']);
            $this->Session->setFlash('Se registro correctamente la sucursal!!!','msgbueno');
        }else{
            $this->Session->setFlash('No se pudo registrar intentelo nuevamente!!!','msgerror');
        }
        $this->redirect(array('action' => 'index'));
    }
    public function eliminar($idSucursale = null){
        $this->Sucursale->delete($idSucursale);
        $this->Session->setFlash('Se elimino correctamente la sucursal!!!','msgbueno');
        $this->redirect(array('action' => 'index'));
    }
    
}