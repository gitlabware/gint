<?php

App::uses('AppController', 'Controller');

class ReportesController extends AppController {

    public $uses = array('Trabajo', 'Tipotrabajo', 'Sucursale', 'Hojasproduccione', 'Cliente', 'Nota', 'User', 'Cajachica');
    public $layout = 'general';

    public function index() {
        $tipotrabajos = $this->Tipotrabajo->find('list', array('fields' => array('Tipotrabajo.descripcion')));
        $tipotrabajos['Todos'] = 'Todos';
        $sucursales = $this->Sucursale->find('list', array('fields' => array('Sucursale.nombre')));
        $sucursales['Todos'] = 'Todos';
        $clientes = $this->Cliente->find('list', array('fields' => array('Cliente.nombre')));
        $clientes['Todos'] = 'Todos';
        $usuarios = $this->User->find('list', array('fields' => array('User.nombre')));
        $usuarios['Todos'] = 'Todos';
        $this->set(compact('tipotrabajos', 'sucursales', 'clientes', 'usuarios'));
    }

    public function reporte_tipo_trabajo() {

        $tipotrabajo_id = $this->data['Hojasproduccione']['tipotrabajo'];
        $tipotrabajo = $this->Tipotrabajo->find('first', array('fields' => array('Tipotrabajo.descripcion'), 'conditions' => array('Tipotrabajo.id' => $tipotrabajo_id)));
        //debug($tipotrabajo);exit;
        $sucursal_id = $this->data['Hojasproduccione']['sucursale_id'];
        $sucursal = $this->Sucursale->find('first', array('fields' => array('Sucursale.nombre'), 'conditions' => array('Sucursale.id' => $sucursal_id)));
        $fecha1 = $this->data['Hojasproduccione']['fecha_inicio'];
        $fecha2 = $this->data['Hojasproduccione']['fecha_fin'];
        $tipofecha = $this->data['Hojasproduccione']['tipo_fecha'];
        $condiciones = array();
        if (!empty($sucursal_id) && $sucursal_id != 'Todos') {
            $condiciones['Hojasproduccione.sucursale_id'] = $sucursal_id;
        }
        if (!empty($tipotrabajo_id) && $tipotrabajo_id != 'Todos') {
            $condiciones['Hojasproduccione.tipotrabajo_id'] = $tipotrabajo_id;
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $condiciones["$tipofecha BETWEEN ? AND ? "] = array($fecha1, $fecha2);
        }
        $sql1 = "(case when (tipo = 'Nota de entrega') THEN (CONCAT('NE ',id)) ELSE (CONCAT('NR ',id)) END) as orden";
        $sql2 = "SELECT $sql1 FROM `notas` WHERE (notas.trabajo_id = Hojasproduccione.trabajo_id AND notas.estado != 'Eliminado') ORDER BY id DESC";
        $sql3 = "SELECT nombre FROM `clientes` WHERE (clientes.id = Trabajo.cliente_id)";
        $sql4 = "SELECT descripcion FROM `tipotrabajos` WHERE (tipotrabajos.id = Hojastipostrabajo.tipotrabajo_id)";
        $this->Hojasproduccione->virtualFields = array(
            'orden' => "CONCAT(($sql2))",
            'cliente' => "CONCAT(($sql3))",
            'formato' => "CONCAT(Hojasproduccione.metrajeini,'x',Hojasproduccione.metrajefin)",
            'tipo_trabajo' => "CONCAT(($sql4))"
        );
        $resultados = $this->Hojasproduccione->find('all', array(
            'recursive' => 0,
            'conditions' => $condiciones
            , 'fields' => array('DATE(Hojasproduccione.created) as fecha_produccion', 'Hojasproduccione.trabajo_id',
                'Hojasproduccione.numero_hruta', 'Hojasproduccione.orden', 'Hojasproduccione.cliente', 'Hojasproduccione.cantidad'
                , 'Hojasproduccione.descripcion', 'Hojasproduccione.formato', 'Hojasproduccione.caras', 'Hojasproduccione.costo', 'Hojasproduccione.tipo_trabajo')
                )
        );
        /* debug($resultados);
          exit; */
        $this->set(compact('tipotrabajo', 'sucursal', 'resultados', 'fecha1', 'fecha2'));
    }

