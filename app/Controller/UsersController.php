<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public $layout = 'general';
    public $uses = array('User', 'Sucursale');

    public function beforeFilter()
    {
        parent::beforeFilter();
        //$this->Auth->allow();
    }

    public function index()
    {
        $role = $this->Session->read('Auth.User.role');
        $condisiones = [];
        if ($role == 'Administrador CTP') {
            $condisiones['User.role'] = ['Administrador CTP', 'Trabajo CTP'];
        } else {
            $condisiones['User.role NOT IN'] = ['Administrador CTP', 'Trabajo CTP'];
        }
        $usuarios = $this->User->find('all', array(
            'recursive' => 0,
            'conditions' => $condisiones
        ));
        $this->set(compact('usuarios'));
    }

    public function usuario($idusuario = null)
    {
        $this->layout = 'ajax';
        $this->User->id = $idusuario;
        //debug($idusuario);exit;
        $sucursales = $this->Sucursale->find('list', array('fields' => 'Sucursale.nombre'));
        $this->request->data = $this->User->read();

        $role = $this->Session->read('Auth.User.role');
        if ($role == 'Administrador CTP') {
            $roles = ['Administrador CTP' => 'Administrador CTP', 'Trabajo CTP' => 'Trabajo CTP'];
        } else {
            $roles = ['Administrador' => 'Administrador', 'Empleado' => 'Empleado'];
        }
        $this->set(compact('sucursales', 'roles'));
    }

    public function guardarusuario()
    {
        //debug($this->request->data); exit;
        $valida = $this->validar('User');
        if (empty($valida)) {
            $this->User->create();
            $this->User->save($this->request->data['User']);
            $this->Session->setFlash('Se registro correctamente', 'msgbueno');
        } else {
            $this->Session->setFlash($valida);
        }
        $this->redirect(array('action' => 'index'));
    }

    public function delete($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            //throw new NotFoundException(__('Invalid user'));
            $this->Session->setFlash('No existe el usuario.');
        }
        //$this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash('se elimino correctamente el usuario.', 'msgbueno');
        } else {
            $this->Session->setFlash('no se pudo eliminar el usuario.', 'msgerror');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function login()
    {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            //debug($this->request->is);exit;
            if ($this->Auth->login()) {
                $this->reparte();
            } else {
                $this->Session->setFlash('Usuario o password incorrectos intente de nuevo.', 'msgerror');
            }
        }
    }

    public function reparte()
    {
        $role = $this->Session->read('Auth.User.role');
        switch ($role) {
            case 'Administrador':
                $this->redirect(array('controller' => 'Users', 'action' => 'index'));
            case 'Administrador CTP':
                $this->redirect(array('controller' => 'Users', 'action' => 'index'));
            case 'Trabajo CTP':
                $this->redirect(array('controller' => 'InsumosCtp', 'action' => 'index'));
            default:
                $this->redirect($this->referer());
        }
    }

    public function salir()
    {
        $this->redirect($this->Auth->logout());
        $this->redirect(array('action' => 'login'));
    }


}
