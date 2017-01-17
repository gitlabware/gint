<?php

App::uses('AppController', 'Controller');

class InsumosCtpController extends AppController
{

    public $uses = array('InsumosCtp', 'TotalesCtp', 'MovimientosCtp', 'RegistrosCtp');
    public $layout = 'general';

    public function index()
    {
        $idSucursal = $this->Session->read('Auth.User.Sucursale.id');

        $insumos = $this->InsumosCtp->find('all', array(
            'recursive' => 0,
            //'order' => array('InsumosCtp.id DESC'),
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
        /*debug($insumos);
        exit;*/


        $this->set(compact('insumos'));
    }

    public function insumo($idInsumo = null)
    {
        $this->layout = 'ajax';
        if (!empty($this->request->data)) {
            $this->InsumosCtp->create();
            $this->InsumosCtp->save($this->request->data['InsumosCtp']);
            $this->Session->setFlash("Se registrado correctamente el insumo!!", 'msgbueno');
            $this->redirect($this->referer());
        }
        $this->InsumosCtp->id = $idInsumo;
        $this->request->data = $this->InsumosCtp->read();
    }

    public function eliminar($idInsumo = null)
    {
        $this->InsumosCtp->id = $idInsumo;
        $data_in['deleted'] = date('Y-m-d H:i:s');
        $this->InsumosCtp->save($data_in);
        $this->Session->setFlash("Se ha eliminado correctamente el insumo!!", 'msgbueno');
        $this->redirect($this->referer());
    }

    public function ingresar($idInsumo)
    {
        $this->layout = 'ajax';
        $idSucursal = $this->Session->read('Auth.User.Sucursale.id');
        $idUsuario = $this->Session->read('Auth.User.id');
        $insumo = $this->InsumosCtp->find('first', array(
            'recursive' => -1,
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
            'conditions' => array('InsumosCtp.id' => $idInsumo),
            'fields' => array('InsumosCtp.*', 'TotalesCTP.cantidad')
        ));

        if (!empty($this->request->data['MovimientosCtp'])) {
            $total_din = $this->TotalesCtp->find('first', array(
                'recursive' => -1,
                'conditions' => array('TotalesCtp.sucursale_id' => $idSucursal, 'TotalesCtp.insumos_ctp_id' => $idInsumo)
            ));

            if ($this->request->data['MovimientosCtp']['unidad'] == 'Caja') {
                $cantidad_i = $this->request->data['MovimientosCtp']['cantidad'] * $insumo['InsumosCtp']['unid_x_caja'];
            } else {
                $cantidad_i = $this->request->data['MovimientosCtp']['cantidad'];
            }

            if (empty($total_din['TotalesCtp']['id'])) {
                $dato_tot['sucursale_id'] = $idSucursal;
                $dato_tot['insumos_ctp_id'] = $idInsumo;
                $dato_tot['cantidad'] = $cantidad_i;
            } else {
                $dato_tot['id'] = $total_din['TotalesCtp']['id'];
                $dato_tot['cantidad'] = $total_din['TotalesCtp']['cantidad'] + $cantidad_i;
            }
            $this->TotalesCtp->create();
            $this->TotalesCtp->save($dato_tot);

            $this->request->data['MovimientosCtp']['sucursale_id'] = $idSucursal;
            $this->request->data['MovimientosCtp']['insumos_ctp_id'] = $idInsumo;
            $this->request->data['MovimientosCtp']['user_id'] = $idUsuario;
            $this->request->data['MovimientosCtp']['tipo'] = "Ingreso";

            $this->MovimientosCtp->create();
            $this->MovimientosCtp->save($this->request->data['MovimientosCtp']);

            $this->Session->setFlash("Se ha registrado correctamente el ingreso!!", 'msgbueno');
            $this->redirect($this->referer());
        }
        $this->set(compact('insumo'));
    }


    public function sacar($idInsumo)
    {
        $this->layout = 'ajax';
        $idSucursal = $this->Session->read('Auth.User.Sucursale.id');
        $idUsuario = $this->Session->read('Auth.User.id');
        $insumo = $this->InsumosCtp->find('first', array(
            'recursive' => -1,
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
            'conditions' => array('InsumosCtp.id' => $idInsumo),
            'fields' => array('InsumosCtp.*', 'TotalesCTP.cantidad')
        ));

        if (!empty($this->request->data['MovimientosCtp'])) {
            $total_din = $this->TotalesCtp->find('first', array(
                'recursive' => -1,
                'conditions' => array('TotalesCtp.sucursale_id' => $idSucursal, 'TotalesCtp.insumos_ctp_id' => $idInsumo)
            ));

            if ($this->request->data['MovimientosCtp']['unidad'] == 'Caja') {
                $cantidad_i = $this->request->data['MovimientosCtp']['cantidad'] * $insumo['InsumosCtp']['unid_x_caja'];
            } else {
                $cantidad_i = $this->request->data['MovimientosCtp']['cantidad'];
            }

            if (empty($total_din['TotalesCtp']['id'])) {
                $this->Session->setFlash("La cantidad de insumos no es suficiente!!", 'msgerror');
                $this->redirect($this->referer());
            } else {
                if ($total_din['TotalesCtp']['cantidad'] >= $cantidad_i) {
                    $dato_tot['id'] = $total_din['TotalesCtp']['id'];
                    $dato_tot['cantidad'] = $total_din['TotalesCtp']['cantidad'] - $cantidad_i;
                } else {
                    $this->Session->setFlash("La cantidad de insumos no es suficiente!!", 'msgerror');
                    $this->redirect($this->referer());
                }
            }
            $this->TotalesCtp->create();
            $this->TotalesCtp->save($dato_tot);

            $this->request->data['MovimientosCtp']['sucursale_id'] = $idSucursal;
            $this->request->data['MovimientosCtp']['insumos_ctp_id'] = $idInsumo;
            $this->request->data['MovimientosCtp']['user_id'] = $idUsuario;
            $this->request->data['MovimientosCtp']['tipo'] = "Salida";

            $this->MovimientosCtp->create();
            $this->MovimientosCtp->save($this->request->data['MovimientosCtp']);

            $this->Session->setFlash("Se ha registrado correctamente la salida!!", 'msgbueno');
            $this->redirect($this->referer());
        }
        $this->set(compact('insumo'));
    }

    public function movimientos($idInsumo)
    {
        $idSucursal = $this->Session->read('Auth.User.Sucursale.id');
        $insumo = $this->InsumosCtp->find('first', array(
            'recursive' => -1,
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
            'conditions' => array('InsumosCtp.id' => $idInsumo),
            'fields' => array('InsumosCtp.*', 'TotalesCTP.cantidad')
        ));
        $movimientos = $this->MovimientosCtp->find('all', array(
            'recursive' => 0,
            'conditions' => array('MovimientosCtp.sucursale_id' => $idSucursal, 'MovimientosCtp.insumos_ctp_id' => $idInsumo, 'MovimientosCtp.deleted' => null),
            'order' => array('MovimientosCtp.id DESC')
        ));
        $this->set(compact('movimientos', 'insumo'));
    }

    public function eliminar_movimiento_ctp($idMovimiento)
    {
        $idSucursal = $this->Session->read('Auth.User.Sucursale.id');
        $movimiento = $this->MovimientosCtp->find('first', array(
            'recursive' => 0,
            'conditions' => array('MovimientosCtp.id' => $idMovimiento)
        ));
        $total_din = $this->TotalesCtp->find('first', array(
            'recursive' => -1,
            'conditions' => array('TotalesCtp.sucursale_id' => $idSucursal, 'TotalesCtp.insumos_ctp_id' => $movimiento['MovimientosCtp']['insumos_ctp_id'])
        ));
        if ($movimiento['MovimientosCtp']['unidad'] == 'Caja') {
            $cantidad_i = $movimiento['MovimientosCtp']['cantidad'] * $movimiento['InsumosCtp']['unid_x_caja'];
        } else {
            $cantidad_i = $movimiento['MovimientosCtp']['cantidad'];
        }

        if ($movimiento['MovimientosCtp']['tipo'] == 'Ingreso') {
            if ($total_din['TotalesCtp']['cantidad'] >= $cantidad_i) {
                $this->TotalesCtp->id = $total_din['TotalesCtp']['id'];
                $dato_to['cantidad'] = $total_din['TotalesCtp']['cantidad'] - $cantidad_i;
                $this->TotalesCtp->save($dato_to);
            } else {
                $this->Session->setFlash("No se ha podido eliminar el movimiento!!", 'msgerror');
                $this->redirect($this->referer());
            }
        } elseif ($movimiento['MovimientosCtp']['tipo'] == 'Salida') {
            $this->TotalesCtp->id = $total_din['TotalesCtp']['id'];
            $dato_to['cantidad'] = $total_din['TotalesCtp']['cantidad'] + $cantidad_i;
            $this->TotalesCtp->save($dato_to);
        }
        $this->MovimientosCtp->id = $idMovimiento;
        $dato_mov['deleted'] = date('Y-m-d H:i:s');
        $this->MovimientosCtp->save($dato_mov);
        $this->Session->setFlash("Se ha eliminado correctamente el movimiento!!", 'msgbueno');
        $this->redirect($this->referer());
//        if($total_din['TotalesCtp'])
    }


    public function guarda_registro_material()
    {
        /*debug($this->request->data);
        exit;*/

        $this->RegistrosCtp->create();
        $this->RegistrosCtp->save($this->request->data['RegistrosCtp']);
        $idSucursal = $this->request->data['RegistrosCtp']['sucursale_id'];
        $idUsuario = $this->request->data['RegistrosCtp']['user_id'];
        $idRegistro = $this->RegistrosCtp->getLastInsertID();

        foreach ($this->request->data['Insumos'] as $insumo) {
            if (!empty($insumo['cantidad'])) {
                $total_din = $this->TotalesCtp->find('first', array(
                    'recursive' => -1,
                    'conditions' => array('TotalesCtp.sucursale_id' => $idSucursal, 'TotalesCtp.insumos_ctp_id' => $insumo['insumos_ctp_id'])
                ));

                $cantidad_i = $insumo['cantidad'] * $insumo['unid_x_caja'];
                $dato_tot = [];
                if (empty($total_din['TotalesCtp']['id'])) {
                    $dato_tot['sucursale_id'] = $idSucursal;
                    $dato_tot['insumos_ctp_id'] = $insumo['insumos_ctp_id'];
                    $dato_tot['cantidad'] = $cantidad_i;
                } else {
                    $dato_tot['id'] = $total_din['TotalesCtp']['id'];
                    $dato_tot['cantidad'] = $total_din['TotalesCtp']['cantidad'] + $cantidad_i;
                }
                $this->TotalesCtp->create();
                $this->TotalesCtp->save($dato_tot);

                $dato_mov['sucursale_id'] = $idSucursal;
                $dato_mov['insumos_ctp_id'] = $insumo['insumos_ctp_id'];
                $dato_mov['user_id'] = $idUsuario;
                $dato_mov['unidad'] = "Caja";
                $dato_mov['cantidad'] = $insumo['cantidad'];
                $dato_mov['registros_ctp_id'] = $idRegistro;
                $dato_mov['tipo'] = "Ingreso";
                $dato_mov['fecha'] = $this->request->data['RegistrosCtp']['fecha'];
                $this->MovimientosCtp->create();
                $this->MovimientosCtp->save($dato_mov);
            }

        }
        $this->Session->setFlash("Se ha registrado correctamente la Orden de material!!!", 'msgbueno');
        $this->redirect($this->referer());
    }

    public function autorizar($idInsumo){
        $this->InsumosCtp->id = $idInsumo;
        $d_insumo['autorizacion'] = 1;
        $this->InsumosCtp->save($d_insumo);
        $this->Session->setFlash("Se ha registrado la autorizacion del insumo!!",'msgbueno');
        $this->redirect($this->referer());
    }
    public function desautorizar($idInsumo){
        $this->InsumosCtp->id = $idInsumo;
        $d_insumo['autorizacion'] = 0;
        $this->InsumosCtp->save($d_insumo);
        $this->Session->setFlash("Se ha registrado la autorizacion del insumo!!",'msgbueno');
        $this->redirect($this->referer());
    }
}