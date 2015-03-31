<?php

App::import('Vendor', 'CodigoControlV7', array('file' => 'CodigoControlV7.php'));

class FacturasController extends AppController {

    public $uses = array('Factura', 'Parametrosfactura', 'Trabajo', 'Hojasproduccione');
    public $layout = 'general';
    public $components = array('Montoliteral');

    public function index() {
        $facturas = $this->Factura->find('all');
        $this->set(compact('facturas'));
    }

    public function parametrofactura($idParametro = null) {
        $this->layout = 'ajax';
        //debug($var)
        $this->Parametrosfactura->id = $idParametro;
        $this->request->data = $this->Parametrosfactura->read();

        if (empty($this->request->data['Parametrosfactura']['numero_ref'])) {
            $u_factura = $this->Factura->find('first', array('order' => 'Factura.id DESC'));
            if (!empty($u_factura)) {
                $this->request->data['Parametrosfactura']['numero_ref'] = $u_factura['Factura']['numero'] + 1;
            } else {
                $this->request->data['Parametrosfactura']['numero_ref'] = 1;
            }
        }
    }

    public function guardaparametro() {
        if (!empty($this->request->data)) {
            $this->Parametrosfactura->create();
            $this->Parametrosfactura->save($this->request->data['Parametrosfactura']);
            $this->Session->setFlash('Se registro correctamente!!!', 'msgbueno');
        }
        $this->redirect(array('action' => 'listaparametros'));
    }

    public function listaparametros() {
        $parametros = $this->Parametrosfactura->find('all');
        $this->set(compact('parametros'));
    }

    public function factura($idTrabajo = null) {
        $trabajo = $this->Trabajo->find('first', array('conditions' => array('Trabajo.id' => $idTrabajo)));
        $hojasproduccion = $this->Hojasproduccione->find('all', array(
            'recursive' => -1,
            'conditions' => array('Hojasproduccione.trabajo_id' => $idTrabajo),
            'fields' => array('ROUND(SUM(Hojasproduccione.costo),2) as costo_total')
        ));
        $hojasproducciones = $this->Hojasproduccione->find('all',array(
            'recursive' => -1
            ,'conditions' => array('Hojasproduccione.trabajo_id' => $idTrabajo)
            ,'fields' => array('Hojasproduccione.cantidad','Hojasproduccione.descripcion','Hojasproduccione.costo')
            ));
        //debug($trabajo);exit;
        if (!empty($trabajo['Cliente']) && !empty($trabajo['Trabajo']) && !empty($hojasproduccion)) {
            $nitcliente = $trabajo['Cliente']['nit'];
            $totalt = $hojasproduccion[0][0]['costo_total'];
            $cliente = $trabajo['Cliente']['nombre'];
            $total = number_format($totalt, 2, '.', '');
            //$monto = split('\.', $total);
            //$literaltotal = $this->Montoliteral->getMontoLiteral($monto[0]);
            //debug($hojasproduccion);exit;
            $conceptos = array();
            $i = 0;
            foreach ($hojasproducciones as $hp){
                $conceptos[$i]['cantidad'] = $hp['Hojasproduccione']['cantidad'];
                $conceptos[$i]['descripcion'] = $hp['Hojasproduccione']['descripcion'];
                $conceptos[$i]['costo'] = $hp['Hojasproduccione']['costo'];
                $i++;
            }
            //debug($conceptos);exit;
            $nuevocodigo = new CodigoControlV7();
            $datoscodigo = $nuevocodigo->datosgenera($nitcliente, $total, "Imprenta General", $cliente,$conceptos);
            if (!empty($datoscodigo)) {
                $this->Trabajo->id = $idTrabajo;
                $this->request->data['Trabajo']['estado'] = 'Facturado';
                $this->request->data['Trabajo']['factura_id'] = $datoscodigo['factura_id'];
                $this->Trabajo->save($this->request->data['Trabajo']);
                $this->redirect(array('action' => 'vista_factura', $datoscodigo['factura_id']));
            } else {
                $this->Session->setFlash('No se pudo generar la factura!!', 'msgerror');
                $this->redirect($this->referer());
            }
            //debug($datoscodigo);exit;
            //$this->set(compact('literaltotal','datoscodigo','cliente','nitcliente','trabajo'));
        } else {
            $this->Session->setFlash('El trabajo no existe!!', 'msgerror');
            $this->redirect($this->referer());
        }
    }

    public function vista_factura($idFactura = NULL,$idTrabajo = null) {
        $factura = $this->Factura->findByid($idFactura);
        $literaltotal = '';
        if(!empty($factura)){
            $literaltotal = $this->Montoliteral->getMontoLiteral($factura['Factura']['importetotal']);
        }
        $literaltotal = $literaltotal." Bolivianos";
        $this->set(compact('factura','literaltotal'));
    }

    public function elimina_parametro($idParametro = null) {
        $this->Parametrosfactura->delete($idParametro);
        $this->Session->setFlash("Se elimino correctamente!!", 'msgbueno');
        $this->redirect(array('action' => 'listaparametros'));
    }
    
    public function anula_factura($idFactura = null){
        $this->Factura->id = $idFactura;
        $this->request->data['Factura']['estado'] = 'Anulado';
        if($this->Factura->save($this->request->data['Factura'])){
            $this->Session->setFlash('Se anulo correctamente!!','msgbueno');
        }else{
            $this->Session->setFlash('No se pudo anular la factura intente nuevamente!!','msgerror');
        }
        $this->redirect(array('action' => 'index'));
    }

}
