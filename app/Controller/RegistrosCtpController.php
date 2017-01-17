<?php
App::uses('AppController', 'Controller');

class RegistrosCtpController extends AppController
{

    public $uses = array( 'RegistrosCtp','TotalesCtp','MovimientosCtp');
    public $layout = 'general';

    public function index()
    {
        $idSucursal = $this->Session->read('Auth.User.Sucursale.id');

        $this->RegistrosCtp->virtualFields = [
            'insumos' => "(SELECT GROUP_CONCAT(movimientos_ctp.cantidad ,' - ',insumos_ctp.nombre SEPARATOR '<br> ') FROM movimientos_ctp LEFT JOIN insumos_ctp ON (insumos_ctp.id = movimientos_ctp.insumos_ctp_id) WHERE movimientos_ctp.registros_ctp_id = RegistrosCtp.id GROUP BY movimientos_ctp.registros_ctp_id)"
        ];
        $registros = $this->RegistrosCtp->find('all', array(
            'recursive' => -1,
            'order' => array('RegistrosCtp.id DESC'),
            'conditions' => array('RegistrosCtp.deleted' => null),
            'fields' => array('RegistrosCtp.*')
        ));
        /*debug($registros);
        exit;*/
        $this->set(compact('registros'));
    }

    public function eliminar($idRegistro){
        $idSucursal = $this->Session->read('Auth.User.Sucursale.id');
        $movimientos = $this->MovimientosCtp->find('all',array(
            'recursive' => 0,
            'conditions' => array('MovimientosCtp.registros_ctp_id' => $idRegistro)
        ));
        foreach ($movimientos as $movimiento){

            $total_din = $this->TotalesCtp->find('first', array(
                'recursive' => 0,
                'conditions' => array('TotalesCtp.sucursale_id' => $idSucursal, 'TotalesCtp.insumos_ctp_id' => $movimiento['MovimientosCtp']['insumos_ctp_id'])
            ));
            if ($movimiento['MovimientosCtp']['unidad'] == 'Caja') {
                $cantidad_i = $movimiento['MovimientosCtp']['cantidad'] * $movimiento['InsumosCtp']['unid_x_caja'];
            } else {
                $cantidad_i = $movimiento['MovimientosCtp']['cantidad'];
            }

            if ($total_din['TotalesCtp']['cantidad'] < $cantidad_i) {
                $this->Session->setFlash("No se ha podido eliminar el Registro porque no hay suficiente de ".$movimiento['InsumosCtp']['nombre']."!!", 'msgerror');
                $this->redirect($this->referer());
            }
        }

        foreach ($movimientos as $movimiento){

            $total_din = $this->TotalesCtp->find('first', array(
                'recursive' => 0,
                'conditions' => array('TotalesCtp.sucursale_id' => $idSucursal, 'TotalesCtp.insumos_ctp_id' => $movimiento['MovimientosCtp']['insumos_ctp_id'])
            ));
            if ($movimiento['MovimientosCtp']['unidad'] == 'Caja') {
                $cantidad_i = $movimiento['MovimientosCtp']['cantidad'] * $movimiento['InsumosCtp']['unid_x_caja'];
            } else {
                $cantidad_i = $movimiento['MovimientosCtp']['cantidad'];
            }

            $this->TotalesCtp->id = $total_din['TotalesCtp']['id'];
            $dato_to['cantidad'] = $total_din['TotalesCtp']['cantidad'] - $cantidad_i;
            $this->TotalesCtp->save($dato_to);

            $this->MovimientosCtp->id = $movimiento['MovimientosCtp']['id'];
            $dato_mov['deleted'] = date('Y-m-d H:i:s');
            $this->MovimientosCtp->save($dato_mov);
        }

        $this->RegistrosCtp->id = $idRegistro;
        $dato_reg['deleted'] = date('Y-m-d H:i:s');
        $this->RegistrosCtp->save($dato_reg);

        $this->Session->setFlash("Se ha eliminado correctamente el registro!!", 'msgbueno');
        $this->redirect($this->referer());
    }
}