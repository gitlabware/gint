<?php

class TrabajosController extends AppController {

    public $layout = 'general';
    public $uses = array(
        'Trabajo', 'Cliente', 'Tipotrabajo', 'Sucursale',
        'Maquinaria', 'Hojastipostrabajo', 'Empleadostrabajo',
        'User', 'Hojasproduccione', 'Formato', 'Nota'
    );
    var $components = array('RequestHandler', 'DataTable');

    public function beforeFilter() {
        parent::beforeFilter();
        if ($this->RequestHandler->responseType() == 'json') {
            $this->RequestHandler->setContent('json', 'application/json');
        }
        //debug($this->RequestHandler->responseType());
    }

    public function index() {
        if ($this->RequestHandler->responseType() == 'json') {
            $editar = '<button class="btn btn-info btn-xs" type="button" onclick="editart(' . "',Trabajo.id,'" . ')"><i class="icon ico-pencil"></i>Editar</button>';
            $imprimir = '<button class="btn btn-inverse btn-xs" type="button" onclick="imprimirt(' . "',Trabajo.id,'" . ')"><i class="icon ico-print"></i>Imprimir</button>';
            $produccion = '<button class="btn btn-success btn-xs" type="button" onclick="produccion(' . "',Trabajo.id,'" . ')"><i class="icon ico-cogs"></i>Produccion</button>';
            $elimina = '<button class="btn btn-danger btn-xs" type="button" onclick="eliminart(' . "',Trabajo.id,'" . ')"><i class="icon ico-remove3"></i>Eliminar</button>';
            $acciones = '' . $editar . ' ' . $imprimir . ' ' . $produccion . ' ' . $elimina . '';
            $this->Trabajo->virtualFields = array(
                'acciones' => "CONCAT('$acciones')"
            );
            $this->paginate = array(
                'fields' => array('Trabajo.id', 'Cliente.nombre', 'Cliente.telefono', 'Sucursale.nombre', 'Trabajo.estado', 'Trabajo.created', 'Trabajo.acciones'),
                //'joins' => array( array('table' => 'mascotas_propietarios', 'alias' => 'Mascotaspropieatario', 'type' => 'LEFT', 'conditions' => array( 'Mascota.id = Mascotaspropieatario.mascota_id' ) ) ),
                'recursive' => 0,
                'order' => 'Trabajo.id DESC'
            );
            $this->DataTable->fields = array('Trabajo.id', 'Cliente.nombre', 'Cliente.telefono', 'Sucursale.nombre', 'Trabajo.estado', 'Trabajo.created', 'Trabajo.acciones');
            $this->DataTable->emptyEleget_usuarios_adminments = 1;
            $this->set('trabajos', $this->DataTable->getResponse());
            $this->set('_serialize', 'trabajos');
        }
    }

    public function prueba() {
        $this->layout = 'ajax';
    }

    public function trabajo($idTrabajo = null) {
        $this->Trabajo->id = $idTrabajo;
        $this->request->data = $this->Trabajo->read();
        $data_tipost = $this->Hojastipostrabajo->find('all', array(
            'group' => array('Hojastipostrabajo.numero_hojaruta'),
            'conditions' => array('Hojastipostrabajo.trabajo_id' => $idTrabajo),
            'fields' => array('Hojastipostrabajo.numero_hojaruta')
        ));
        $data_empleados = $this->Empleadostrabajo->findAllBytrabajo_id($idTrabajo, NULL, NULL, null, NULL, -1);
        //debug($data_empleados);exit;
        $empleados = $this->User->find('all', array('fields' => array('User.nombre', 'User.id'), 'conditions' => array('User.role' => 'Empleado')));
        $maquinarias = $this->Maquinaria->find('all', array('fields' => array('Maquinaria.nombre', 'Maquinaria.id')));
        $sucursales = $this->Sucursale->find('all', array('fields' => array('Sucursale.nombre', 'Sucursale.id')));
        $clientes = $this->Cliente->find('list', array('fields' => 'Cliente.nombre'));
        $tipostrabajos = $this->Tipotrabajo->find('all', array('fields' => array('Tipotrabajo.descripcion', 'Tipotrabajo.id')
            , 'conditions' => array('Tipotrabajo.tipo !=' => NULL)
        ));
        $this->set(compact('clientes', 'tipostrabajos', 'sucursales', 'maquinarias', 'empleados', 'data_tipost', 'idTrabajo', 'data_empleados'));
    }

