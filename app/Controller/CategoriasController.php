<?php

App::uses('AppController', 'Controller');

class CategoriasController extends AppController {
    public $uses = array('Categoria');
    public $layout = 'general';
    public function index(){
        $categorias = $this->Categoria->find('all');
        $this->set(compact('categorias'));
    }
    public function categoria($idCategoria = null){
        $this->layout = 'ajax';
        $this->Categoria->id = $idCategoria;
        $this->request->data = $this->Categoria->read();
    }
    public function guarda_categoria(){
        if($this->request->data['Categoria']){
            $this->Categoria->create();
            $this->Categoria->save($this->request->data['Categoria']);
            $this->Session->setFlash('Se registro correctamente la categoria!!!','msgbueno');
        }else{
            $this->Session->setFlash('NO se pudo registrar intentelo nuevamente!!!','msgerror');
        }
        $this->redirect(array('action' => 'index'));
    }
    public function eliminar($idCategoria = null){
        $this->Categoria->delete($idCategoria);
        $this->Session->setFlash('Se elimino correctamente la categoria!!!','msgbueno');
        $this->redirect(array('action' => 'index'));
    }
}