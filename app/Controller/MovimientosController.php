<?php

App::uses('AppController', 'Controller');

class MovimientosController extends AppController {

    public $uses = array('Movimiento', 'Cliente', 'User', 'Categoria', 'Insumo', 'Inventario', 'Hojasproduccione', 'Sucursale');
    public $layout = 'general';
    var $components = array('RequestHandler', 'DataTable');

    public function beforeFilter() {
        parent::beforeFilter();
        if ($this->RequestHandler->responseType() == 'json') {
            $this->RequestHandler->setContent('json', 'application/json');
        }
    }

    public function ventas() {
        if ($this->RequestHandler->responseType() == 'json') {
            $imprimir = '<button class="btn btn-inverse btn-xs" type="button" onclick="imprimirt(' . "',Movimiento.id,'" . ')"><i class="icon ico-print"></i> Imprimir</button>';
            $cancelar = '<button class="btn btn-danger btn-xs" type="button" onclick="eliminart(' . "',Movimiento.id,'" . ')"><i class="icon ico-remove3"></i> Cancelar</button>';
            $acciones = "(SELECT IF (Movimiento.tipo = 'Venta', CONCAT('$imprimir $cancelar'), CONCAT('$imprimir') ))";
            $venta = '<span class="label label-success">Venta</span>';
            $venta_cancelada = '<span class="label label-danger">Venta Cancelada</span>';
            $tipo_estado = "(SELECT IF (Movimiento.tipo = 'Venta', CONCAT('$venta'), CONCAT('$venta_cancelada') ))";
            $this->Movimiento->virtualFields = array(
                'acciones' => "CONCAT($acciones)",
                'tipo_estado' => "CONCAT($tipo_estado)"
            );
            $this->paginate = array(
                'fields' => array('Movimiento.id', 'Cliente.nombre', 'Movimiento.total', 'User.nombre', 'Movimiento.tipo_estado', 'Movimiento.acciones'),
                'recursive' => 0,
                'order' => 'Movimiento.id DESC',
                'conditions' => array('Movimiento.tipo' => array('Venta', 'Venta Cancelada'))
            );
            $this->DataTable->fields = array('Movimiento.id', 'Cliente.nombre', 'Movimiento.total', 'User.nombre', 'Movimiento.tipo_estado', 'Movimiento.acciones');
            $this->DataTable->emptyEleget_usuarios_adminments = 1;
            $this->set('movimientos', $this->DataTable->getResponse());
            $this->set('_serialize', 'movimientos');
        }
    }

    public function transferencias() {
        if ($this->RequestHandler->responseType() == 'json') {
            $imprimir = '<button class="btn btn-inverse btn-xs" type="button" onclick="imprimirt(' . "',Movimiento.id,'" . ')"><i class="icon ico-print"></i> Imprimir</button>';
            //$cancelar = '<button class="btn btn-danger btn-xs" type="button" onclick="eliminart(' . "',Movimiento.id,'" . ')"><i class="icon ico-remove3"></i> Cancelar</button>';
            $acciones = "$imprimir";
            $this->Movimiento->virtualFields = array(
                'acciones' => "CONCAT('$acciones')"
                    //,'prop' => 'SELECT titulo_id FROM mascotas_titulos WHERE mascota_id = Mascota.id'
            );
            $this->paginate = array(
                'fields' => array('Movimiento.id', 'Tsucursale.nombre', 'User.nombre', 'Movimiento.acciones'),
                'recursive' => 0,
                'order' => 'Movimiento.id DESC',
                'conditions' => array('Movimiento.tipo' => 'Transferencia')
            );
            $this->DataTable->fields = array('Movimiento.id', 'Tsucursale.nombre', 'User.nombre', 'Movimiento.acciones');
            $this->DataTable->emptyEleget_usuarios_adminments = 1;
            $this->set('movimientos', $this->DataTable->getResponse());
            $this->set('_serialize', 'movimientos');
        }
    }