    public function registra_trabajo() {
        /* debug($this->request->data);
          exit; */
        $this->Trabajo->create();
        if ($this->Trabajo->save($this->request->data['Trabajo'])) {
            if (!empty($this->request->data['Trabajo']['id'])) {
                $idTrabajo = $this->request->data['Trabajo']['id'];
                $this->Empleadostrabajo->deleteAll(array('Empleadostrabajo.trabajo_id' => $idTrabajo));
                $this->Hojastipostrabajo->deleteAll(array('Hojastipostrabajo.trabajo_id' => $idTrabajo));
            } else {
                $idTrabajo = $this->Trabajo->getLastInsertID();
            }
            foreach ($this->request->data['Aux'] as $key => $aux) {
                if (!empty($aux['trabajos'][0]['numero_hojaruta'])) {
                    $numero_ruta = $aux['trabajos'][0]['numero_hojaruta'];
                } else {
                    $numero_ruta = $this->get_numero_ruta($aux['sucursale_id']);
                }
                foreach ($aux['trabajos'] as $tra) {
                    $this->request->data['Hojastipostrabajo']['trabajo_id'] = $idTrabajo;
                    $this->request->data['Hojastipostrabajo']['sucursale_id'] = $aux['sucursale_id'];
                    $this->request->data['Hojastipostrabajo']['numero'] = $key;
                    $this->request->data['Hojastipostrabajo']['tipotrabajo_id'] = $tra['tipotrabajo_id'];
                    $this->request->data['Hojastipostrabajo']['numero_hojaruta'] = $numero_ruta;
                    $this->request->data['Hojastipostrabajo']['descripcion'] = $aux['descripcion'];
                    $this->request->data['Hojastipostrabajo']['cantidad_nominal'] = $aux['cantidad_nominal'];
                    $this->request->data['Hojastipostrabajo']['caras'] = $tra['caras'];
                    $this->Hojastipostrabajo->create();
                    $this->Hojastipostrabajo->save($this->request->data['Hojastipostrabajo']);
                }
            }
            if (!empty($this->request->data['Empleado'])) {
                foreach ($this->request->data['Empleado'] as $emp) {
                    $this->Empleadostrabajo->create();
                    $this->request->data['Empleadostrabajo']['empleado_id'] = $emp['empleado_id'];
                    $this->request->data['Empleadostrabajo']['maquinaria_id'] = $emp['maquinaria_id'];
                    $this->request->data['Empleadostrabajo']['trabajo_id'] = $idTrabajo;
                    $this->Empleadostrabajo->save($this->request->data['Empleadostrabajo']);
                }
            }
            $this->Session->setFlash('Se registro correctamente el trabajo #' . $idTrabajo, 'msgbueno');
            $this->redirect(array('action' => 'vista_trabajo', $idTrabajo));
        }
        $this->redirect(array('action' => 'index'));
    }

    protected function get_numero_ruta($idSucursal = NULL) {
        $ultimo = $this->Hojastipostrabajo->find('first', array('recursive' => -1, 'order' => 'Hojastipostrabajo.numero_hojaruta DESC', 'conditions' => array('Hojastipostrabajo.sucursale_id' => $idSucursal)));
        if (empty($ultimo)) {
            return 1;
        } else {
            return $ultimo['Hojastipostrabajo']['numero_hojaruta'] + 1;
        }
    }

    public function vista_trabajo($idTrabajo = null) {
        $trabajo = $this->Trabajo->findByid($idTrabajo);
        $tipostra = $this->Hojastipostrabajo->findAllBytrabajo_id($idTrabajo);
        $empleados = $this->Empleadostrabajo->findAllBytrabajo_id($idTrabajo);
        $tipostrabajos = $this->Hojastipostrabajo->find('all', array(
            'group' => array('Hojastipostrabajo.numero_hojaruta'),
            'conditions' => array('Hojastipostrabajo.trabajo_id' => $idTrabajo),
            'fields' => array('Hojastipostrabajo.numero_hojaruta')
        ));
        //debug($tipostra);exit;
        $this->set(compact('trabajo', 'tipostra', 'empleados', 'tipostrabajos'));
    }

    public function eliminar($idTrabajo = null) {
        $this->Trabajo->delete($idTrabajo);
        $this->Session->setFlash('Se elimino correctamente el trabajo!!', 'msgbueno');
        $this->redirect(array('action' => 'index'));
    }

    public function vista_produccion($idTrabajo = NULL) {
        $trabajo = $this->Trabajo->findByid($idTrabajo);
        $producciones = $this->Hojasproduccione->find('all', array('conditions' => array('Hojasproduccione.trabajo_id' => $idTrabajo)));
        if (empty($producciones)) {
            $this->redirect(array('action' => 'produccion', $idTrabajo));
        }
        $this->set(compact('trabajo', 'producciones'));
    }

