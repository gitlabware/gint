<?php

App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel.php'));
App::import('Vendor', 'PHPExcel_Reader_Excel2007', array('file' => 'PHPExcel/Excel2007.php'));
App::import('Vendor', 'PHPExcel_IOFactory', array('file' => 'PHPExcel/PHPExcel/IOFactory.php'));
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

        $usuarios = $this->User->find('list', array(
            'fields' => array('User.id', 'User.nombre')
        ));
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

        $tiposucursal = $this->data['Hojasproduccione']['tiposucursal'];
        $condiciones = array();
        if (!empty($sucursal_id) && $sucursal_id != 'Todos') {
            $condiciones["$tiposucursal.sucursale_id"] = $sucursal_id;
        }
        if (!empty($tipotrabajo_id) && $tipotrabajo_id != 'Todos') {
            $condiciones['Hojasproduccione.tipotrabajo_id'] = $tipotrabajo_id;
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $condiciones["$tipofecha BETWEEN ? AND ? "] = array($fecha1, $fecha2);
        }
        $campo_sucursal = 'Sucursale.nombre';
        if ($tiposucursal != 'Hojasproduccione') {
            $campo_sucursal = 'Sucursaltt.nombre';
        }

        $sql1 = "(case when (tipo = 'Nota de entrega') THEN (CONCAT('NE ',numero)) ELSE (CONCAT('NR ',numero)) END) as orden";
        $sql2 = "SELECT $sql1 FROM `notas` WHERE (notas.trabajo_id = Hojasproduccione.trabajo_id AND notas.estado != 'Eliminado') ORDER BY id DESC LIMIT 1";
        $sql3 = "SELECT nombre FROM `clientes` WHERE (clientes.id = Trabajo.cliente_id)";
        $sql4 = "SELECT descripcion FROM `tipotrabajos` WHERE (tipotrabajos.id = Hojastipostrabajo.tipotrabajo_id)";
        $this->Hojasproduccione->virtualFields = array(
            'orden' => "CONCAT(($sql2))",
            'cliente' => "CONCAT(($sql3))",
            'formato' => "CONCAT(Hojasproduccione.metrajeini,'x',Hojasproduccione.metrajefin)",
            'tipo_trabajo' => "CONCAT(($sql4))",
            'la_sucursal' => "($campo_sucursal)"
        );
        $resultados = $this->Hojasproduccione->find('all', array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'sucursales',
                    'alias' => 'Sucursaltt',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Sucursaltt.id = Hojastipostrabajo.sucursale_id'
                    )
                )
            ),
            'conditions' => $condiciones
            , 'fields' => array('DATE(Hojasproduccione.created) as fecha_produccion', 'Hojasproduccione.trabajo_id',
                'Hojasproduccione.numero_hruta', 'Hojasproduccione.orden', 'Hojasproduccione.cliente', 'Hojasproduccione.cantidad'
                , 'Hojasproduccione.descripcion', 'Hojasproduccione.formato', 'Hojasproduccione.caras', 'Hojasproduccione.costo', 'Hojasproduccione.tipo_trabajo', 'Hojasproduccione.la_sucursal')
                )
        );
        //genera el excel encaso de q se requiera
        if ($this->request->data['Reporte']['tipo'] == 'excel') {
            $borders3 = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    //,'color' => array('argb' => 'FFFF0000')
                    )
                ),
                'font' => array(
                    'size' => 8
                    , 'bold' => true
                //,'color' => array('argb' => 'FFFF0000')
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'b4edb4')
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                )
            );
            $borders2 = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ),
                'font' => array(
                    'size' => 10
                )
            );
            $nombre_excel = "Reporte de tipo trabajo.xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $nombre_excel . '"');
            header('Cache-Control: max-age=0');

            $prueba = new PHPExcel();
            $prueba->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $prueba->getActiveSheet()->getColumnDimension('B')->setWidth(8);
            $prueba->getActiveSheet()->getColumnDimension('C')->setWidth(8);
            $prueba->getActiveSheet()->getColumnDimension('D')->setWidth(8);
            $prueba->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $prueba->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $prueba->getActiveSheet()->getColumnDimension('G')->setWidth(7);
            $prueba->getActiveSheet()->getColumnDimension('H')->setWidth(38);
            $prueba->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $prueba->getActiveSheet()->getColumnDimension('J')->setWidth(9);
            $prueba->getActiveSheet()->getColumnDimension('K')->setWidth(7);
            $prueba->getActiveSheet()->getColumnDimension('L')->setWidth(7);

            $prueba->getActiveSheet()->mergeCellsByColumnAndRow(0, 1, 11, 1);
            if (!empty($tipotrabajo)) {
                $tipotrabajo_aux = $tipotrabajo['Tipotrabajo']['descripcion'];
            } else {
                $tipotrabajo_aux = 'Todos';
            }

            if (!empty($sucursal)) {
                $sucursal_aux = $sucursal['Sucursale']['nombre'];
            } else {
                $sucursal_aux = 'Todos';
            }
            $titulo = "REPORTE ENTRE FECHAS : $fecha1 A $fecha2 --- TRABAJO: $tipotrabajo_aux --- SUCURSAL: $sucursal_aux";


            $style1 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER), 'font' => array('size' => 13, 'bold' => true));
            $prueba->getActiveSheet()->getStyle("A1:L1")->applyFromArray($style1);
            $prueba->setActiveSheetIndex(0)->setCellValue("A1", "$titulo");

            $prueba->getActiveSheet()->getStyle('A2:L2' . $prueba->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
            $prueba->getActiveSheet()->getStyle('A2:L2')->applyFromArray($borders3);
            $prueba->getActiveSheet()->getRowDimension(1)->setRowHeight(28);
            $prueba->getActiveSheet()->getRowDimension(2)->setRowHeight(31);

            $prueba->setActiveSheetIndex(0)->setCellValue("A2", "Fecha");
            $prueba->setActiveSheetIndex(0)->setCellValue("B2", "Id Trab.");
            $prueba->setActiveSheetIndex(0)->setCellValue("C2", "H. Ruta.");
            $prueba->setActiveSheetIndex(0)->setCellValue("D2", "Orden");
            $prueba->setActiveSheetIndex(0)->setCellValue("E2", "Sucursal");
            $prueba->setActiveSheetIndex(0)->setCellValue("F2", "Cliente");
            $prueba->setActiveSheetIndex(0)->setCellValue("G2", "Cantidad");
            $prueba->setActiveSheetIndex(0)->setCellValue("H2", "Descripcion");
            $prueba->setActiveSheetIndex(0)->setCellValue("I2", "Tipo Trabajo");
            $prueba->setActiveSheetIndex(0)->setCellValue("J2", "Formato");
            $prueba->setActiveSheetIndex(0)->setCellValue("K2", "Cara");
            $prueba->setActiveSheetIndex(0)->setCellValue("L2", "Costo");

            $prueba->getActiveSheet()->setTitle("Reporte de tipo trabajo");

            $cont = 2;
            foreach ($resultados as $re) {
                $cont++;
                $prueba->getActiveSheet()->getStyle("A$cont:L$cont")->applyFromArray($borders2);
                $prueba->setActiveSheetIndex(0)->setCellValue("A" . $cont, $re[0]['fecha_produccion']);
                $prueba->setActiveSheetIndex(0)->setCellValue("B" . $cont, $re['Hojasproduccione']['trabajo_id']);
                $prueba->setActiveSheetIndex(0)->setCellValue("C" . $cont, $re['Hojasproduccione']['numero_hruta']);
                $prueba->setActiveSheetIndex(0)->setCellValue("D" . $cont, $re['Hojasproduccione']['orden']);
                $prueba->setActiveSheetIndex(0)->setCellValue("E" . $cont, $re['Hojasproduccione']['la_sucursal']);
                $prueba->setActiveSheetIndex(0)->setCellValue("F" . $cont, $re['Hojasproduccione']['cliente']);
                $prueba->setActiveSheetIndex(0)->setCellValue("G" . $cont, $re['Hojasproduccione']['cantidad']);
                $prueba->setActiveSheetIndex(0)->setCellValue("H" . $cont, $re['Hojasproduccione']['descripcion']);
                $prueba->setActiveSheetIndex(0)->setCellValue("I" . $cont, $re['Hojasproduccione']['tipo_trabajo']);
                $prueba->setActiveSheetIndex(0)->setCellValue("J" . $cont, $re['Hojasproduccione']['formato']);
                $prueba->setActiveSheetIndex(0)->setCellValue("K" . $cont, $re['Hojasproduccione']['caras']);
                $prueba->setActiveSheetIndex(0)->setCellValue("L" . $cont, $re['Hojasproduccione']['costo']);
            }

            $objWriter = PHPExcel_IOFactory::createWriter($prueba, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        }
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
        $tiposucursal = $this->data['Hojasproduccione']['tiposucursal'];
        $condiciones = array();
        if (!empty($sucursal_id) && $sucursal_id != 'Todos') {
            $condiciones["$tiposucursal.sucursale_id"] = $sucursal_id;
        }
        if (!empty($cliente_id) && $cliente_id != 'Todos') {
            $condiciones['Trabajo.cliente_id'] = $cliente_id;
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $condiciones["$tipofecha BETWEEN ? AND ? "] = array($fecha1, $fecha2);
        }
        $campo_sucursal = 'Sucursale.nombre';
        if ($tiposucursal != 'Hojasproduccione') {
            $campo_sucursal = 'Sucursaltt.nombre';
        }
        $sql1 = "(case when (tipo = 'Nota de entrega') THEN (CONCAT('NE ',numero)) ELSE (CONCAT('NR ',numero)) END) as orden";
        $sql2 = "SELECT $sql1 FROM `notas` WHERE (notas.trabajo_id = Hojasproduccione.trabajo_id AND notas.estado != 'Eliminado') ORDER BY id DESC LIMIT 1";
        $sql3 = "SELECT nombre FROM `clientes` WHERE (clientes.id = Trabajo.cliente_id)";
        $sql4 = "SELECT descripcion FROM `tipotrabajos` WHERE (tipotrabajos.id = Hojastipostrabajo.tipotrabajo_id)";
        $this->Hojasproduccione->virtualFields = array(
            'orden' => "CONCAT(($sql2))",
            'cliente' => "CONCAT(($sql3))",
            'formato' => "CONCAT(Hojasproduccione.metrajeini,'x',Hojasproduccione.metrajefin)",
            'tipo_trabajo' => "CONCAT(($sql4))",
            'la_sucursal' => "($campo_sucursal)"
        );
        $resultados = $this->Hojasproduccione->find('all', array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'sucursales',
                    'alias' => 'Sucursaltt',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Sucursaltt.id = Hojastipostrabajo.sucursale_id'
                    )
                )
            ),
            'conditions' => $condiciones
            , 'fields' => array('DATE(Hojasproduccione.created) as fecha_produccion', 'Hojasproduccione.trabajo_id',
                'Hojasproduccione.numero_hruta', 'Hojasproduccione.orden', 'Hojasproduccione.cliente', 'Hojasproduccione.cantidad'
                , 'Hojasproduccione.descripcion', 'Hojasproduccione.formato', 'Hojasproduccione.caras', 'Hojasproduccione.costo', 'Hojasproduccione.tipo_trabajo', 'Hojasproduccione.la_sucursal')
                )
        );

        //genera el excel encaso de q se requiera
        if ($this->request->data['Reporte']['tipo'] == 'excel') {
            $borders3 = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    //,'color' => array('argb' => 'FFFF0000')
                    )
                ),
                'font' => array(
                    'size' => 8
                    , 'bold' => true
                //,'color' => array('argb' => 'FFFF0000')
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'b4edb4')
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                )
            );
            $borders2 = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ),
                'font' => array(
                    'size' => 10
                )
            );
            $nombre_excel = "Reporte de tipo clientes.xlsx";
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $nombre_excel . '"');
            header('Cache-Control: max-age=0');

            $prueba = new PHPExcel();
            $prueba->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $prueba->getActiveSheet()->getColumnDimension('B')->setWidth(8);
            $prueba->getActiveSheet()->getColumnDimension('C')->setWidth(8);
            $prueba->getActiveSheet()->getColumnDimension('D')->setWidth(8);
            $prueba->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $prueba->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $prueba->getActiveSheet()->getColumnDimension('G')->setWidth(7);
            $prueba->getActiveSheet()->getColumnDimension('H')->setWidth(38);
            $prueba->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $prueba->getActiveSheet()->getColumnDimension('J')->setWidth(9);
            $prueba->getActiveSheet()->getColumnDimension('K')->setWidth(7);
            $prueba->getActiveSheet()->getColumnDimension('L')->setWidth(7);

            $prueba->getActiveSheet()->mergeCellsByColumnAndRow(0, 1, 11, 1);
            if (!empty($cliente)) {
                $cliente_aux = $cliente['Cliente']['nombre'];
            } else {
                $cliente_aux = 'Todos';
            }

            if (!empty($sucursal)) {
                $sucursal_aux = $sucursal['Sucursale']['nombre'];
            } else {
                $sucursal_aux = 'Todos';
            }
            $titulo = "REPORTE ENTRE FECHAS : $fecha1 A $fecha2 --- CLIENTE: $cliente_aux --- SUCURSAL: $sucursal_aux";


            $style1 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER), 'font' => array('size' => 13, 'bold' => true));
            $prueba->getActiveSheet()->getStyle("A1:L1")->applyFromArray($style1);
            $prueba->setActiveSheetIndex(0)->setCellValue("A1", "$titulo");

            $prueba->getActiveSheet()->getStyle('A2:L2' . $prueba->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);
            $prueba->getActiveSheet()->getStyle('A2:L2')->applyFromArray($borders3);
            $prueba->getActiveSheet()->getRowDimension(1)->setRowHeight(28);
            $prueba->getActiveSheet()->getRowDimension(2)->setRowHeight(31);

            $prueba->setActiveSheetIndex(0)->setCellValue("A2", "Fecha");
            $prueba->setActiveSheetIndex(0)->setCellValue("B2", "Id Trab.");
            $prueba->setActiveSheetIndex(0)->setCellValue("C2", "H. Ruta.");
            $prueba->setActiveSheetIndex(0)->setCellValue("D2", "Orden");
            $prueba->setActiveSheetIndex(0)->setCellValue("E2", "Sucursal");
            $prueba->setActiveSheetIndex(0)->setCellValue("F2", "Cliente");
            $prueba->setActiveSheetIndex(0)->setCellValue("G2", "Cantidad");
            $prueba->setActiveSheetIndex(0)->setCellValue("H2", "Descripcion");
            $prueba->setActiveSheetIndex(0)->setCellValue("I2", "Tipo Trabajo");
            $prueba->setActiveSheetIndex(0)->setCellValue("J2", "Formato");
            $prueba->setActiveSheetIndex(0)->setCellValue("K2", "Cara");
            $prueba->setActiveSheetIndex(0)->setCellValue("L2", "Costo");

            $prueba->getActiveSheet()->setTitle("Reporte de tipo clientes");

            $cont = 2;
            foreach ($resultados as $re) {
                $cont++;
                $prueba->getActiveSheet()->getStyle("A$cont:L$cont")->applyFromArray($borders2);
                $prueba->setActiveSheetIndex(0)->setCellValue("A" . $cont, $re[0]['fecha_produccion']);
                $prueba->setActiveSheetIndex(0)->setCellValue("B" . $cont, $re['Hojasproduccione']['trabajo_id']);
                $prueba->setActiveSheetIndex(0)->setCellValue("C" . $cont, $re['Hojasproduccione']['numero_hruta']);
                $prueba->setActiveSheetIndex(0)->setCellValue("D" . $cont, $re['Hojasproduccione']['orden']);
                $prueba->setActiveSheetIndex(0)->setCellValue("E" . $cont, $re['Hojasproduccione']['la_sucursal']);
                $prueba->setActiveSheetIndex(0)->setCellValue("F" . $cont, $re['Hojasproduccione']['cliente']);
                $prueba->setActiveSheetIndex(0)->setCellValue("G" . $cont, $re['Hojasproduccione']['cantidad']);
                $prueba->setActiveSheetIndex(0)->setCellValue("H" . $cont, $re['Hojasproduccione']['descripcion']);
                $prueba->setActiveSheetIndex(0)->setCellValue("I" . $cont, $re['Hojasproduccione']['tipo_trabajo']);
                $prueba->setActiveSheetIndex(0)->setCellValue("J" . $cont, $re['Hojasproduccione']['formato']);
                $prueba->setActiveSheetIndex(0)->setCellValue("K" . $cont, $re['Hojasproduccione']['caras']);
                $prueba->setActiveSheetIndex(0)->setCellValue("L" . $cont, $re['Hojasproduccione']['costo']);
            }

            $objWriter = PHPExcel_IOFactory::createWriter($prueba, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        }
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

        $tiposucursal = $this->data['Hojasproduccione']['tiposucursal'];
        $condiciones = array();
        if (!empty($sucursal_id) && $sucursal_id != 'Todos') {
            $condiciones["$tiposucursal.sucursale_id"] = $sucursal_id;
        }
        if (!empty($tipoentrega) && $tipoentrega != 'Todos') {
            $condiciones['Hojasproduccione.tipo_nota'] = $tipoentrega;
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $condiciones["$tipofecha BETWEEN ? AND ? "] = array($fecha1, $fecha2);
        }
        $campo_sucursal = 'Sucursale.nombre';
        if ($tiposucursal != 'Hojasproduccione') {
            $campo_sucursal = 'Sucursaltt.nombre';
        }
        $sql1 = "(case when (tipo = 'Nota de entrega') THEN (CONCAT('NE ',numero)) ELSE (CONCAT('NR ',numero)) END) as orden";
        $sql2 = "SELECT $sql1 FROM `notas` WHERE (notas.trabajo_id = Hojasproduccione.trabajo_id AND notas.estado != 'Eliminado') ORDER BY id DESC LIMIT 1";
        $sql3 = "SELECT nombre FROM `clientes` WHERE (clientes.id = Trabajo.cliente_id)";
        $sql4 = "SELECT descripcion FROM `tipotrabajos` WHERE (tipotrabajos.id = Hojastipostrabajo.tipotrabajo_id)";
        $this->Hojasproduccione->virtualFields = array(
            'orden' => "CONCAT(($sql2))",
            'cliente' => "CONCAT(($sql3))",
            'formato' => "CONCAT(Hojasproduccione.metrajeini,'x',Hojasproduccione.metrajefin)",
            'tipo_trabajo' => "CONCAT(($sql4))",
            'la_sucursal' => "($campo_sucursal)"
        );
        $resultados = $this->Hojasproduccione->find('all', array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'sucursales',
                    'alias' => 'Sucursaltt',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Sucursaltt.id = Hojastipostrabajo.sucursale_id'
                    )
                )
            ),
            'conditions' => $condiciones
            , 'fields' => array('DATE(Hojasproduccione.created) as fecha_produccion', 'Hojasproduccione.trabajo_id',
                'Hojasproduccione.numero_hruta', 'Hojasproduccione.orden', 'Hojasproduccione.cliente', 'Hojasproduccione.cantidad'
                , 'Hojasproduccione.descripcion', 'Hojasproduccione.formato', 'Hojasproduccione.caras', 'Hojasproduccione.costo', 'Hojasproduccione.tipo_trabajo', 'Hojasproduccione.la_sucursal')
                )
        );
        /* debug($resultados);
          exit; */
        $this->set(compact('tipotrabajo', 'sucursal', 'resultados', 'fecha1', 'fecha2', 'tipoentrega'));
    }

    public function reporte_tipo_usuario() {

        $tipoentrega = $this->data['Hojasproduccione']['tiponota'];
        $usuario = $this->data['Hojasproduccione']['user_id'];

        $d_usuario = $this->User->find('first', array(
            'recursive' => -1,
            'conditions' => array('User.id' => $usuario)
        ));

        //debug($tipotrabajo);exit;
        $sucursal_id = $this->data['Hojasproduccione']['sucursale_id'];
        $sucursal = $this->Sucursale->find('first', array('fields' => array('Sucursale.nombre'), 'conditions' => array('Sucursale.id' => $sucursal_id)));
        $fecha1 = $this->data['Hojasproduccione']['fecha_inicio'];
        $fecha2 = $this->data['Hojasproduccione']['fecha_fin'];
        $tipofecha = $this->data['Hojasproduccione']['tipo_fecha'];

        $tiposucursal = $this->data['Hojasproduccione']['tiposucursal'];
        $condiciones = array();
        if (!empty($sucursal_id) && $sucursal_id != 'Todos') {
            $condiciones["$tiposucursal.sucursale_id"] = $sucursal_id;
        }
        if (!empty($tipoentrega) && $tipoentrega != 'Todos') {
            $condiciones['Hojasproduccione.tipo_nota'] = $tipoentrega;
        }

        if (!empty($usuario) && $usuario != 'Todos') {
            $condiciones['Hojasproduccione.user_id'] = $usuario;
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $condiciones["$tipofecha BETWEEN ? AND ? "] = array($fecha1, $fecha2);
        }
        $campo_sucursal = 'Sucursale.nombre';
        if ($tiposucursal != 'Hojasproduccione') {
            $campo_sucursal = 'Sucursaltt.nombre';
        }
        $sql1 = "(case when (tipo = 'Nota de entrega') THEN (CONCAT('NE ',numero)) ELSE (CONCAT('NR ',numero)) END) as orden";
        $sql2 = "SELECT $sql1 FROM `notas` WHERE (notas.trabajo_id = Hojasproduccione.trabajo_id AND notas.estado != 'Eliminado') ORDER BY id DESC LIMIT 1";
        $sql3 = "SELECT nombre FROM `clientes` WHERE (clientes.id = Trabajo.cliente_id)";
        $sql4 = "SELECT descripcion FROM `tipotrabajos` WHERE (tipotrabajos.id = Hojastipostrabajo.tipotrabajo_id)";
        $this->Hojasproduccione->virtualFields = array(
            'orden' => "CONCAT(($sql2))",
            'cliente' => "CONCAT(($sql3))",
            'formato' => "CONCAT(Hojasproduccione.metrajeini,'x',Hojasproduccione.metrajefin)",
            'tipo_trabajo' => "CONCAT(($sql4))",
            'la_sucursal' => "($campo_sucursal)"
        );
        $resultados = $this->Hojasproduccione->find('all', array(
            'recursive' => 0,
            'joins' => array(
                array(
                    'table' => 'sucursales',
                    'alias' => 'Sucursaltt',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Sucursaltt.id = Hojastipostrabajo.sucursale_id'
                    )
                )
            ),
            'conditions' => $condiciones
            , 'fields' => array('DATE(Hojasproduccione.created) as fecha_produccion', 'Hojasproduccione.trabajo_id',
                'Hojasproduccione.numero_hruta', 'Hojasproduccione.orden', 'Hojasproduccione.cliente', 'Hojasproduccione.cantidad'
                , 'Hojasproduccione.descripcion', 'Hojasproduccione.formato', 'Hojasproduccione.caras', 'Hojasproduccione.costo', 'Hojasproduccione.tipo_trabajo', 'Hojasproduccione.la_sucursal', 'User.nombre')
                )
        );
        /* debug($resultados);
          exit; */
        $this->set(compact('tipotrabajo', 'sucursal', 'resultados', 'fecha1', 'fecha2', 'tipoentrega', 'd_usuari', 'd_usuario'));
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
        $movimientos = $this->Cajachica->find('all', array(
            'recursive' => 0,
            'fields' => array('Cajachica.fecha', 'Categoriasmonto.nombre', 'Cajachica.nota', 'Cajachica.entrada', 'Cajachica.salida', 'Cajachica.total', 'Cajachica.observaciones', 'User.nombre'),
            'conditions' => $condiciones
        ));
        $this->set(compact('fecha1', 'fecha2', 'movimientos', 'tipo'));
    }

}