    public function reporte_tipo_clientes() {

        $cliente_id = $this->data['Hojasproduccione']['cliente_id'];
        $cliente = $this->Cliente->find('first', array('fields' => array('Cliente.nombre'), 'conditions' => array('Cliente.id' => $cliente_id)));
        //debug($tipotrabajo);exit;
        $sucursal_id = $this->data['Hojasproduccione']['sucursale_id'];
        $sucursal = $this->Sucursale->find('first', array('fields' => array('Sucursale.nombre'), 'conditions' => array('Sucursale.id' => $sucursal_id)));
        $fecha1 = $this->data['Hojasproduccione']['fecha_inicio'];
        $fecha2 = $this->data['Hojasproduccione']['fecha_fin'];
        $tipofecha = $this->data['Hojasproduccione']['tipo_fecha'];
        $condiciones = array();
        if (!empty($sucursal_id) && $sucursal_id != 'Todos') {
            $condiciones['Hojasproduccione.sucursale_id'] = $sucursal_id;
        }
        if (!empty($cliente_id) && $cliente_id != 'Todos') {
            $condiciones['Trabajo.cliente_id'] = $cliente_id;
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $condiciones["$tipofecha BETWEEN ? AND ? "] = array($fecha1, $fecha2);
        }
        $sql1 = "(case when (tipo = 'Nota de entrega') THEN (CONCAT('NE ',id)) ELSE (CONCAT('NR ',id)) END) as orden";
        $sql2 = "SELECT $sql1 FROM `notas` WHERE (notas.trabajo_id = Hojasproduccione.trabajo_id AND notas.estado != 'Eliminado') ORDER BY id DESC";
        $sql3 = "SELECT nombre FROM `clientes` WHERE (clientes.id = Trabajo.cliente_id)";
        $sql4 = "SELECT descripcion FROM `tipotrabajos` WHERE (tipotrabajos.id = Hojastipostrabajo.tipotrabajo_id)";
        $this->Hojasproduccione->virtualFields = array(
            'orden' => "CONCAT(($sql2))",
            'cliente' => "CONCAT(($sql3))",
            'formato' => "CONCAT(Hojasproduccione.metrajeini,'x',Hojasproduccione.metrajefin)",
            'tipo_trabajo' => "CONCAT(($sql4))"
        );
        $resultados = $this->Hojasproduccione->find('all', array(
            'recursive' => 0,
            'conditions' => $condiciones
            , 'fields' => array('DATE(Hojasproduccione.created) as fecha_produccion', 'Hojasproduccione.trabajo_id',
                'Hojasproduccione.numero_hruta', 'Hojasproduccione.orden', 'Hojasproduccione.cliente', 'Hojasproduccione.cantidad'
                , 'Hojasproduccione.descripcion', 'Hojasproduccione.formato', 'Hojasproduccione.caras', 'Hojasproduccione.costo', 'Hojasproduccione.tipo_trabajo')
                )
        );
        /* debug($resultados);
          exit; */
        $this->set(compact('tipotrabajo', 'sucursal', 'resultados', 'fecha1', 'fecha2', 'cliente'));
    }

    public function reporte_tipo_entrega() {

        $tipoentrega = $this->data['Hojasproduccione']['tiponota'];
        //debug($tipotrabajo);exit;
        $sucursal_id = $this->data['Hojasproduccione']['sucursale_id'];
        $sucursal = $this->Sucursale->find('first', array('fields' => array('Sucursale.nombre'), 'conditions' => array('Sucursale.id' => $sucursal_id)));
        $fecha1 = $this->data['Hojasproduccione']['fecha_inicio'];
        $fecha2 = $this->data['Hojasproduccione']['fecha_fin'];
        $tipofecha = $this->data['Hojasproduccione']['tipo_fecha'];
        $condiciones = array();
        if (!empty($sucursal_id) && $sucursal_id != 'Todos') {
            $condiciones['Hojasproduccione.sucursale_id'] = $sucursal_id;
        }
        if (!empty($tipoentrega) && $tipoentrega != 'Todos') {
            $condiciones['Hojasproduccione.tipo_nota'] = $tipoentrega;
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $condiciones["$tipofecha BETWEEN ? AND ? "] = array($fecha1, $fecha2);
        }
        $sql1 = "(case when (tipo = 'Nota de entrega') THEN (CONCAT('NE ',id)) ELSE (CONCAT('NR ',id)) END) as orden";
        $sql2 = "SELECT $sql1 FROM `notas` WHERE (notas.trabajo_id = Hojasproduccione.trabajo_id AND notas.estado != 'Eliminado') ORDER BY id DESC";
        $sql3 = "SELECT nombre FROM `clientes` WHERE (clientes.id = Trabajo.cliente_id)";
        $sql4 = "SELECT descripcion FROM `tipotrabajos` WHERE (tipotrabajos.id = Hojastipostrabajo.tipotrabajo_id)";
        $this->Hojasproduccione->virtualFields = array(
            'orden' => "CONCAT(($sql2))",
            'cliente' => "CONCAT(($sql3))",
            'formato' => "CONCAT(Hojasproduccione.metrajeini,'x',Hojasproduccione.metrajefin)",
            'tipo_trabajo' => "CONCAT(($sql4))"
        );
        $resultados = $this->Hojasproduccione->find('all', array(
            'recursive' => 0,
            'conditions' => $condiciones
            , 'fields' => array('DATE(Hojasproduccione.created) as fecha_produccion', 'Hojasproduccione.trabajo_id',
                'Hojasproduccione.numero_hruta', 'Hojasproduccione.orden', 'Hojasproduccione.cliente', 'Hojasproduccione.cantidad'
                , 'Hojasproduccione.descripcion', 'Hojasproduccione.formato', 'Hojasproduccione.caras', 'Hojasproduccione.costo', 'Hojasproduccione.tipo_trabajo')
                )
        );
        /* debug($resultados);
          exit; */
        $this->set(compact('tipotrabajo', 'sucursal', 'resultados', 'fecha1', 'fecha2', 'tipoentrega'));
    }

