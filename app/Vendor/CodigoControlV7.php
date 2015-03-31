<?php

require_once('AllegedRC4.php');
require_once('Verhoeff.php');

App::uses('Parametrosfactura', 'Model');
App::uses('Factura', 'Model');

class CodigoControlV7 {

    public function datosgenera($nitci, $monto, $nombre_empresa = "", $nombre_comprador = "", $conceptos = array()) {
        //$monto (debe de decimales)
        $fecha = date('Y-m-d');
        //$fecha = "2008-02-01";
        $modelo = new Parametrosfactura();
        $mfactura = new Factura();
        $pfactura = $modelo->find('first', array('order' => 'Parametrosfactura.id DESC'));
        $numero = 1;
        if (!empty($pfactura['Parametrosfactura']['numero_ref'])) {
            $numero = $pfactura['Parametrosfactura']['numero_ref'];
        }

        $rcodigo = array();
        if (!empty($pfactura)) {
            if (!empty($pfactura['Parametrosfactura']['fechalimite'])) {
                if ($pfactura['Parametrosfactura']['fechalimite'] >= $fecha && !empty($pfactura['Parametrosfactura']['numero_autorizacion']) && !empty($pfactura['Parametrosfactura']['llave']) && !empty($pfactura['Parametrosfactura']['nit'])) {
                    /* $this->autorizacion = $pfactura['Parametrosfactura']['numero_autorizacion'];
                      $this->factura = $numero + 1 ;
                      $this->nitci = $nitci;
                      $this->fecha = ereg_replace("[-]", "", $fecha);
                      $this->monto = round($monto);
                      $this->llave = $pfactura['Parametrosfactura']['llave']; */
                    $codigo_control = $this->generar($pfactura['Parametrosfactura']['numero_autorizacion'], $numero, $nitci, ereg_replace("[-]", "", $fecha), round($monto), $pfactura['Parametrosfactura']['llave']);
                    if (!empty($codigo_control)) {
                        $mfactura->create();
                        $this->request->data['Factura']['cliente'] = $nombre_comprador;
                        $this->request->data['Factura']['nit'] = $nitci;
                        $this->request->data['Factura']['importetotal'] = $monto;
                        $this->request->data['Factura']['fecha'] = $fecha;
                        $this->request->data['Factura']['codigo_control'] = $codigo_control;
                        $this->request->data['Factura']['numero'] = $numero;
                        $this->request->data['Factura']['autorizacion'] = $pfactura['Parametrosfactura']['numero_autorizacion'];
                        $this->request->data['Factura']['parametrosfactura_id'] = $pfactura['Parametrosfactura']['id'];
                        $this->request->data['Factura']['conceptos'] = serialize($conceptos);
                        $this->request->data['Factura']['estado'] = 'Valido';

                        $fechalimite = split("-", $pfactura['Parametrosfactura']['fechalimite']);
                        $nfechalimite = $fechalimite[2] . "/" . $fechalimite[1] . "/" . $fechalimite[0];
                        $cod_qr = $pfactura['Parametrosfactura']['nit'] . "|" . $nombre_empresa . "|"
                                . $this->request->data['Factura']['numero'] . "|" . $pfactura['Parametrosfactura']['numero_autorizacion'] . "|" . date('d/m/Y') . "|" .
                                $monto . "|" . $codigo_control . "|" . $nfechalimite . "|" . $nitci . "|" . $nombre_comprador;
                        $this->request->data['Factura']['qr'] = $cod_qr;
                        if ($mfactura->save($this->request->data['Factura'])) {
                            $modelo->create();
                            $this->request->data['Parametrosfactura']['id'] = $pfactura['Parametrosfactura']['id'];
                            $this->request->data['Parametrosfactura']['numero_ref'] = $numero + 1;
                            $modelo->save($this->request->data['Parametrosfactura']);
                            $rcodigo['factura_id'] = $mfactura->getLastInsertID();
                            $rcodigo['codigo'] = $codigo_control;
                            $rcodigo['numero_autorizacion'] = $pfactura['Parametrosfactura']['numero_autorizacion'];
                            $rcodigo['nit'] = $pfactura['Parametrosfactura']['nit'];
                            $rcodigo['fechalimite'] = $pfactura['Parametrosfactura']['fechalimite'];
                            $rcodigo['numero'] = $this->request->data['Factura']['numero'];

                            $rcodigo['qr'] = $cod_qr;
                        }
                    }
                }
            }
        }
        return $rcodigo;
    }

    public static function generar($numautorizacion, $numfactura, $nitcliente, $fecha, $monto, $clave) {
        $numfactura = self::appendVerhoeff($numfactura, 2);
        $nitcliente = self::appendVerhoeff($nitcliente, 2);
        $fecha = self::appendVerhoeff($fecha, 2);
        $monto = self::appendVerhoeff($monto, 2);
        $suma = $numfactura + $nitcliente + $fecha + $monto;
        $suma = self::appendVerhoeff($suma, 5);
        $dv = substr($suma, -5);
        $cads = array($numautorizacion, $numfactura, $nitcliente, $fecha, $monto);
        $msg = '';
        $p = 0;
        for ($i = 0; $i < 5; $i++) {
            $msg .= $cads[$i] . substr($clave, $p, 1 + $dv[$i]);
            $p += 1 + $dv[$i];
        }
        $codif = AllegedRC4::encode($msg, $clave . $dv);
        $st = 0;
        $sp = array(0, 0, 0, 0, 0);
        $codif_length = strlen($codif);
        for ($i = 0; $i < $codif_length; $i++) {
            $st += ord($codif[$i]);
            $sp[$i % 5] += ord($codif[$i]);
        }
        $stt = 0;
        for ($i = 0; $i < 5; $i++)
            $stt += (int) (($st * $sp[$i]) / (1 + $dv[$i]));

        return implode('-', str_split(AllegedRC4::encode(self::base64($stt), $clave . $dv), 2));
    }

    public static function base64($n) {
        $d = array(
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
            'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd',
            'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
            'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
            'y', 'z', '+', '/');
        $c = 1;
        $r = '';
        while ($c > 0) {
            $c = (int) ($n / 64);
            $r = $d[$n % 64] . $r;
            $n = $c;
        }
        return $r;
    }

    public static function appendVerhoeff($n, $c) {
        for (; $c > 0; $c--)
            $n .= Verhoeff::get($n);
        return $n;
    }

}
