<?php

App::uses('AppController', 'Controller');

class ReportesController extends AppController {

  public $uses = array('Trabajo', 'Tipotrabajo', 'Sucursale', 'Hojasproduccione');
  public $layout = 'general';

  public function index() {
    $tipotrabajos = $this->Tipotrabajo->find('list', array('fields' => array('Tipotrabajo.descripcion')));
    $tipotrabajos['Todos'] = 'Todos';
    $sucursales = $this->Sucursale->find('list', array('fields' => array('Sucursale.nombre')));
    $sucursales['Todos'] = 'Todos';
    $this->set(compact('tipotrabajos', 'sucursales'));
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
      $condiciones['Hojasproduccione.sucursal_id'] = $sucursal_id;
    }
    if (!empty($tipotrabajo_id) && $tipotrabajo_id != 'Todos') {
      $condiciones['Hojasproduccione.tipotrabajo_id'] = $tipotrabajo_id;
    }
    if (!empty($fecha1) && !empty($fecha2)) {
      $condiciones["$tipofecha BETWEEN ? AND ? "] = array($fecha1, $fecha2);
    }
    $sql1 = "(case when (tipo = 'Nota de entrega') THEN (CONCAT('NE ',id)) ELSE (CONCAT('NR ',id)) END) as orden";
    $sql2 = "SELECT $sql1 FROM `notas` WHERE (notas.trabajo_id = Hojasproduccione.trabajo_id)";
    $sql3 = "SELECT nombre FROM `clientes` WHERE (clientes.id = Trabajo.cliente_id)";
    
    $this->Hojasproduccione->virtualFields = array(
      'orden' => "CONCAT(($sql2))",
      'cliente' => "CONCAT(($sql3))",
      'formato' => "CONCAT(Hojasproduccione.metrajeini,'x',Hojasproduccione.metrajefin)"
    );
    $resultados = $this->Hojasproduccione->find('all', array(
      'recursive' => 0,
      'conditions' => $condiciones
      , 'fields' => array('DATE(Hojasproduccione.created) as fecha_produccion', 'Hojasproduccione.id',
        'Hojasproduccione.numero_hruta', 'Hojasproduccione.orden','Hojasproduccione.cliente','Hojasproduccione.cantidad'
        ,'Hojasproduccione.descripcion','Hojasproduccione.formato','Hojasproduccione.caras','Hojasproduccione.costo')
      )
    );
    debug($resultados);
    exit;
    $this->set(compact('tipotrabajo', 'sucursal', 'resultados', 'fecha1', 'fecha2'));
  }

}
