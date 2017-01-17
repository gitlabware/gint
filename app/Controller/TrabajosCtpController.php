<?php

App::uses('AppController', 'Controller');

class TrabajosCtpController extends AppController
{

    public $uses = array('TrabajosCtp', 'ClientesCtp', 'InsumosCtp', 'TotalesCtp', 'VentasCtp', 'PagosCtp');
    public $layout = 'general';

    public function index()
    {
        $trabajos = $this->TrabajosCtp->find('all', array(
            'recursive' => 0,
            'order' => array('TrabajosCtp.modified DESC'),
            'conditions' => array('TrabajosCtp.deleted' => null),
            'fields' => array('TrabajosCtp.*', 'User.*', 'ClientesCtp.*')
        ));
        $this->set(compact('trabajos'));
    }

    public function trabajo($idCliente, $idTrabajo = null)
    {
        if (!empty($this->request->data)) {
            /*debug($this->request->data);
            exit;*/
            $idSucursal = $this->Session->read('Auth.User.Sucursale.id');
            $sw_ins = true;
            foreach ($this->request->data['Insumos'] as $insumo) {
                if (!empty($insumo['cantidad'])) {

                    $total_din = $this->TotalesCtp->find('first', array(
                        'recursive' => -1,
                        'conditions' => array('TotalesCtp.sucursale_id' => $idSucursal, 'TotalesCtp.insumos_ctp_id' => $insumo['insumos_ctp_id'])
                    ));


                    $cantidad_i = $insumo['cantidad'];

                    if (!empty($insumo['cantidad_anterior'])) {
                        $cantidad_ant = $insumo['cantidad_anterior'];
                    } else {
                        $cantidad_ant = 0;
                    }


                    if (empty($total_din['TotalesCtp']['id'])) {
                        $this->Session->setFlash("La cantidad de insumos no es suficiente!!", 'msgerror');
                        $sw_ins = false;
                    } else {
                        if (($total_din['TotalesCtp']['cantidad'] + $cantidad_ant) < $cantidad_i) {

                            $this->Session->setFlash("La cantidad de insumos no es suficiente!!", 'msgerror');
                            $sw_ins = false;
                        }
                    }
                }
            }

            if ($sw_ins) {

                $this->TrabajosCtp->create();
                $this->TrabajosCtp->save($this->request->data['TrabajosCtp']);

                if (!empty($this->request->data['TrabajosCtp']['id'])) {
                    $idTrabajo = $this->request->data['TrabajosCtp']['id'];
                } else {
                    $idTrabajo = $this->TrabajosCtp->getLastInsertID();
                }
                foreach ($this->request->data['Insumos'] as $insumo) {


                    $total_din = $this->TotalesCtp->find('first', array(
                        'recursive' => -1,
                        'conditions' => array('TotalesCtp.sucursale_id' => $idSucursal, 'TotalesCtp.insumos_ctp_id' => $insumo['insumos_ctp_id'])
                    ));
                    if (!empty($insumo['cantidad_anterior'])) {
                        $cantidad_ant = $insumo['cantidad_anterior'];
                    } else {
                        $cantidad_ant = 0;
                    }

                    $cantidad_i = $insumo['cantidad'];

                    if (!empty($total_din['TotalesCtp']['id'])) {
                        $this->TotalesCtp->id = $total_din['TotalesCtp']['id'];
                        $d_total['cantidad'] = ($total_din['TotalesCtp']['cantidad'] + $cantidad_ant) - $cantidad_i;
                        $this->TotalesCtp->save($d_total);
                    }

                    $d_venta = $insumo;
                    if (!empty($d_venta['cantidad_anterior']) && $d_venta['cantidad_anterior'] != $d_venta['cantidad']) {
                        $this->VentasCtp->id = $d_venta['id'];
                        $dat_aux_ven['deleted'] = date('Y-m-d');
                        $this->VentasCtp->save($dat_aux_ven);
                        unset($d_venta['id']);
                    }


                    $d_venta['trabajos_ctp_id'] = $idTrabajo;

                    $this->VentasCtp->create();
                    $this->VentasCtp->save($d_venta);

                }
                $this->Session->setFlash("Se ha registrado correctamente el trabajo!!", 'msgbueno');
                $this->redirect(['action' => 'trabajo', $idCliente, $idTrabajo]);
            }


        } else {
            $this->TrabajosCtp->id = $idTrabajo;
            $this->request->data = $this->TrabajosCtp->read();
        }
        $cliente = $this->ClientesCtp->find('first', array(
            'recursive' => -1,
            'conditions' => array('ClientesCtp.id' => $idCliente)
        ));
        $idSucursal = $this->Session->read('Auth.User.Sucursale.id');

        if (empty($idTrabajo)) {
            $insumos = $this->InsumosCtp->find('all', array(
                'recursive' => 0,
                'order' => array('InsumosCtp.id'),
                'joins' => array(
                    array(
                        'table' => 'totales_ctp',
                        'alias' => 'TotalesCTP',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'TotalesCTP.insumos_ctp_id = InsumosCtp.id', "TotalesCTP.sucursale_id = $idSucursal"
                        )
                    )
                ),
                'conditions' => array('InsumosCtp.deleted' => null),
                'fields' => array('InsumosCtp.*', 'TotalesCTP.cantidad')
            ));
        } else {
            $insumos = $this->VentasCtp->find('all', array(
                'recursive' => 0,
                'order' => array('InsumosCtp.id'),
                'joins' => array(
                    array(
                        'table' => 'totales_ctp',
                        'alias' => 'TotalesCTP',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'TotalesCTP.insumos_ctp_id = InsumosCtp.id', "TotalesCTP.sucursale_id = $idSucursal"
                        )
                    )
                ),
                'conditions' => array('VentasCtp.deleted' => null, 'VentasCtp.trabajos_ctp_id' => $idTrabajo),
                'fields' => array('InsumosCtp.*', 'TotalesCTP.cantidad', 'VentasCtp.*')
            ));
            $sql_can1 = "(SELECT SUM(pagos_ctp.monto) FROM pagos_ctp WHERE pagos_ctp.ventas_ctp_id = VentasCtp.id AND ISNULL(pagos_ctp.deleted) GROUP BY VentasCtp.id)";
            $pagos = $this->PagosCtp->find('all', array(
                'recursive' => 0,
                'joins' => array(
                    array(
                        'table' => 'insumos_ctp',
                        'alias' => 'InsumosCtp',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'InsumosCtp.id = VentasCtp.insumos_ctp_id'
                        )
                    )
                ),
                'conditions' => array('PagosCtp.trabajos_ctp_id' => $idTrabajo,'PagosCtp.deleted' => null),
                'fields' => array('PagosCtp.*','InsumosCtp.nombre','VentasCtp.precio_venta',"IFNULL($sql_can1,0) AS saldo_total")
            ));
            /*debug($pagos);
            exit;*/
        }


        $this->set(compact('cliente', 'insumos', 'pagos'));
    }

    public function eliminar($idCliente = null)
    {
        $this->TrabajosCtp->id = $idCliente;
        $data_in['deleted'] = date('Y-m-d H:i:s');
        $this->TrabajosCtp->save($data_in);
        $this->Session->setFlash("Se ha eliminado correctamente el trabajo!!", 'msgbueno');
        $this->redirect($this->referer());
    }

    public function trabajos($idCliente)
    {
        $cliente = $this->ClientesCtp->find('first', array(
            'recursive' => -1,
            'conditions' => array('ClientesCtp.id' => $idCliente)
        ));

        $sql1 = "(SELECT SUM(pagos_ctp.monto) FROM pagos_ctp WHERE pagos_ctp.trabajos_ctp_id = TrabajosCtp.id AND ISNULL(pagos_ctp.deleted) GROUP BY pagos_ctp.trabajos_ctp_id)";
        $trabajos = $this->TrabajosCtp->find('all', array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'ventas_ctp',
                    'alias' => 'VentasCtp',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'VentasCtp.trabajos_ctp_id = TrabajosCtp.id'
                    )
                )
            ),
            'order' => array('TrabajosCtp.modified DESC'),
            'conditions' => array('TrabajosCtp.deleted' => null, 'TrabajosCtp.clientes_ctp_id' => $idCliente, 'VentasCtp.deleted' => null),
            'group' => array('TrabajosCtp.id'),
            'fields' => array('TrabajosCtp.*', 'User.*', 'SUM(VentasCtp.precio_venta) as precio_v', "IFNULL($sql1,0) as monto_p")
        ));
        $this->set(compact('trabajos', 'cliente'));
    }

    public function registra_pago()
    {
        $idTrabajo = $this->request->data['PagosCtp']['trabajos_ctp_id'];
        $sql_can = "cast((IF(ISNULL(SUM(PagosCtp.monto)),0,SUM(PagosCtp.monto) )) as decimal(6,2)) ";
        $sql_pv = "cast((IF(ISNULL(VentasCtp.precio_venta),0,VentasCtp.precio_venta )) as decimal(6,2)) ";


        $ventas = $this->VentasCtp->find('all', array(
            'recursive' => -1,
            'joins' => array(
                array(
                    'table' => 'pagos_ctp',
                    'alias' => 'PagosCtp',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'PagosCtp.ventas_ctp_id = VentasCtp.id',
                        'ISNULL(PagosCtp.deleted)'
                    )
                )
            ),
            'conditions' => array(
                'VentasCtp.trabajos_ctp_id' => $idTrabajo,
                'VentasCtp.precio_venta !=' => null,
                //'((SELECT 150.00) = $sql_can)"
            ),
            'fields' => array("$sql_can as cancelado",'VentasCtp.*'),
          // 'group' => array("VentasCtp.id")
            'group' => array("VentasCtp.id HAVING ($sql_can < $sql_pv)")
//            'group' => array("VentasCtp.id HAVING '150.00' < '150.00'")
        ));

        /*debug($ventas);
        exit;*/

        $monto_t = $this->request->data['PagosCtp']['monto'];
        foreach ($ventas as $venta) {
            if($monto_t > 0){
                $deuda = $venta['VentasCtp']['precio_venta'] - $venta[0]['cancelado'];
                if ($monto_t <= $deuda) {
                    $this->request->data['PagosCtp']['monto'] = $monto_t;
                    $monto_t = 0;
                } else {
                    $this->request->data['PagosCtp']['monto'] = $deuda;
                    $monto_t = $monto_t - $deuda;
                }
                $this->request->data['PagosCtp']['ventas_ctp_id'] = $venta['VentasCtp']['id'];
                $this->PagosCtp->create();
                $this->PagosCtp->save($this->request->data['PagosCtp']);
            }
        }
        if($monto_t > 0){
            $this->Session->setFlash("Se ha registrado el pago pero se tiene sobra de monto de $monto_t !!", 'msginfo');
        }else{
            $this->Session->setFlash("Se ha registrado correctamente el pago!!", 'msgbueno');
        }
        $this->redirect($this->referer());
    }

    public function eliminar_pago($idPago = null){
        $this->PagosCtp->id = $idPago;
        $datos_pa['deleted'] = date('Y-m-d');
        $this->PagosCtp->save($datos_pa);
        $this->Session->setFlash("Se ha eliminado correctamente el pago!!",'msgbueno');
        $this->redirect($this->referer());
    }


    public function detalle($idCliente){

        $sql_can1 = "(SELECT SUM(pagos_ctp.monto) FROM pagos_ctp WHERE pagos_ctp.ventas_ctp_id = VentasCtp.id AND ISNULL(pagos_ctp.deleted) GROUP BY VentasCtp.id)";
        $ventas = $this->VentasCtp->find('all',array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'pagos_ctp',
                    'alias' => 'PagosCtp',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'PagosCtp.ventas_ctp_id = VentasCtp.id',
                        'ISNULL(PagosCtp.deleted)'
                    )
                )
            ),
            'conditions' => [
                'TrabajosCtp.clientes_ctp_id' => $idCliente,
                'VentasCtp.precio_venta !=' => null,
                'VentasCtp.cantidad !=' => null
            ],
            'order' => ['TrabajosCtp.id DESC','VentasCtp.id DESC'],
            'fields' => ['VentasCtp.*','PagosCtp.*',"$sql_can1 as cancelado",'TrabajosCtp.fecha','TrabajosCtp.numero','InsumosCtp.nombre']
        ));
        $cliente = $this->ClientesCtp->find('first', array(
            'recursive' => -1,
            'conditions' => array('ClientesCtp.id' => $idCliente)
        ));


        $sql_ventas = "(SELECT SUM(ventas_ctp.precio_venta) AS total_venta FROM ventas_ctp LEFT JOIN trabajos_ctp ON (ventas_ctp.trabajos_ctp_id = trabajos_ctp.id) WHERE trabajos_ctp.clientes_ctp_id = $idCliente GROUP BY trabajos_ctp.clientes_ctp_id )";
        $sql_pagos = "(SELECT SUM(pagos_ctp.monto) AS total_pagos FROM pagos_ctp LEFT JOIN trabajos_ctp ON (pagos_ctp.trabajos_ctp_id = trabajos_ctp.id) WHERE trabajos_ctp.clientes_ctp_id = $idCliente GROUP BY trabajos_ctp.clientes_ctp_id  )";
        $dato_venta = $this->VentasCtp->query("(SELECT (IFNULL($sql_ventas, 0)- IFNULL($sql_pagos, 0)) AS saldo_total)");

        $saldo_total = $dato_venta[0][0]['saldo_total'];
        $this->set(compact('ventas','cliente','saldo_total'));
        /*debug($ventas);
        exit;*/
    }

    public function reporte_saldos($idCliente){
        $sql_can1 = "(SELECT SUM(pagos_ctp.monto) FROM pagos_ctp WHERE pagos_ctp.ventas_ctp_id = VentasCtp.id AND ISNULL(pagos_ctp.deleted) GROUP BY VentasCtp.id)";
        $ventas = $this->VentasCtp->find('all',array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'pagos_ctp',
                    'alias' => 'PagosCtp',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'PagosCtp.ventas_ctp_id = VentasCtp.id',
                        'ISNULL(PagosCtp.deleted)'
                    )
                )
            ),
            'conditions' => [
                'TrabajosCtp.clientes_ctp_id' => $idCliente,
                'VentasCtp.precio_venta !=' => null,
                'VentasCtp.cantidad !=' => null,
                "($sql_can1 < VentasCtp.precio_venta)"
            ],
            'order' => ['TrabajosCtp.id DESC','VentasCtp.id DESC'],
            'fields' => ['VentasCtp.*','PagosCtp.*',"$sql_can1 as cancelado",'TrabajosCtp.fecha','TrabajosCtp.numero','InsumosCtp.nombre'],
        ));

        $sql_ventas = "(SELECT SUM(ventas_ctp.precio_venta) AS total_venta FROM ventas_ctp LEFT JOIN trabajos_ctp ON (ventas_ctp.trabajos_ctp_id = trabajos_ctp.id) WHERE trabajos_ctp.clientes_ctp_id = $idCliente GROUP BY trabajos_ctp.clientes_ctp_id )";
        $sql_pagos = "(SELECT SUM(pagos_ctp.monto) AS total_pagos FROM pagos_ctp LEFT JOIN trabajos_ctp ON (pagos_ctp.trabajos_ctp_id = trabajos_ctp.id) WHERE trabajos_ctp.clientes_ctp_id = $idCliente GROUP BY trabajos_ctp.clientes_ctp_id  )";
        $dato_venta = $this->VentasCtp->query("(SELECT (IFNULL($sql_ventas, 0)- IFNULL($sql_pagos, 0)) AS saldo_total)");


        $saldo_total = $dato_venta[0][0]['saldo_total'];
        $cliente = $this->ClientesCtp->find('first', array(
            'recursive' => -1,
            'conditions' => array('ClientesCtp.id' => $idCliente)
        ));
        $this->set(compact('ventas','cliente','saldo_total'));

        /*debug($ventas);
        exit;*/
    }

    public function registra_pago_ext()
    {
        //$idTrabajo = $this->request->data['PagosCtp']['trabajos_ctp_id'];
        $sql_can = "cast((IF(ISNULL(SUM(PagosCtp.monto)),0,SUM(PagosCtp.monto) )) as decimal(6,2)) ";
        $sql_pv = "cast((IF(ISNULL(VentasCtp.precio_venta),0,VentasCtp.precio_venta )) as decimal(6,2)) ";

        $ventas = $this->VentasCtp->find('all', array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'pagos_ctp',
                    'alias' => 'PagosCtp',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'PagosCtp.ventas_ctp_id = VentasCtp.id',
                        'ISNULL(PagosCtp.deleted)'
                    )
                )
            ),
            'conditions' => array(
                //'VentasCtp.trabajos_ctp_id' => $idTrabajo,
                'VentasCtp.precio_venta !=' => null,
                //'((SELECT 150.00) = $sql_can)"
            ),
            'order' => ['TrabajosCtp.id','VentasCtp.id'],
            'fields' => array("$sql_can as cancelado",'VentasCtp.*'),
            // 'group' => array("VentasCtp.id")
            'group' => array("VentasCtp.id HAVING ($sql_can < $sql_pv)")
