<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require ('assets/extensions/fpdf/fpdf.php');

class PDF extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_PVD_model');
        $this->load->model('data/dao_inventory_model');
        $this->load->model('data/dao_softwareStuff_model');
        $this->load->model('data/dao_MC_model');
        $this->load->model('user_model');
        $this->load->model('equipment_model');
        $this->load->model('correctiveM_model');
    }

    public function exportInventoryExcel(){





        // filename for download
        $filename = "website_data_.xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $data = [
["firstname" => "Mary", "lastname" => "Johnson", "age" => 25],
["firstname" => "Amanda", "lastname" => "Miller", "age" => 18],
["firstname" => "James", "lastname" => "Brown", "age" => 31],
["firstname" => "Patricia", "lastname" => "Williams", "age" => 7],
["firstname" => "Michael", "lastname" => "Davis", "age" => 43],
["firstname" => "Sarah", "lastname" => "Miller", "age" => 24],
["firstname" => "Patrick", "lastname" => "Miller", "age" => 27]
];

          $flag = false;
          foreach($data as $row) {
            if(!$flag) {
              // display field/column names as first row
              echo implode("\t", array_keys($row)) . "\r\n";
              $flag = true;
            }
            echo implode("\t", array_values($row)) . "\r\n";
          }
            exit;
    }

    public function crearActaAA(){
      $pvd = $this->dao_PVD_model->getPVDbyId($_GET['k_pvd']);
      if($_GET['k_tipo'] == "Pl"){
        $_GET['k_tipo'] = "Plus";
      }
      $respuesta['PVD'] = $this->dao_PVD_model->getPVDbyId($_GET['k_pvd']);
      if ($respuesta['PVD']->getRegion() == "Zona 1"){
        $stirngPrecio = "V_PRICE_R1";
      }
      if ($respuesta['PVD']->getRegion() == "Zona 4"){
        $stirngPrecio = "V_PRICE_R4";
      }
      $respuesta['inventory'] = $this->dao_inventory_model->getEquipmentTypePVD($_GET['k_fase'], $_GET['k_tipo'], $_GET['k_pvd']);
      for($i = 0; $i< count($respuesta['inventory']); $i++){
        $respuesta['inventory'][$i]['valorT'] = 0;
        $respuesta['inventory'][$i]['funcional'] = 0;
        $respuesta['inventory'][$i]['averiado'] = 0;
        $respuesta['inventory'][$i]['NE'] = 0;
        $respuesta['inventory'][$i]['avance'] = 0;
        $valoresParciales = array();
        $p = 0;
        for($j = 0; $j< count($respuesta['inventory'][$i]['inventario']); $j++){
          if($folders[$respuesta['inventory'][$i]['N_NAME']][$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']]['Antes del Mantenimiento'] == 1 && $respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] != "Averiado"){
            $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 0;
          }
          if($folders[$respuesta['inventory'][$i]['N_NAME']][$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']]['Durante el Mantenimiento'] == 1 && $respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] != "Averiado"){
            $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 0;
          }
          if($folders[$respuesta['inventory'][$i]['N_NAME']][$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']]['Despues del Mantenimiento'] == 1 && $respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] != "Averiado"){
            $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 0;
          }
          $url = "https://console.aws.amazon.com/s3/buckets/".strtolower($_GET['k_ticket'])."/Registro Fotografico"."/".$respuesta['inventory'][$i]['N_NAME']."/".$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']."/"."?region=us-west-2&tab=overview";
          if (isset($respuesta['inventory'][$i]['inventario'][$j]['url'])){
            $respuesta['inventory'][$i]['inventario'][$j]['url'] = $url;
          }
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Funcional"){
            if($respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio] > 0){
              $respuesta['inventory'][$i]['funcional']++;
            }
            if($respuesta['inventory'][$i]['inventario'][$j]['Q_PROGRESS'] == 1){
              $respuesta['inventory'][$i]['valorT'] += $respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio];
              $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 100;
            }
            $valoresParciales[$p] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'];
            $p++;
          }
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Averiado"){
            $respuesta['inventory'][$i]['averiado']++;
          }
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "No encontrado"){
            $respuesta['inventory'][$i]['NE']++;
          }
        }
        if (count($valoresParciales) > 0){
          $porcentaje  = 100 / count($valoresParciales);
        }
        for($p = 0; $p<count($valoresParciales); $p++){
          $respuesta['inventory'][$i]['avance'] += $porcentaje / 100 * $valoresParciales[$p];
        }
         $respuesta['inventory'][$i]['avance'] = number_format((float) $respuesta['inventory'][$i]['avance'], 2, '.', '');
         $respuesta['avance'] = $respuesta['avance'] + ((100/count($respuesta['inventory']))/100*$respuesta['inventory'][$i]['avance']);
      }

      $inventory = $this->dao_inventory_model->getEquipmentTypePVD($_GET['k_fase'], $_GET['k_tipo'], $_GET['k_pvd']);
    //  print_r($respuesta['inventory']);
      $timezone = date_default_timezone_get();
      $date = date('m/d/Y', time());

      $pdf=new FPDF('P','mm','A4');
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',9);
      $pdf->Image('http://images.dailytech.com/nimage/34372_ZTE_Tomorrow_Never_Waits_FP_Wide.png',165,12,33);
      $pdf->Image('https://image.ibb.co/frtUS5/logo_consorcio.png',10,12,38);

      //LLenar header
      $this->fillHeaderTableAA($pdf, $pvd, $date);

      //Texto de compromiso
      $pdf->Ln(5);
      $pdf->SetFont('Arial','',6);
      $pdf->Cell(190,5,utf8_decode('Yo '.$_POST['nombreAdmin'].', identificado con C.C. No. '.$_POST['cedulaAdmin'].' de '.utf8_decode($_POST['ciudadAdmin']).', actuando como Administrador PVD '.$_GET['k_pvd'].' certifico que '.utf8_decode($_POST['nombreTec']).', identificado con C.C. '.utf8_decode($_POST['cedulaTec']).' de '.utf8_decode($_POST['ciudadTec']).' en'),0,1,'C');
      $pdf->Cell(190,5,utf8_decode(' representación del Consorcio Integradores 2018 bajo el contrato suscrito con Fonade número 2162858, se presentó al Punto Vive Digital con el objetivo de realizar mantenimiento preventivo.'),0,1,'C');
      $pdf->Ln(5);
      $pdf->Cell(190,5,utf8_decode('El resultado del mantenimiento se describe a continuación:'),0,1,'L');

      $pdf->Ln(5);
      $pdf->SetFont('Arial','B',6);
      $pdf->Cell(190,5,utf8_decode('ESTADO GENERAL DEL PVD'),0,1);
      $pdf->SetFont('Arial','',6);
      $pdf->Cell(190,5,utf8_decode('- Si están en operación lo SS'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Infraestructura física'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Señalética'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Cantidad de equipos en falla y tipos de equipos'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Cualquier observación adicional'),0,1);

      $pdf->Ln(10);
      $pdf->SetFont('Arial','B',6);
      $pdf->Cell(190,5,utf8_decode('CAUSAS DE FALLAS ENCONTRADAS'),0,1);
      $pdf->SetFont('Arial','',6);
      $pdf->Cell(190,5,utf8_decode('- Daño por uso'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Daño por mal uso'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Daño por falta de mantenimiento'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Daño por falla eléctrica'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Otras causas'),0,1);

      $pdf->Ln(10);
      $pdf->SetFont('Arial','B',6);
      $pdf->Cell(190,5,utf8_decode('RECOMENDACIONES GENERALES'),0,1);
      $pdf->SetFont('Arial','',6);
      $pdf->Cell(190,5,utf8_decode('- Acciones preventivas a seguir para mejorar la operación'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Dotar consumibles'),0,1);
      $pdf->Cell(190,5,utf8_decode('- Etc.'),0,1);

      //Lenar resumen PVD
      $this->fillAbstractPVDAA($pdf, $respuesta['inventory']);

      //Llenar tabla de correctivos
      $this->fillCorrectiveTableAA($pdf, $inventory);

      //Llenar tabla de correctivos
      $this->fillFunctionalTableAA($pdf, $inventory);

      //Lenar firmas
      $this->fillCCAA($pdf);

      //Lenar firmas
      $this->fillSigns($pdf);

      $pdf->Output();
    }

    public function crearActaIT(){
      $pvd = $this->dao_PVD_model->getPVDbyId($_GET['k_pvd']);
      if($_GET['k_tipo'] == "Pl"){
        $_GET['k_tipo'] = "Plus";
      }
      $respuesta['PVD'] = $this->dao_PVD_model->getPVDbyId($_GET['k_pvd']);
      if ($respuesta['PVD']->getRegion() == "Zona 1"){
        $stirngPrecio = "V_PRICE_R1";
      }
      if ($respuesta['PVD']->getRegion() == "Zona 4"){
        $stirngPrecio = "V_PRICE_R4";
      }
      $respuesta['inventory'] = $this->dao_inventory_model->getEquipmentTypePVD($_GET['k_fase'], $_GET['k_tipo'], $_GET['k_pvd']);
      for($i = 0; $i< count($respuesta['inventory']); $i++){
        $respuesta['inventory'][$i]['valorT'] = 0;
        $respuesta['inventory'][$i]['funcional'] = 0;
        $respuesta['inventory'][$i]['averiado'] = 0;
        $respuesta['inventory'][$i]['NE'] = 0;
        $respuesta['inventory'][$i]['avance'] = 0;
        $valoresParciales = array();
        $p = 0;
        for($j = 0; $j< count($respuesta['inventory'][$i]['inventario']); $j++){
          if($folders[$respuesta['inventory'][$i]['N_NAME']][$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']]['Antes del Mantenimiento'] == 1 && $respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] != "Averiado"){
            $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 0;
          }
          if($folders[$respuesta['inventory'][$i]['N_NAME']][$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']]['Durante el Mantenimiento'] == 1 && $respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] != "Averiado"){
            $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 0;
          }
          if($folders[$respuesta['inventory'][$i]['N_NAME']][$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']]['Despues del Mantenimiento'] == 1 && $respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] != "Averiado"){
            $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 0;
          }
          $url = "https://console.aws.amazon.com/s3/buckets/".strtolower($_GET['k_ticket'])."/Registro Fotografico"."/".$respuesta['inventory'][$i]['N_NAME']."/".$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']."/"."?region=us-west-2&tab=overview";
          if (isset($respuesta['inventory'][$i]['inventario'][$j]['url'])){
            $respuesta['inventory'][$i]['inventario'][$j]['url'] = $url;
          }
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Funcional"){
            if($respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio] > 0){
              $respuesta['inventory'][$i]['funcional']++;
            }
            if($respuesta['inventory'][$i]['inventario'][$j]['Q_PROGRESS'] == 1){
              $respuesta['inventory'][$i]['valorT'] += $respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio];
              $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 100;
            }
            $valoresParciales[$p] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'];
            $p++;
          }
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Averiado"){
            $respuesta['inventory'][$i]['averiado']++;
          }
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "No encontrado"){
            $respuesta['inventory'][$i]['NE']++;
          }
        }
        if (count($valoresParciales) > 0){
          $porcentaje  = 100 / count($valoresParciales);
        }
        for($p = 0; $p<count($valoresParciales); $p++){
          $respuesta['inventory'][$i]['avance'] += $porcentaje / 100 * $valoresParciales[$p];
        }
         $respuesta['inventory'][$i]['avance'] = number_format((float) $respuesta['inventory'][$i]['avance'], 2, '.', '');
         $respuesta['avance'] = $respuesta['avance'] + ((100/count($respuesta['inventory']))/100*$respuesta['inventory'][$i]['avance']);
      }

      $inventory = $this->dao_inventory_model->getEquipmentTypePVD($_GET['k_fase'], $_GET['k_tipo'], $_GET['k_pvd']);
    //  print_r($respuesta['inventory']);
      $timezone = date_default_timezone_get();
      $date = date('m/d/Y', time());

      $pdf=new FPDF('L','mm','A4');
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',9);
      $pdf->Image('http://images.dailytech.com/nimage/34372_ZTE_Tomorrow_Never_Waits_FP_Wide.png',250,12,33);
      $pdf->Image('https://image.ibb.co/frtUS5/logo_consorcio.png',15,12,33);

      //LLenar header
      $this->fillHeaderTable($pdf, $pvd, $date);

      //Texto de compromiso
      $pdf->Ln(5);
      $pdf->SetFont('Arial','',6);
      $pdf->Cell(275,5,utf8_decode('Yo '.$_POST['nombreAdmin'].', identificado con C.C. No. '.$_POST['cedulaAdmin'].' de '.utf8_decode($_POST['ciudadAdmin']).', actuando como Administrador PVD '.$_GET['k_pvd'].' certifico que '.utf8_decode($_POST['nombreTec']).', identificado con C.C. '.utf8_decode($_POST['cedulaTec']).' de '.utf8_decode($_POST['ciudadTec']).' en representación del Consorcio Integradores 2018'),0,1,'C');
      $pdf->Cell(275,5,utf8_decode('bajo el contrato suscrito con Fonade, se presentó al Punto Vive Digital con el objetivo de realizar mantenimiento preventivo'),0,1,'C');
      $pdf->Ln(5);
      $pdf->Cell(275,5,utf8_decode('El resultado del mantenimiento se describe a continuación:'),0,1,'L');

      //Llenar tabla de correctivos
      $this->fillCorrectiveTable($pdf, $inventory);

      //Lenar tabla de velocidad
      $this->fillSpeedTable($pdf);

      //Lenar resumen PVD
      $this->fillAbstractPVD($pdf, $respuesta['inventory']);

      $this->fillFunctionalTable($pdf, $respuesta['inventory']);

      //Lenar firmas
      $this->fillCCC($pdf);

      //Lenar firmas
      $this->fillSigns($pdf);

      $pdf->Output();
    }

    public function fillCCC($pdf){
      $ccc =  $this->dao_PVD_model->getAllCCCTicketsPerPBV($_GET['k_pvd']);
      $pdf->Ln(10);
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(275,5,'Estado de PQR',0,1,'C');
      $pdf->Cell(275,5,utf8_decode('Se verificó con el CCC el estado de los tickets abiertos para el punto, y se realiza atención y cierre'),0,1,'C');
      $pdf->SetFont('Arial','',7);

      $pdf->Cell(40,5,utf8_decode('Ticket CCC'),1,0,'C');
      $pdf->Cell(90,5,utf8_decode('Descripción'),1,0,'C');
      $pdf->Cell(30,5,utf8_decode('Estado'),1,0,'C');
      $pdf->Cell(115,5,utf8_decode('Observaciones'),1,1,'C');

      for($i = 0; $i< count($ccc); $i++){
        if($ccc[$i]['N_TIPO'] == "IT"){
          $sizer = strlen($ccc[$i]['N_DESCRIPTION'])/85;
          $sizer2 = strlen($ccc[$i]['N_OBSERVATION'])/90;
          if($sizer > $sizer2){
            $sizer2 = strlen($ccc[$i]['N_DESCRIPTION']/85);
          }else {
            $sizer = strlen($ccc[$i]['N_DESCRIPTION']/85);
          }
          if($sizer2 > $sizer){
            $sizer = $sizer2;
          }

          $pdf->Cell(40,5,utf8_decode($ccc[$i]['K_IDTICKET_CCC']),"TLR",0,'C');
          $pdf->Cell(90,5,utf8_decode(substr($ccc[$i]['N_DESCRIPTION'],0,85)),"TLR",0,'C');
          $pdf->Cell(30,5,utf8_decode($ccc[$i]['N_ESTADO']),"TLR",0,'C');
          $pdf->Cell(115,5,utf8_decode(substr($ccc[$i]['N_OBSERVATION'],0,90)),"TLR",1,'C');

          for($k = 1; $k<=($sizer); $k++){
            $pdf->Cell(40,5,'',"LR",0,'C');
            $pdf->Cell(90,5,utf8_decode(substr($ccc[$i]['N_DESCRIPTION'],$k*85,85)),"LR",0,'C');
            $pdf->Cell(30,5,'',"LR",0,'C');
            $pdf->Cell(115,5,utf8_decode(substr($ccc[$i]['N_OBSERVATION'],$k*90,90)),"LR",1,'C');
          }
        }
      }
      $pdf->Cell(275,0,'',1,1,'C');
    }

    public function fillCCAA($pdf){
      $ccc =  $this->dao_PVD_model->getAllCCCTicketsPerPBV($_GET['k_pvd']);
      $pdf->Ln(10);
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(190,5,'Estado de PQR',0,1,'C');
      $pdf->Cell(190,5,utf8_decode('Se verificó con el CCC el estado de los tickets abiertos para el punto, y se realiza atención y cierre'),0,1,'C');
      $pdf->SetFont('Arial','',7);

      $pdf->Cell(30,5,utf8_decode('Ticket CCC'),1,0,'C');
      $pdf->Cell(50,5,utf8_decode('Descripción'),1,0,'C');
      $pdf->Cell(30,5,utf8_decode('Estado'),1,0,'C');
      $pdf->Cell(80,5,utf8_decode('Observaciones'),1,1,'C');

      for($i = 0; $i< count($ccc); $i++){
        if($ccc[$i]['N_TIPO'] == "AA"){
          $sizer = strlen($ccc[$i]['N_DESCRIPTION'])/35;
          $sizer2 = strlen($ccc[$i]['N_OBSERVATION'])/60;
          if($sizer > $sizer2){
            $sizer2 = strlen($ccc[$i]['N_DESCRIPTION']/35);
          }else {
            $sizer = strlen($ccc[$i]['N_DESCRIPTION']/35);
          }
          if($sizer2 > $sizer){
            $sizer = $sizer2;
          }

          $pdf->Cell(30,5,utf8_decode($ccc[$i]['K_IDTICKET_CCC']),"TLR",0,'C');
          $pdf->Cell(50,5,utf8_decode(substr($ccc[$i]['N_DESCRIPTION'],0,35)),"TLR",0,'C');
          $pdf->Cell(30,5,utf8_decode($ccc[$i]['N_ESTADO']),"TLR",0,'C');
          $pdf->Cell(80,5,utf8_decode(substr($ccc[$i]['N_OBSERVATION'],0,60)),"TLR",1,'C');

          for($k = 1; $k<=($sizer); $k++){
            $pdf->Cell(30,5,'',"LR",0,'C');
            $pdf->Cell(50,5,utf8_decode(substr($ccc[$i]['N_DESCRIPTION'],$k*35,35)),"LR",0,'C');
            $pdf->Cell(30,5,'',"LR",0,'C');
            $pdf->Cell(80,5,utf8_decode(substr($ccc[$i]['N_OBSERVATION'],$k*60,60)),"LR",1,'C');
          }
        }
      }
      $pdf->Cell(190,0,'',1,1,'C');
    }

    public function fillSigns($pdf){
      $pdf->Ln(10);
      $pdf->SetFont('Arial','',7);
      date_default_timezone_set("America/Bogota");
      $mysqlDateTime = date('c');
      $pdf->Cell(275,5,'En constancia se firma el '.explode("T", $mysqlDateTime)[0],0,1,'L');
      $pdf->Ln(30);
      $pdf->Cell(30,5,'Firma administrador PVD',0,0,'L');
      $pdf->Cell(100,5,'',0,0,'C');
      $pdf->Cell(30,5,'Firma representante del integrador',0,1,'L');
      $pdf->Cell(30,5,'Nombre: '.utf8_decode($_POST['nombreAdmin']),0,0,'L');
      $pdf->Cell(100,5,'',0,0,'C');
      $pdf->Cell(30,5,'Nombre: '.utf8_decode($_POST['nombreTec']),0,1,'CL');
      $pdf->Cell(30,5,'C.C. : '.utf8_decode($_POST['cedulaAdmin']),0,0,'L');
      $pdf->Cell(100,5,'',0,0,'C');
      $pdf->Cell(30,5,'C.C. : '.utf8_decode($_POST['cedulaTec']),0,1,'CL');
      $pdf->Cell(30,5,'Cel. : '.utf8_decode($_POST['telefonoAdmin']),0,0,'L');
      $pdf->Cell(100,5,'',0,0,'C');


    }

    public function fillAbstractPVD($pdf, $inventory){
      $pdf->Ln(10);
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(275,5,'INVENTARIO GENERAL DEL PVD',0,1,'C');
      $pdf->SetFont('Arial','',6);
      $pdf->Cell(190,5,'Resumen de equipos a los cuales se les realizo la rutina de mantenimiento preventivo, la rutina de mantenimiento fue enviada previamente al momento de agendar la visita al correo del administrador del PVD.',0,1,'C');
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(155,5,'ITEM',1,0,'C');
      $pdf->Cell(30,5,'CANTIDAD TIPOLOGIA',1,0,'C');
      $pdf->Cell(30,5,'EN INVENTARIO',1,0,'C');
      $pdf->Cell(30,5,'EN CORRECTIVO',1,0,'C');
      $pdf->Cell(30,5,'NO ENCONTRADO',1,1,'C');
      $pdf->SetFont('Arial','',7);

      for ($i = 0; $i < count($inventory); $i++){
        if ($inventory[$i]['N_NAME'] != "UPS" && $inventory[$i]['N_NAME'] != "Redes electricas" && $inventory[$i]['N_NAME'] != "Aire acondicionado"){
          $pdf->Cell(155,5,utf8_decode($inventory[$i]['N_NAME']),1,0,'C');
          $pdf->Cell(30,5,$inventory[$i]['I_QUANTITY'],1,0,'C');
          $pdf->Cell(30,5,$inventory[$i]['funcional'],1,0,'C');
          $pdf->Cell(30,5,$inventory[$i]['averiado'],1,0,'C');
          $pdf->Cell(30,5,$inventory[$i]['NE'],1,1,'C');
        }
      }
    }

    public function fillAbstractPVDAA($pdf, $inventory){
      $pdf->Ln(10);
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(190,5,'INVENTARIO DEL PVD',0,1,'C');
      $pdf->SetFont('Arial','',6);
      $pdf->Cell(190,5,'Resumen de equipos a los cuales se les realizo la rutina de mantenimiento preventivo, la rutina de mantenimiento fue enviada previamente al momento de agendar la visita al correo del administrador del PVD.',0,1,'C');
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(70,5,'ITEM',1,0,'C');
      $pdf->Cell(30,5,'CANTIDAD TIPOLOGIA',1,0,'C');
      $pdf->Cell(30,5,'EN INVENTARIO',1,0,'C');
      $pdf->Cell(30,5,'EN CORRECTIVO',1,0,'C');
      $pdf->Cell(30,5,'NO ENCONTRADO',1,1,'C');
      $pdf->SetFont('Arial','',7);

      for ($i = 0; $i < count($inventory); $i++){
        if ($inventory[$i]['N_NAME'] == "UPS" || $inventory[$i]['N_NAME'] == "Redes electricas" || $inventory[$i]['N_NAME'] == "Aire acondicionado"){
          $pdf->Cell(70,5,utf8_decode($inventory[$i]['N_NAME']),1,0,'C');
          $pdf->Cell(30,5,$inventory[$i]['I_QUANTITY'],1,0,'C');
          $pdf->Cell(30,5,$inventory[$i]['funcional'],1,0,'C');
          $pdf->Cell(30,5,$inventory[$i]['averiado'],1,0,'C');
          $pdf->Cell(30,5,$inventory[$i]['NE'],1,1,'C');
        }
      }
    }

    public function fillSpeedTable($pdf){
      $pdf->Ln(10);
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(275,5,'ESTADO DE CONECTIVIDAD',0,1,'C');
      $pdf->SetFont('Arial','B',6);
      $pdf->Cell(35,5,'El punto vive digital',1,0,'C');
      $pdf->Cell(240,5,'Se realizo prueba de velocidad y se encontraron los siguientes resultados, conectados directamente al Router de entrada.',1,1,'C');
      $pdf->Cell(35,5,'Cuenta con ',1,0,'C');
      $pdf->Cell(120,5,'Velocidad Download',1,0,'C');
      $pdf->Cell(120,5,'Velocidad Upload',1,1,'C');
      $pdf->Cell(35,5,'',0,0,'C');
      $pdf->Cell(120,5,$_POST['velocidadD'],1,0,'C');
      $pdf->Cell(120,5,$_POST['velocidadU'],1,1,'C');
    }

    public function fillFunctionalTable($pdf, $inventory){
        //Titulo
        $pdf->Ln(10);

        date_default_timezone_set("America/Bogota");
        $mysqlDateTime = date('c');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(295,5,'INVENTARIO  DE EQUIPOS DE IT FUNCIONALES',0,1,'C');
        $pdf->SetFont('Arial','',7);

        //Header Tabla
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(40,5,'TICKET MP',"TLR",0,'C');
        $pdf->Cell(140,5,'TIPO EQUIPO',"TLR",0,'C');
        $pdf->Cell(30,5,'SERIAL',"TLR",0,'C');
        $pdf->Cell(30,5,'MARCA',"TLR",0,'C');
        $pdf->Cell(35,5,'MODELO',"TLR",1,'C');
        $pdf->SetFont('Arial','',6);

        for($i = 0; $i< count($inventory); $i++){
          for($j = 0; $j< count($inventory[$i]['inventario']); $j++){
            if($inventory[$i]['inventario'][$j]['N_ESTADO'] == "Funcional"){
              if($inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] != 211 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] != 212 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] != 213 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] != 214 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] != 215 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] != 216){
                $cateforia = $this->dao_inventory_model->getStuffCatById($inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY']);

                $info = $this->dao_inventory_model->getModelbiId($inventory[$i]['inventario'][$j]['K_IDMODEL']);

                $pdf->Cell(40,5,$_GET['k_ticket'],"TLR",0,'C');
                $pdf->Cell(140,5,utf8_decode($cateforia['N_NAME']),"TLR",0,'C');
                $pdf->Cell(30,5,$inventory[$i]['inventario'][$j]['N_SERIAL'],"TLR",0,'C');
                $pdf->Cell(30,5,utf8_decode($info['ma']),"TLR",0,'C');
                $pdf->Cell(35,5,utf8_decode($info['mo']),"TLR",1,'C');
              }
            }
          }
        }
        $pdf->Cell(275,0,'',1,1,'C');
      }


      public function fillFunctionalTableAA($pdf, $inventory){
        //Titulo
        $pdf->Ln(10);

        date_default_timezone_set("America/Bogota");
        $mysqlDateTime = date('c');

        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(190,5,'INVENTARIO DE INFRAESTRUCTURA DE EQUIPOS AA',0,1,'C');
        $pdf->SetFont('Arial','',7);

        //Header Tabla
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(30,5,'TICKET MP',"TLR",0,'C');
        $pdf->Cell(90,5,'TIPO EQUIPO',"TLR",0,'C');
        $pdf->Cell(25,5,'SERIAL',"TLR",0,'C');
        $pdf->Cell(25,5,'MARCA',"TLR",0,'C');
        $pdf->Cell(20,5,'MODELO',"TLR",1,'C');
        $pdf->SetFont('Arial','',6);

        for($i = 0; $i< count($inventory); $i++){
          for($j = 0; $j< count($inventory[$i]['inventario']); $j++){
            if($inventory[$i]['inventario'][$j]['N_ESTADO'] == "Funcional"){
              if($inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 211 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 212 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 213 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 214 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 215 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 216){
                $cateforia = $this->dao_inventory_model->getStuffCatById($inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY']);

                $info = $this->dao_inventory_model->getModelbiId($inventory[$i]['inventario'][$j]['K_IDMODEL']);
                $corrective = $this->dao_inventory_model->getCorrectiveTicketPerStuff($inventory[$i]['inventario'][$j]['K_IDSTUFF']);
                $sizer = strlen($corrective['N_FAILURE_DESCRIPTION']);
                $sizer2 = strlen($corrective['N_NEW_ELEMENTS']);
                if($sizer > $sizer2){
                  $sizer2 = strlen($corrective['N_FAILURE_CLASSIFICATION']);
                }else {
                  $sizer = strlen($corrective['N_FAILURE_CLASSIFICATION']);
                }
                if($sizer2 > $sizer){
                  $sizer = $sizer2;
                }
                $pdf->Cell(30,5,$_GET['k_ticket'],"TLR",0,'C');
                $pdf->Cell(90,5,utf8_decode($cateforia['N_NAME']),"TLR",0,'C');
                $pdf->Cell(25,5,$inventory[$i]['inventario'][$j]['N_SERIAL'],"TLR",0,'C');
                $pdf->Cell(25,5,utf8_decode($info['ma']),"TLR",0,'C');
                $pdf->Cell(20,5,utf8_decode($info['mo']),"TLR",1,'C');

                for($k = 1; $k<=($sizer/32); $k++){
                  $pdf->Cell(30,5,'',"LR",0,'C');
                  $pdf->Cell(90,5,'',"LR",0,'C');
                  $pdf->Cell(25,5,'',"LR",0,'C');
                  $pdf->Cell(25,5,'',"LR",0,'C');
                  $pdf->Cell(20,5,'',"LR",1,'C');
                }
              }
            }
          }
        }
        $pdf->Cell(190,0,'',1,1,'C');
      }

    public function fillCorrectiveTableAA($pdf, $inventory){
      //Titulo
      $pdf->Ln(10);

      date_default_timezone_set("America/Bogota");
      $mysqlDateTime = date('c');

      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(190,5,'ESTADO GENERAL DEL PVD Y FALLAS ENCONTRADAS',0,1,'C');
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(190,5,utf8_decode('El PVD se encuentra en funcionamiento de manera correcta en todos sus sistemas excepto en los siguientes componentes los cuales se relacionan a continuación'),0,1,'C');
      $pdf->Cell(190,5,utf8_decode(' y que serán escalados a interventoria y FONADE para su aprobación de solución'),0,1,'C');

      //Header Tabla
      $pdf->SetFont('Arial','B',6);
      $pdf->Cell(20,5,'TICKET CCC',"TLR",0,'C');
      $pdf->Cell(20,5,'TICKET MP',"TLR",0,'C');
      $pdf->Cell(20,5,'TIPO EQUIPO',"TLR",0,'C');
      $pdf->Cell(25,5,'SERIAL',"TLR",0,'C');
      $pdf->Cell(25,5,'MARCA',"TLR",0,'C');
      $pdf->Cell(20,5,'MODELO',"TLR",0,'C');
      $pdf->Cell(25,5,utf8_decode('DESCRIPCIÓN'),"TLR",0,'C');
      $pdf->Cell(35,5,'MATERIALES',"TLR",1,'C');

      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(25,5,'',"BLR",0,'C');
      $pdf->Cell(25,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(25,5,'FALLA',"BLR",0,'C');
      $pdf->Cell(35,5,'PARA SOLUCIONAR',"BLR",1,'C');
      $pdf->SetFont('Arial','',6);

      for($i = 0; $i< count($inventory); $i++){
        for($j = 0; $j< count($inventory[$i]['inventario']); $j++){
          if($inventory[$i]['inventario'][$j]['N_ESTADO'] == "Averiado"){
            if($inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 211 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 212 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 213 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 214 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 215 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 216 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 156 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 155 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 157 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 158 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 159 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 160 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 161 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 162 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 163 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 164 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 165 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 166 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 167 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 168 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 169 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 170 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 171 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 172 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 173 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 174 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 175 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 176 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 177 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 178 || $inventory[$i]['inventario'][$j]['K_IDSTUFF_CATEGORY'] == 179){

              $info = $this->dao_inventory_model->getModelbiId($inventory[$i]['inventario'][$j]['K_IDMODEL']);
              $corrective = $this->dao_inventory_model->getCorrectiveTicketPerStuff($inventory[$i]['inventario'][$j]['K_IDSTUFF']);
              $sizer = strlen($corrective['N_FAILURE_DESCRIPTION']);
              $sizer2 = strlen($corrective['N_NEW_ELEMENTS']);
              if($sizer > $sizer2){
                $sizer2 = strlen($corrective['N_FAILURE_CLASSIFICATION']);
              }else {
                $sizer = strlen($corrective['N_FAILURE_CLASSIFICATION']);
              }
              if($sizer2 > $sizer){
                $sizer = $sizer2;
              }
              $pdf->Cell(20,5,'',"TLR",0,'C');
              $pdf->Cell(20,5,$_GET['k_ticket'],"TLR",0,'C');
              $pdf->Cell(20,5,utf8_decode(substr($info['sc'],0,20)),"TLR",0,'C');
              $pdf->Cell(25,5,$inventory[$i]['inventario'][$j]['N_SERIAL'],"TLR",0,'C');
              $pdf->Cell(25,5,utf8_decode($info['ma']),"TLR",0,'C');
              $pdf->Cell(20,5,utf8_decode($info['mo']),"TLR",0,'C');
              $pdf->Cell(25,5,utf8_decode(substr($corrective['N_FAILURE_DESCRIPTION'],0,22)),"TLR",0,'C');
              $pdf->Cell(35,5,utf8_decode(substr($corrective['N_NEW_ELEMENTS'],0,32)),"TLR",1,'C');

              for($k = 1; $k<=($sizer/32); $k++){
                $pdf->Cell(20,5,'',"LR",0,'C');
                $pdf->Cell(20,5,'',"LR",0,'C');
                $pdf->Cell(20,5,'',"LR",0,'C');
                $pdf->Cell(25,5,'',"LR",0,'C');
                $pdf->Cell(25,5,'',"LR",0,'C');
                $pdf->Cell(20,5,'',"LR",0,'C');
                $pdf->Cell(25,5,utf8_decode(substr($corrective['N_FAILURE_DESCRIPTION'],$k*22,22)),"LR",0,'C');
                $pdf->Cell(35,5,utf8_decode(substr($corrective['N_NEW_ELEMENTS'],$k*32,32)),"LR",1,'C');
              }
            }
          }
        }
      }
      $pdf->Cell(190,0,'',1,1,'C');
    }

    public function fillCorrectiveTable($pdf, $inventory){
      //Titulo
      date_default_timezone_set("America/Bogota");
      $mysqlDateTime = date('c');

      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(275,5,'ESTADO GENERAL DEL PVD Y FALLAS ENCONTRADAS',0,1,'C');
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(275,5,utf8_decode('El PVD se encuentra en funcionamiento de manera correcta en todos sus sistemas excepto en los siguientes componentes los cuales se relacionan a continuación y que serán escalados a interventoria y FONADE para su aprobación de solución'),0,1,'C');
      //Header Tabla
      $pdf->SetFont('Arial','B',6);
      $pdf->Cell(15,5,'TICKET CCC',"TLR",0,'C');
      $pdf->Cell(20,5,'TICKET MP',"TLR",0,'C');
      $pdf->Cell(20,5,'ID BENEFICIARIO',"TLR",0,'C');
      $pdf->Cell(20,5,utf8_decode('FECHA DETECCIÓN'),"TLR",0,'C');
      $pdf->Cell(25,5,utf8_decode('TÉCNICO QUE '),"TLR",0,'C');
      $pdf->Cell(20,5,'TIPO EQUIPO',"TLR",0,'C');
      $pdf->Cell(20,5,'SERIAL',"TLR",0,'C');
      $pdf->Cell(20,5,'MARCA',"TLR",0,'C');
      $pdf->Cell(20,5,'MODELO',"TLR",0,'C');
      $pdf->Cell(20,5,utf8_decode('AREA'),"TLR",0,'C');
      $pdf->Cell(25,5,utf8_decode('DESCRICIÓN DE'),"TLR",0,'C');
      $pdf->Cell(20,5,'TIPO DE FALLA',"TLR",0,'C');
      $pdf->Cell(30,5,'MATERIALES',"TLR",1,'C');

      $pdf->Cell(15,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,utf8_decode('CORRECTIVO'),"BLR",0,'C');
      $pdf->Cell(25,5,utf8_decode('REPORTÓ FALLA '),"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(20,5,utf8_decode('DEL PVD'),"BLR",0,'C');
      $pdf->Cell(25,5,utf8_decode('LA FALLA'),"BLR",0,'C');
      $pdf->Cell(20,5,'',"BLR",0,'C');
      $pdf->Cell(30,5,'PARA SOLUCIONAR',"BLR",1,'C');

      for($i = 0; $i< count($inventory); $i++){
        for($j = 0; $j< count($inventory[$i]['inventario']); $j++){
          if($inventory[$i]['inventario'][$j]['N_ESTADO'] == "Averiado"){
            $info = $this->dao_inventory_model->getModelbiId($inventory[$i]['inventario'][$j]['K_IDMODEL']);
            $corrective = $this->dao_inventory_model->getCorrectiveTicketPerStuff($inventory[$i]['inventario'][$j]['K_IDSTUFF']);
            $sizer = strlen($corrective['N_FAILURE_DESCRIPTION']);
            $sizer2 = strlen($corrective['N_NEW_ELEMENTS']);
            if($sizer > $sizer2){
              $sizer2 = strlen($corrective['N_FAILURE_CLASSIFICATION']);
            }else {
              $sizer = strlen($corrective['N_FAILURE_CLASSIFICATION']);
            }
            if($sizer2 > $sizer){
              $sizer = $sizer2;
            }
            $pdf->Cell(15,5,'',"TLR",0,'C');
            $pdf->Cell(20,5,$_GET['k_ticket'],"TLR",0,'C');
            $pdf->Cell(20,5,$_GET['k_pvd'],"TRL",0,'C');
            $pdf->Cell(20,5,utf8_decode(explode("T", $mysqlDateTime)[0]),"TLR",0,'C');
            $pdf->Cell(25,5,utf8_decode($_POST['nombreTec']),"TLR",0,'C');
            $pdf->Cell(20,5,utf8_decode(substr($info['sc'],0,20)),"TLR",0,'C');
            $pdf->Cell(20,5,$inventory[$i]['inventario'][$j]['N_SERIAL'],"TLR",0,'C');
            $pdf->Cell(20,5,utf8_decode($info['ma']),"TLR",0,'C');
            $pdf->Cell(20,5,utf8_decode($info['mo']),"TLR",0,'C');
            $pdf->Cell(20,5,utf8_decode($inventory[$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']),"TLR",0,'C');
            $pdf->Cell(25,5,utf8_decode(substr($corrective['N_FAILURE_DESCRIPTION'],0,20)),"TLR",0,'C');
            $pdf->Cell(20,5,utf8_decode(substr($corrective['N_FAILURE_CLASSIFICATION'],0,20)),"TLR",0,'C');
            $pdf->Cell(30,5,utf8_decode(substr($corrective['N_NEW_ELEMENTS'],0,20)),"TLR",1,'C');


            for($k = 1; $k<=($sizer/20); $k++){
              $pdf->Cell(15,5,'',"LR",0,'C');
              $pdf->Cell(20,5,'',"LR",0,'C');
              $pdf->Cell(20,5,'',"LR",0,'C');
              $pdf->Cell(20,5,'',"LR",0,'C');
              $pdf->Cell(25,5,'',"LR",0,'C');
              $pdf->Cell(20,5,utf8_decode(substr($info['sc'],($k)*20,20)),"LR",0,'C');
              $pdf->Cell(20,5,'',"LR",0,'C');
              $pdf->Cell(20,5,'',"LR",0,'C');
              $pdf->Cell(20,5,'',"LR",0,'C');
              $pdf->Cell(20,5,'',"LR",0,'C');
              $pdf->Cell(25,5,utf8_decode(substr($corrective['N_FAILURE_DESCRIPTION'],$k*20,20)),"LR",0,'C');
              $pdf->Cell(20,5,utf8_decode(substr($corrective['N_FAILURE_CLASSIFICATION'],$k*20,20)),"LR",0,'C');
              $pdf->Cell(30,5,utf8_decode(substr($corrective['N_NEW_ELEMENTS'],$k*20,20)),"LR",1,'C');
            }

          }
        }
      }
      $pdf->Cell(275,0,'',1,1,'C');
    }

    public function fillHeaderTable($pdf, $pvd, $date){
      //Encabezado
      $pdf->Cell(275,18,'Informe de Mantenimiento Preventivo IT',1,1,'C');
      //Salto de linea
      $pdf->Ln(5);
      $pdf->SetFont('Arial','B',7);
      //Primera linea  de la tabla
      $pdf->Cell(40,5,'ID Beneficiario',1,0,'C');
      $pdf->Cell(30,5,$_GET['k_pvd'],1,0,'C');
      $pdf->Cell(30,5,'Tipo PVD',1,0,'C');
      $pdf->Cell(35,5,$_GET['k_tipo'],1,0,'C');
      $pdf->Cell(20,5,$_GET['k_fase'],1,0,'C');
      $pdf->Cell(30,5,utf8_decode('Región'),1,0,'C');
      $pdf->Cell(90,5,explode("Zona",$pvd->getRegion())[1],1,1,'C');
      //Segunda linea de la tabla
      $pdf->Cell(40,5,'Departamento',1,0,'C');
      $pdf->Cell(95,5,utf8_decode($pvd->getDepartment()),1,0,'C');
      $pdf->Cell(20,5,'Municipio',1,0,'C');
      $pdf->Cell(120,5,utf8_decode($pvd->getCity()),1,1,'C');
      //Tercera linea de la tabla
      $pdf->Cell(40,5,utf8_decode('Dirección'),1,0,'C');
      $pdf->Cell(115,5,utf8_decode($pvd->getDireccion()),1,0,'C');
      $pdf->Cell(30,5,'Fecha',1,0,'C');
      $pdf->Cell(90,5,$date,1,1,'C');
      //Cuarta linea de la tabla
      $pdf->Cell(40,5,'Administrador',1,0,'C');
      $pdf->Cell(95,5,$_POST['nombreAdmin'],1,0,'C');
      $pdf->Cell(20,5,'Correo',1,0,'C');
      $pdf->Cell(120,5,$_POST['correoAdmin'],1,1,'C');
      //Quinta linea de la tabla
      $pdf->Cell(40,5,utf8_decode('Identificación'),1,0,'C');
      $pdf->Cell(95,5,$_POST['cedulaAdmin'],1,0,'C');
      $pdf->Cell(20,5,utf8_decode('Teléfono'),1,0,'C');
      $pdf->Cell(120,5,$_POST['telefonoAdmin'],1,1,'C');
      //Sexta linea de la tablas
      $pdf->Cell(40,5,'Representante del integrador',1,0,'C');
      $pdf->Cell(115,5,$_POST['nombreTec'],1,0,'C');
      $pdf->Cell(30,5,utf8_decode('Identificación'),1,0,'C');
      $pdf->Cell(90,5,$_POST['cedulaTec'],1,1,'C');
    }

    public function fillHeaderTableAA($pdf, $pvd, $date){

      //Encabezado
      $pdf->Cell(190,18,'Informe de Mantenimiento Preventivo AA',1,1,'C');
      //Salto de linea
      $pdf->Ln(5);
      $pdf->SetFont('Arial','B',7);
      //Primera linea  de la tabla
      $pdf->Cell(20,5,'ID Beneficiario',1,0,'C');
      $pdf->Cell(50,5,$_GET['k_pvd'],1,0,'C');
      $pdf->Cell(20,5,'Tipo PVD',1,0,'C');
      $pdf->Cell(20,5,$_GET['k_tipo'],1,0,'C');
      $pdf->Cell(20,5,$_GET['k_fase'],1,0,'C');
      $pdf->Cell(20,5,utf8_decode('Región'),1,0,'C');
      $pdf->Cell(40,5,explode("Zona",$pvd->getRegion())[1],1,1,'C');
      //Segunda linea de la tabla
      $pdf->Cell(20,5,'Departamento',1,0,'C');
      $pdf->Cell(70,5,utf8_decode($pvd->getDepartment()),1,0,'C');
      $pdf->Cell(20,5,'Municipio',1,0,'C');
      $pdf->Cell(80,5,utf8_decode($pvd->getCity()),1,1,'C');
      //Tercera linea de la tabla
      $pdf->Cell(20,5,utf8_decode('Dirección'),1,0,'C');
      $pdf->Cell(90,5,utf8_decode($pvd->getDireccion()),1,0,'C');
      $pdf->Cell(20,5,'Fecha',1,0,'C');
      $pdf->Cell(60,5,$date,1,1,'C');
      //Cuarta linea de la tabla
      $pdf->Cell(20,5,'Administrador',1,0,'C');
      $pdf->Cell(90,5,$_POST['nombreAdmin'],1,0,'C');
      $pdf->Cell(20,5,'Correo',1,0,'C');
      $pdf->Cell(60,5,$_POST['correoAdmin'],1,1,'C');
      //Quinta linea de la tabla
      $pdf->Cell(20,5,utf8_decode('Identificación'),1,0,'C');
      $pdf->Cell(90,5,$_POST['cedulaAdmin'],1,0,'C');
      $pdf->Cell(20,5,utf8_decode('Teléfono'),1,0,'C');
      $pdf->Cell(60,5,$_POST['telefonoAdmin'],1,1,'C');
      //Sexta linea de la tablas
      $pdf->Cell(40,5,'Representante del integrador',1,0,'C');
      $pdf->Cell(70,5,$_POST['nombreTec'],1,0,'C');
      $pdf->Cell(20,5,utf8_decode('Identificación'),1,0,'C');
      $pdf->Cell(60,5,$_POST['cedulaTec'],1,1,'C');
    }
  }