    public function produccion($idTrabajo = null) {
        $trabajo = $this->Trabajo->findByid($idTrabajo);
        $hojas_tra = $this->Hojastipostrabajo->find('all', array(
            'conditions' => array('Hojastipostrabajo.trabajo_id' => $idTrabajo)
        ));
        $this->Formato->virtualFields = array(
            'precios2' => "CONCAT(ROUND(Formato.desdemedini),'x',ROUND(Formato.desdemedfin),' hasta ',ROUND(Formato.hastamedini),'x',ROUND(Formato.hastamedfin),' | ',Formato.cantidadinicial,' a ',Formato.cantidadfinal,' | ',Formato.precio,' Bs')",
            'precios4' => "CONCAT(ROUND(Formato.desdemedini),'x',ROUND(Formato.desdemedfin),' hasta ',ROUND(Formato.hastamedini),'x',ROUND(Formato.hastamedfin),' | ',Formato.rangoini,' a ',Formato.rangofin,' | ',Formato.cantidadinicial,' a ',Formato.cantidadfinal,' | ',Formato.precio,' Bs')",
            'precios_g_cortes' => "CONCAT(Formato.cantidadinicial,' a ',Formato.cantidadfinal,' | ',Formato.numero_cortes,' cortes | ',Formato.precio,' Bs')",
            'precios_g_hora' => "CONCAT(Formato.cantidadinicial,' a ',Formato.cantidadfinal,' | ',Formato.numero_cortes,' cortes | ',Formato.precio,' Bs')",
            'troquelado' => "CONCAT(Formato.cantidadinicial,' a ',Formato.cantidadfinal,' | ',Formato.numero_lineas,' cortes | ',Formato.precio,' Bs')",
            'l_agua' => "CONCAT(Formato.cantidadinicial,' a ',Formato.cantidadfinal,' | ',Formato.numero_lineas,' cortes | ',Formato.precio,' Bs')"
        );
        $precios2 = $this->Formato->find('list', array(
            'fields' => array('Formato.id', 'Formato.precios2'),
            'recursive' => 0,
            'conditions' => array('Tipotrabajo.tipo' => 2)
        ));
        $precios2_array = $this->Formato->find('all', array(
            'fields' => array('Formato.id', 'Formato.precio', 'Formato.cantidadfinal'),
            'recursive' => 0,
            'conditions' => array('Tipotrabajo.tipo' => 2)
        ));
        $precios4 = $this->Formato->find('list', array(
            'fields' => array('Formato.id', 'Formato.precios4'),
            'recursive' => 0,
            'conditions' => array('Tipotrabajo.tipo' => 4)
        ));
        $precios4_array = $this->Formato->find('all', array(
            'fields' => array('Formato.id', 'Formato.precio', 'Formato.cantidadfinal'),
            'recursive' => 0,
            'conditions' => array('Tipotrabajo.tipo' => 4)
        ));
        $precios_g_cortes = $this->Formato->find('list', array(
            'fields' => array('Formato.id', 'Formato.precios_g_cortes'),
            'recursive' => -1,
            'conditions' => array('Formato.tipotrabajo_id' => 15)
        ));
        $precios_g_cortes_array = $this->Formato->find('all', array(
            'fields' => array('Formato.id', 'Formato.precio', 'Formato.cantidadfinal'),
            'recursive' => -1,
            'conditions' => array('Formato.tipotrabajo_id' => 15)
        ));
        $precios_g_hora = $this->Formato->find('list', array(
            'fields' => array('Formato.id', 'Formato.precios_g_hora'),
            'recursive' => -1,
            'conditions' => array('Formato.tipotrabajo_id' => 16)
        ));
        $precios_g_hora_array = $this->Formato->find('all', array(
            'fields' => array('Formato.id', 'Formato.precio', 'Formato.cantidadfinal'),
            'recursive' => -1,
            'conditions' => array('Formato.tipotrabajo_id' => 16)
        ));
        $precios_troquelado = $this->Formato->find('list', array(
            'fields' => array('Formato.id', 'Formato.troquelado'),
            'recursive' => -1,
            'conditions' => array('Formato.tipotrabajo_id' => 17)
        ));
        $precios_troquelado_array = $this->Formato->find('all', array(
            'fields' => array('Formato.id', 'Formato.precio', 'Formato.cantidadfinal'),
            'recursive' => -1,
            'conditions' => array('Formato.tipotrabajo_id' => 17)
        ));
        $precios_l_agua = $this->Formato->find('list', array(
            'fields' => array('Formato.id', 'Formato.l_agua'),
            'recursive' => -1,
            'conditions' => array('Formato.tipotrabajo_id' => 18)
        ));
        $precios_l_agua_array = $this->Formato->find('all', array(
            'fields' => array('Formato.id', 'Formato.precio', 'Formato.cantidadfinal'),
            'recursive' => -1,
            'conditions' => array('Formato.tipotrabajo_id' => 18)
        ));
        $sw = 0;
        if (!empty($trabajo['Hojasproduccione'])) {
            $sw = 1;
            $this->request->data['Hojasproduccione'] = $trabajo['Hojasproduccione'];
            $this->request->data['Hojasproduccione']['tipo_nota'] = $trabajo['Hojasproduccione'][0]['tipo_nota'];
        }

        /* debug($trabajo);
          exit; */
        $this->set(compact(
                        'trabajo', 'hojas_tra', 'precios2', 'precios4', 'precios2_array', 'precios4_array', 'precios_g_cortes', 'precios_g_cortes_array', 'precios_g_hora', 'precios_g_hora_array', 'precios_troquelado', 'precios_troquelado_array', 'precios_l_agua', 'precios_l_agua_array', 'sw'
        ));
    }