    public function venta() {
        $clientes = $this->Cliente->find('list', array('fields' => 'Cliente.nombre'));
        $categorias = $this->Categoria->find('list', array('fields' => 'Categoria.nombre'));
        if ($this->Session->check('rventa')) {
            $this->request->data = $this->Session->read('rventa');
            $this->Session->delete('rventa');
        }
        $all_insumos = $this->Insumo->find('all', array(
            'fields' => array('Insumo.id', 'Insumo.nombre', 'Insumo.micraje')
                //, 'conditions' => array('Insumo.categoria_id' => $idCategoria)
        ));
        $this->set(compact('clientes', 'categorias', 'all_insumos'));
    }

    public function transferencia() {
        $categorias = $this->Categoria->find('list', array('fields' => 'Categoria.nombre'));
        $sucursales = $this->Sucursale->find('list', array('fields' => 'Sucursale.nombre'
            , 'conditions' => array('Sucursale.id !=' => $this->Session->read('Auth.User.sucursale_id'))
        ));
        if ($this->Session->check('rtransferencia')) {
            $this->request->data = $this->Session->read('rtransferencia');
            $this->Session->delete('rtransferencia');
        }
        $all_insumos = $this->Insumo->find('all', array(
            'fields' => array('Insumo.id', 'Insumo.nombre', 'Insumo.micraje')
                //, 'conditions' => array('Insumo.categoria_id' => $idCategoria)
        ));
        $this->set(compact('sucursales', 'categorias', 'all_insumos'));
    }

    public function ajax_form_insumo($idCategoria = null, $sw = null) {
        $this->layout = 'ajax';
        $categoria = $this->Categoria->findByid($idCategoria);
        $this->Insumo->virtualFields = array(
            'nombre_completo' => "CONCAT(Insumo.nombre,' (Total=',Insumo.total,' kg)')"
        );
        $insumos = $this->Insumo->find('list', array('fields' => 'Insumo.nombre_completo', 'conditions' => array('Insumo.categoria_id' => $idCategoria)));

        //debug($all_insumos);exit;
        $this->set(compact('insumos', 'categoria', 'sw'));
    }

    //Este algoritmo para registrar ventas puede generar errores si existiera
    //mas de un ususario usando el sistema
    public function registra_venta() {
        if (!empty($this->request->data)) {
            $this->request->data['Movimiento']['tipo'] = 'Venta';
            $this->request->data['Movimiento']['sucursale_id'] = $this->Session->read('Auth.User.sucursale_id');
            $this->request->data['Movimiento']['user_id'] = $this->Session->read('Auth.User.id');
            $this->Movimiento->create();
            if ($this->Movimiento->save($this->request->data['Movimiento'])) {
                $idMovimiento = $this->Movimiento->getLastInsertID();
                $sw = FALSE;
                foreach ($this->request->data['Insumos'] as $insu) {
                    $ult_inventario = $this->Inventario->find('first', array(
                        'order' => 'Inventario.id DESC'
                        , 'conditions' => array('Inventario.insumo_id' => $insu['Inventario']['insumo_id'], 'Inventario.sucursale_id' => $this->Session->read('Auth.User.sucursale_id'))
                    ));
                    if (!empty($ult_inventario)) {
                        if ($ult_inventario['Inventario']['total'] >= $insu['Inventario']['cantidad']) {
                            $this->request->data['Inventario']['insumo_id'] = $insu['Inventario']['insumo_id'];
                            $this->request->data['Inventario']['tipo'] = 'Venta';
                            $this->request->data['Inventario']['cantidad'] = $insu['Inventario']['cantidad'];
                            $this->request->data['Inventario']['total'] = $ult_inventario['Inventario']['total'] - $insu['Inventario']['cantidad'];
                            $this->request->data['Inventario']['micraje'] = $insu['Inventario']['micraje'];
                            $this->request->data['Inventario']['alto'] = $insu['Inventario']['alto'];
                            $this->request->data['Inventario']['movimiento_id'] = $idMovimiento;
                            $this->request->data['Inventario']['user_id'] = $this->Session->read('Auth.User.id');
                            $this->request->data['Inventario']['precio'] = $insu['Inventario']['precio'];
                            $this->request->data['Inventario']['sucursale_id'] = $this->Session->read('Auth.User.sucursale_id');
                            $this->Inventario->create();
                            $this->Inventario->save($this->request->data['Inventario']);
                        } else {
                            $sw = TRUE;
                            break;
                        }
                    } else {
                        $sw = TRUE;
                        break;
                    }
                }
                if ($sw) {
                    $this->Inventario->deleteAll(array('Inventario.movimiento_id' => $idMovimiento));
                    $this->Movimiento->delete($idMovimiento);
                    $this->Session->write('rventa', $this->request->data);
                    $this->Session->setFlash('Recursos no suficientes!!', 'msgerror');
                    $this->redirect(array('action' => 'venta'));
                }
            }
        } else {
            
        }
        $this->redirect(array('action' => 'nota_venta', $idMovimiento));
        /* debug($this->request->data);
          exit; */
    }