    public function reporte_tipo_pago() {
        $sucursal_id = $this->request->data['Nota']['sucursale_id'];
        $sucursal = $this->Sucursale->find('first', array('fields' => array('Sucursale.nombre'), 'conditions' => array('Sucursale.id' => $sucursal_id)));
        $tipopago = $this->request->data['Nota']['tipopago'];
        $fecha1 = $this->request->data['Nota']['fecha_inicio'];
        $fecha2 = $this->request->data['Nota']['fecha_fin'];
        $condiciones = array();
        if (!empty($sucursal_id) && $sucursal_id != 'Todos') {
            $condiciones['Nota.sucursale_id'] = $sucursal_id;
        }
        if (!empty($tipopago) && $tipopago != 'Todos') {
            $condiciones['Nota.tipo_pago'] = $tipopago;
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $condiciones["DATE(Nota.created) BETWEEN ? AND ? "] = array($fecha1, $fecha2);
        }
        $condiciones['Nota.estado !='] = 'Eliminado';

        $sql1 = "SELECT nombre FROM `clientes` WHERE (clientes.id = Trabajo.cliente_id)";
        $this->Nota->virtualFields = array(
            'cliente' => "CONCAT(($sql1))"
        );
        $resultados = $this->Nota->find('all', array(
            'recursive' => 0,
            'fields' => array('DATE(Nota.created) as fecha_nota', 'Nota.numero', 'Nota.cliente', 'Nota.tipo_pago', 'Nota.tipo', 'Nota.numero_factura', 'Nota.total_pagado', 'Sucursale.nombre', 'Nota.observaciones', 'Nota.trabajo_id'),
            'conditions' => $condiciones
        ));
        $this->set(compact('resultados', 'fecha1', 'fecha2', 'sucursal', 'tipopago'));
    }

    public function reporte_caja_chica() {
        $usuario_id = $this->request->data['Cajachica']['user_id'];
        $tipo = $this->request->data['Cajachica']['tipo'];
        $fecha1 = $this->request->data['Cajachica']['fecha_inicio'];
        $fecha2 = $this->request->data['Cajachica']['fecha_fin'];
        $condiciones = array();
        if (!empty($usuario_id) && $usuario_id != 'Todos') {
            $condiciones['Cajachica.user_id'] = $usuario_id;
        }
        if ($tipo != 'Todos') {
            if ($tipo == 'entrada') {
                $condiciones['Cajachica.entrada !='] = 0;
            } elseif ($tipo == 'salida') {
                $condiciones['Cajachica.salida !='] = 0;
            }
        }
        $condiciones['Cajachica.fecha BETWEEN ? AND ? '] = array($fecha1, $fecha2);
        $movimientos=$this->Cajachica->find('all', array(
            'recursive' => 0,
            'fields'=>array('Cajachica.fecha', 'Categoriasmonto.nombre','Cajachica.nota','Cajachica.entrada', 'Cajachica.salida','Cajachica.total','Cajachica.observaciones','User.nombre'),
            'conditions' => $condiciones
        ));
        $this->set(compact('fecha1', 'fecha2','movimientos','tipo'));
    }

}