//            'group' => array("VentasCtp.id HAVING '150.00' < '150.00'")
        ));

        /*debug($ventas);
        exit;*/

        $monto_t = $this->request->data['PagosCtp']['monto'];
        foreach ($ventas as $venta) {
            if($monto_t > 0){
                $deuda = $venta['VentasCtp']['precio_venta'] - $venta[0]['cancelado'];
                if ($monto_t <= $deuda) {
                    $this->request->data['PagosCtp']['monto'] = $monto_t;
                    $monto_t = 0;
                } else {
                    $this->request->data['PagosCtp']['monto'] = $deuda;
                    $monto_t = $monto_t - $deuda;
                }
                $this->request->data['PagosCtp']['ventas_ctp_id'] = $venta['VentasCtp']['id'];
                $this->request->data['PagosCtp']['trabajos_ctp_id'] = $venta['VentasCtp']['trabajos_ctp_id'];
                $this->PagosCtp->create();
                $this->PagosCtp->save($this->request->data['PagosCtp']);
            }
        }
        if($monto_t > 0){
            $this->Session->setFlash("Se ha registrado el pago pero se tiene sobra de monto de $monto_t !!", 'msginfo');
        }else{
            $this->Session->setFlash("Se ha registrado correctamente el pago!!", 'msgbueno');
        }
        $this->redirect($this->referer());
    }

}