    public function registra_produccion($idTrabajo = null, $sw = null) {
        /* debug($this->request->data);
          exit; */
        if (!empty($this->request->data['Hojasproduccione'])) {
            $this->Hojasproduccione->saveMany($this->request->data['Hojasproduccione']);
            if (!$sw) {
                $this->Trabajo->id = $idTrabajo;
                $this->request->data['Trabajo']['estado'] = 'Produccion';
                $this->Trabajo->save($this->request->data['Trabajo']);
            }
            $this->Session->setFlash('Se registro correctamente!!', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo regsitrar intente nuevamente!!', 'msgerror');
        }
        $this->redirect(array('action' => 'vista_produccion', $idTrabajo));
    }

    public function nota($idTrabajo = null, $tipo = null) {
        $nota = $this->Nota->findBytrabajo_id($idTrabajo, NULL, NULL, -1);
        $trabajo = $this->Trabajo->findByid($idTrabajo);
        $hp_total = $this->Hojasproduccione->find('all', array(
            'recursive' => -1,
            'conditions' => array('Hojasproduccione.trabajo_id' => $idTrabajo),
            'fields' => array('ROUND(SUM(Hojasproduccione.costo),2) as costo_total')
        ));
        $total = $hp_total[0][0]['costo_total'];
        $this->request->data['Nota']['total_pagado'] = $total;
        $this->request->data['Nota']['saldo'] = 0;
        $ultima_nota = $this->Nota->find('first', array(
            'order' => 'Nota.numero DESC',
            'conditions' => array('Nota.sucursale_id' => $trabajo['Trabajo']['sucursale_id'], 'Nota.tipo' => $tipo),
            'fields' => array('Nota.numero')
        ));
        if (!empty($ultima_nota)) {
            $numero = $ultima_nota['Nota']['numero'] + 1;
        } else {
            $numero = 1;
        }
        $this->request->data['Nota']['tipo'] = $tipo;
        if (!empty($nota)) {
            $this->Nota->id = $nota['Nota']['id'];
            $this->request->data = $this->Nota->read();
        }
        $this->set(compact('trabajo', 'tipo', 'numero', 'total'));
    }

    public function registra_nota($idTrabajo = NULL) {
        //debug($this->request->data);exit;
        $this->Nota->create();
        if ($this->Nota->save($this->request->data['Nota'])) {
            $this->Session->setFlash('Se regsitro correctamente!!', 'msgbueno');
        } else {
            $this->Session->setFlash('No se pudo registrar intente nuevamente!!!', 'msgerror');
        }
        $this->redirect(array('action' => 'vista_nota', $idTrabajo));
    }

    public function vista_nota($idTrabajo = NULL, $tipo = NULL) {
        $nota = $this->Nota->findBytrabajo_id($idTrabajo);
        if (empty($nota)) {
            $this->redirect(array('action' => 'nota', $idTrabajo, $tipo));
        }
        $trabajo = $this->Trabajo->findByid($idTrabajo, null, NULL, 0);
        $hproducciones = $this->Hojasproduccione->findAllBytrabajo_id($idTrabajo, NULL, NULL, NULL, NULL, 0);
        $this->set(compact('trabajo', 'nota', 'hproducciones'));
    }

}