    //Este algoritmo para registrar transferencias puede generar errores si existiera
    //mas de un ususario usando el sistema
    public function registra_transferencia() {
        if (!empty($this->request->data)) {
            $this->request->data['Movimiento']['tipo'] = 'Transferencia';
            $this->request->data['Movimiento']['sucursale_id'] = $this->Session->read('Auth.User.sucursale_id');
            $this->request->data['Movimiento']['user_id'] = $this->Session->read('Auth.User.id');
            $this->Movimiento->create();
            if ($this->Movimiento->save($this->request->data['Movimiento'])) {
                $idMovimiento = $this->Movimiento->getLastInsertID();
                $sw = FALSE;
                foreach ($this->request->data['Insumos'] as $insu) {
                    $ult_inventario = $this->Inventario->find('first', array(
                        'order' => 'Inventario.id DESC'
                        , 'conditions' => array('Inventario.insumo_id' => $insu['Inventario']['insumo_id'], 'Inventario.sucursale_id' => $this->Session->read('Auth.User.sucursale_id'))
                    ));

                    $ult_inventario_t = $this->Inventario->find('first', array(
                        'order' => 'Inventario.id DESC'
                        , 'conditions' => array('Inventario.insumo_id' => $insu['Inventario']['insumo_id'], 'Inventario.sucursale_id' => $this->request->data['Movimiento']['tsucursale_id'])
                    ));
                    $total_t_s = 0;
                    if (!empty($ult_inventario_t)) {
                        $total_t_s = $ult_inventario_t['Inventario']['total'];
                    }
                    if (!empty($ult_inventario)) {
                        if ($ult_inventario['Inventario']['total'] >= $insu['Inventario']['cantidad']) {
                            $this->request->data['Inventario']['insumo_id'] = $insu['Inventario']['insumo_id'];
                            $this->request->data['Inventario']['tipo'] = 'Venta';
                            $this->request->data['Inventario']['cantidad'] = $insu['Inventario']['cantidad'];
                            $this->request->data['Inventario']['total'] = $ult_inventario['Inventario']['total'] - $insu['Inventario']['cantidad'];
                            $this->request->data['Inventario']['micraje'] = $insu['Inventario']['micraje'];
                            $this->request->data['Inventario']['alto'] = $insu['Inventario']['alto'];
                            $this->request->data['Inventario']['movimiento_id'] = $idMovimiento;
                            $this->request->data['Inventario']['user_id'] = $this->Session->read('Auth.User.id');
                            ;
                            $this->request->data['Inventario']['sucursale_id'] = $this->Session->read('Auth.User.sucursale_id');
                            $this->Inventario->create();
                            $this->Inventario->save($this->request->data['Inventario']);


                            $this->request->data['Inventario']['insumo_id'] = $insu['Inventario']['insumo_id'];
                            $this->request->data['Inventario']['tipo'] = 'Transferido';
                            $this->request->data['Inventario']['cantidad'] = $insu['Inventario']['cantidad'];
                            $this->request->data['Inventario']['total'] = $total_t_s + $insu['Inventario']['cantidad'];
                            $this->request->data['Inventario']['micraje'] = $insu['Inventario']['micraje'];
                            $this->request->data['Inventario']['alto'] = $insu['Inventario']['alto'];
                            $this->request->data['Inventario']['movimiento_id'] = $idMovimiento;
                            $this->request->data['Inventario']['user_id'] = $this->Session->read('Auth.User.id');
                            $this->request->data['Inventario']['sucursale_id'] = $this->request->data['Movimiento']['tsucursale_id'];
                            $this->Inventario->create();
                            $this->Inventario->save($this->request->data['Inventario']);
                        } else {
                            $sw = TRUE;
                            break;
                        }
                    } else {
                        $sw = TRUE;
                        break;
                    }
                }
                if ($sw) {
                    $this->Inventario->deleteAll(array('Inventario.movimiento_id' => $idMovimiento));
                    $this->Movimiento->delete($idMovimiento);
                    $this->Session->write('rtransferencia', $this->request->data);
                    $this->Session->setFlash('Recursos no suficientes!!', 'msgerror');
                    $this->redirect(array('action' => 'transferencia'));
                }
            }
        } else {
            
        }
        $this->redirect(array('action' => 'nota_transferencia', $idMovimiento));
        /* debug($this->request->data);
          exit; */
    }

