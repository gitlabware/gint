<?php

App::uses('AppController', 'Controller');

class InsumosController extends AppController {

    public $uses = array('Insumo', 'Categoria', 'Inventario');
    public $layout = 'general';

    public function index($idCategoria = null) {
        $categoria = $this->Categoria->findByid($idCategoria);
        $insumos = $this->Insumo->find('all', array('conditions' => array('Insumo.categoria_id' => $idCategoria)));
        $this->set(compact('insumos', 'categoria'));
    }

    public function insumo($idCategoria = null, $idInsumo = null) {
        $this->layout = 'ajax';
        $categoria = $this->Categoria->findByid($idCategoria);
        $this->Insumo->id = $idInsumo;
        $this->request->data = $this->Insumo->read();
        $this->request->data['Insumo']['categoria_id'] = $idCategoria;
        $this->set(compact('categoria'));
    }

    public function guarda_insumo() {
        if ($this->request->data['Insumo']) {
            $this->Insumo->create();
            $this->Insumo->save($this->request->data['Insumo']);
            $this->Session->setFlash('Se registro correctamente el insumo!!!', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo registrar intentelo nuevamente!!!', 'msgerror');
        }
        $this->redirect(array('action' => 'index', $this->request->data['Insumo']['categoria_id']));
    }

    public function eliminar($idInsumo = null) {
        $this->Insumo->delete($idInsumo);
        $this->Session->setFlash('Se elimino correctamente el insumo!!!', 'msgbueno');
        $this->redirect(array('action' => 'index'));
    }

    public function adicionar($idInsumo = null) {
        $this->layout = 'ajax';
        $insumo = $this->Insumo->findByid($idInsumo);
        $this->request->data['Inventario']['insumo_id'] = $idInsumo;
        $this->set(compact('insumo'));
    }

    public function registra_adicion($idCategoria = null) {
        if (!empty($this->request->data['Inventario']['insumo_id'])) {
            $insumo = $this->Inventario->find('first', array(
                'recursive' => -1
                , 'order' => 'Inventario.id DESC'
                , 'conditions' => array('Inventario.insumo_id' => $this->request->data['Inventario']['insumo_id'], 'Inventario.sucursale_id' => $this->Session->read('Auth.User.sucursale_id'))
            ));
            $total = 0.00;
            if (!empty($insumo)) {
                $total = $insumo['Inventario']['total'];
            }
            $this->request->data['Inventario']['sucursale_id'] = $this->Session->read('Auth.User.sucursale_id');
            $this->request->data['Inventario']['total'] = $total + $this->request->data['Inventario']['cantidad'];
            $this->Inventario->create();
            if ($this->Inventario->save($this->request->data['Inventario'])) {
                
                $this->Session->setFlash('Se registro correctamente!!!', 'msgbueno');
            } else {
                $this->Session->setFlash('No se pudo registrar intente nuevamente!!', 'msgerror');
            }
        } else {
            $this->Session->setFlash('No se pudo registrar intente nuevamente!!', 'msgerror');
        }
        $this->redirect(array('action' => 'index', $idCategoria));
    }

    public function sacar($idInsumo = null) {
        $this->layout = 'ajax';
        $insumo = $this->Insumo->findByid($idInsumo);
        $this->request->data['Inventario']['insumo_id'] = $idInsumo;
        $this->set(compact('insumo'));
    }

    public function registra_retiro($idCategoria = null) {
        if (!empty($this->request->data['Inventario']['insumo_id'])) {
            $insumo = $this->Inventario->find('first', array(
                'recursive' => -1
                , 'order' => 'Inventario.id DESC'
                , 'conditions' => array('Inventario.insumo_id' => $this->request->data['Inventario']['insumo_id'], 'Inventario.sucursale_id' => $this->Session->read('Auth.User.sucursale_id'))
            ));
            $total = 0.00;
            if (!empty($insumo)) {
                $total = $insumo['Inventario']['total'];
            }
            if ($total >= $this->request->data['Inventario']['cantidad']) {
                $this->request->data['Inventario']['sucursale_id'] = $this->Session->read('Auth.User.sucursale_id');
                $this->request->data['Inventario']['total'] = $total - $this->request->data['Inventario']['cantidad'];
                $this->Inventario->create();
                if ($this->Inventario->save($this->request->data['Inventario'])) {
                    
                    $this->Session->setFlash('Se registro correctamente!!!', 'msgbueno');
                } else {
                    $this->Session->setFlash('No se pudo registrar intente nuevamente!!', 'msgerror');
                }
            } else {
                $this->Session->setFlash('No se puede sacar mas de ' . $total . ' kg. !!!', 'msgerror');
            }
        } else {
            $this->Session->setFlash('No se pudo registrar intente nuevamente!!', 'msgerror');
        }
        $this->redirect(array('action' => 'index', $idCategoria));
    }

    public function get_total($idInsumo = null) {
        $inventario = $this->Inventario->find('first', array(
            'order' => 'Inventario.id DESC'
            , 'conditions' => array(
                'Inventario.insumo_id' => $idInsumo
                , 'Inventario.sucursale_id' => $this->Session->read('Auth.User.sucursale_id')
            )
        ));
        if (!empty($inventario)) {
            return $inventario['Inventario']['total'];
        } else {
            return 0.00;
        }
    }

}
