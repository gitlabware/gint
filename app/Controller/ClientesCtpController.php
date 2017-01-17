<?php

App::uses('AppController', 'Controller');

class ClientesCtpController extends AppController
{

    public $uses = array('ClientesCtp');
    public $layout = 'general';

    public function index()
    {

        $sql_1 = "IFNULL(SUM(VentasCtp.precio_venta),0)";
        $sql_2 = "(SELECT SUM(pagos_ctp.monto) FROM pagos_ctp LEFT JOIN trabajos_ctp ON (trabajos_ctp.id = pagos_ctp.trabajos_ctp_id) WHERE trabajos_ctp.clientes_ctp_id = ClientesCtp.id AND ISNULL(pagos_ctp.deleted) GROUP BY trabajos_ctp.clientes_ctp_id)";
        $clientes = $this->ClientesCtp->find('all', array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'trabajos_ctp',
                    'alias' => 'TrabajosCtp',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'TrabajosCtp.clientes_ctp_id = ClientesCtp.id'
                    )
                ),
                array(
                    'table' => 'ventas_ctp',
                    'alias' => 'VentasCtp',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'VentasCtp.trabajos_ctp_id = TrabajosCtp.id'
                    )
                )
            ),
            'order' => array('ClientesCtp.modified DESC'),
            'conditions' => array('ClientesCtp.deleted' => null),
            'group' => ['ClientesCtp.id'],
            'fields' => array('ClientesCtp.*',"$sql_1 AS total_ventas","IFNULL($sql_2,0) AS total_pagado")
        ));
        /*debug($clientes);
        exit;*/

        $this->set(compact('clientes'));
    }

    public function cliente($idCliente = null)
    {
        $this->layout = 'ajax';
        if (!empty($this->request->data)) {
            $this->ClientesCtp->create();
            $this->ClientesCtp->save($this->request->data['ClientesCtp']);
            $this->Session->setFlash("Se ha registrado correctamente el cliente!!", 'msgbueno');
            $this->redirect($this->referer());
        }
        $this->ClientesCtp->id = $idCliente;
        $this->request->data = $this->ClientesCtp->read();
    }

    public function eliminar($idCliente = null)
    {
        $this->ClientesCtp->id = $idCliente;
        $data_in['deleted'] = date('Y-m-d H:i:s');
        $this->ClientesCtp->save($data_in);
        $this->Session->setFlash("Se ha eliminado correctamente el cliente!!", 'msgbueno');
        $this->redirect($this->referer());
    }


}