    public function nota_venta($idMovimiento = null) {
        $movimiento = $this->Movimiento->findByid($idMovimiento);
        $insumos = $this->Inventario->find('all', array('conditions' => array('Inventario.movimiento_id' => $idMovimiento)));
        $this->set(compact('movimiento', 'insumos'));
    }

    public function nota_transferencia($idMovimiento = null) {
        $movimiento = $this->Movimiento->findByid($idMovimiento);
        $insumos = $this->Inventario->find('all', array('conditions' => array('Inventario.movimiento_id' => $idMovimiento)));
        $this->set(compact('movimiento', 'insumos'));
    }

    public function inventario($idTrabajo = null) {
        $hproducciones = $this->Hojasproduccione->findAllBytrabajo_id($idTrabajo, NULL, NULL, NULL, NULL, 0);
        $inventarios = $this->Inventario->findAllBytrabajo_id($idTrabajo, NULL, NULL, NULL, NULL, 0);
        $inventarios = $this->Inventario->find('all', array(
            'recursive' => 0,
            'conditions' => array('Inventario.trabajo_id' => $idTrabajo, 'Inventario.tipo !=' => 'Ingreso')
        ));
        //debug($hproducciones);exit;
        $this->set(compact('idTrabajo', 'hproducciones', 'inventarios'));
    }

    public function usado($idHproduccion = null) {
        $this->layout = 'ajax';
        $produccion = $this->Hojasproduccione->findByid($idHproduccion, null, NULL, 0);
        $peso = '';
        if ($produccion['Hojasproduccione']['tipotrabajo_id'] == 1 || $produccion['Hojasproduccione']['tipotrabajo_id'] == 2) {
            $lados = 1;
            if ($produccion['Hojasproduccione']['caras'] == 'Ambos') {
                $lados = 2;
            }
            $peso = $produccion['Hojasproduccione']['cantidad'] * $produccion['Hojasproduccione']['metrajeini'] * $produccion['Hojasproduccione']['metrajefin'] * $lados * 0.0025 / 1000;
            $lista_insumos = $this->Insumo->find('list', array(
                'recursive' => 0,
                'fields' => array('Insumo.id', 'Insumo.nombre', 'Categoria.nombre'),
                'conditions' => array('Insumo.categoria_id' => 2)
            ));
        } else {
            $lista_insumos = $this->Insumo->find('list', array(
                'recursive' => 0,
                'fields' => array('Insumo.id', 'Insumo.nombre', 'Categoria.nombre'),
                'conditions' => array('Insumo.categoria_id !=' => 2)
            ));
        }
        //debug($lista_insumos);exit;
        $this->set(compact('produccion', 'peso', 'lista_insumos'));
    }

    public function registra_inventario() {
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
        $this->redirect(array('action' => 'inventario', $this->request->data['Inventario']['trabajo_id']));
    }

    public function registra_devuelto($idInventario = NULL) {
        $inventario = $this->Inventario->findByid($idInventario, null, null, -1);
        if (!empty($inventario)) {
            $insumo = $this->Inventario->find('first', array(
                'recursive' => -1
                , 'order' => 'Inventario.id DESC'
                , 'conditions' => array('Inventario.insumo_id' => $inventario['Inventario']['insumo_id'], 'Inventario.sucursale_id' => $this->Session->read('Auth.User.sucursale_id'))
            ));
            $total = 0.00;
            if (!empty($insumo)) {
                $total = $insumo['Inventario']['total'];
            }
            $this->Inventario->id = $idInventario;
            $this->request->data['Inventario']['tipo'] = 'Devuelto';
            $this->Inventario->save($this->request->data['Inventario']);

            $this->request->data['Inventario']['insumo_id'] = $inventario['Inventario']['insumo_id'];
            $this->request->data['Inventario']['tipo'] = 'Ingreso';
            $this->request->data['Inventario']['cantidad'] = $inventario['Inventario']['cantidad'];
            $this->request->data['Inventario']['total'] = $total - $inventario['Inventario']['cantidad'];
            $this->request->data['Inventario']['observacion'] = $inventario['Inventario']['observacion'];
            $this->request->data['Inventario']['micraje'] = $inventario['Inventario']['micraje'];
            $this->request->data['Inventario']['hojasproduccione_id'] = $inventario['Inventario']['hojasproduccione_id'];
            $this->request->data['Inventario']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Inventario']['sucursale_id'] = $inventario['Inventario']['sucursale_id'];
            $this->request->data['Inventario']['trabajo_id'] = $inventario['Inventario']['trabajo_id'];

            $this->Inventario->create();
            $this->Inventario->save($this->request->data['Inventario']);

            $this->Session->setFlash('Se registro correctamente!!', 'msgbueno');
            $this->redirect(array('action' => 'inventario', $inventario['Inventario']['trabajo_id']));
        } else {
            $this->Session->setFlash('No se pudo regsitrar!!', 'msgerror');
            $this->redirect($this->referer());
        }
    }

    public function cancelar_venta($idMovimiento = NULL) {
        $inventarios = $this->Inventario->find('all', array(
            'recursive' => -1,
            'conditions' => array('Inventario.movimiento_id' => $idMovimiento)
        ));
        foreach ($inventarios as $in) {
            $total_ins = 0;
            $ult_inventario = $this->Inventario->find('first', array(
                'order' => 'Inventario.id DESC'
                , 'conditions' => array('Inventario.insumo_id' => $in['Inventario']['insumo_id'], 'Inventario.sucursale_id' => $in['Inventario']['sucursale_id'])
            ));
            if (!empty($ult_inventario)) {
                $total_ins = $ult_inventario['Inventario']['total'];
            }
            $this->request->data['Inventario']['insumo_id'] = $in['Inventario']['insumo_id'];
            $this->request->data['Inventario']['tipo'] = 'Venta Cancelada';
            $this->request->data['Inventario']['cantidad'] = $in['Inventario']['cantidad'];
            $this->request->data['Inventario']['total'] = $total_ins + $in['Inventario']['cantidad'];
            $this->request->data['Inventario']['micraje'] = $in['Inventario']['micraje'];
            $this->request->data['Inventario']['alto'] = $in['Inventario']['alto'];
            $this->request->data['Inventario']['movimiento_id'] = $idMovimiento;
            $this->request->data['Inventario']['user_id'] = $this->Session->read('Auth.User.id');
            $this->request->data['Inventario']['precio'] = $in['Inventario']['precio'];
            $this->request->data['Inventario']['sucursale_id'] = $this->Session->read('Auth.User.sucursale_id');
            $this->Inventario->create();
            $this->Inventario->save($this->request->data['Inventario']);
        }
        $this->Movimiento->id = $idMovimiento;
        $this->request->data['Movimiento']['tipo'] = 'Venta Cancelada';
        $this->Movimiento->save($this->request->data['Movimiento']);
        $this->Session->setFlash("Se cancelo la venta", 'msgbueno');
        $this->redirect(array('action' => 'ventas'));
    }

}
