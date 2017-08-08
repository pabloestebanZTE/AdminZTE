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

    public function crearActaIT(){
      $pvd = $this->dao_PVD_model->getPVDbyId($_GET['k_pvd']);
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

      //Lenar firmas
      $this->fillCCC($pdf);

      //Lenar firmas
      $this->fillSigns($pdf);

      $pdf->Output();
    }

    public function fillCCC($pdf){
      $pdf->Ln(10);
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(275,5,'Estado de PQR',0,1,'C');
      $pdf->Cell(275,5,utf8_decode('Se verificó con el CCC el estado de los tickets abiertos para el punto, y se realiza atención y cierre'),0,1,'C');
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(80,5,utf8_decode('Descripción'),1,0,'C');
      $pdf->Cell(40,5,utf8_decode('Nro. Caso'),1,0,'C');
      $pdf->Cell(40,5,utf8_decode('Estado'),1,0,'C');
      $pdf->Cell(115,5,utf8_decode('Observaciones'),1,1,'C');

      $pdf->Cell(80,5,utf8_decode(''),1,0,'C');
      $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
      $pdf->Cell(40,5,utf8_decode(''),1,0,'C');
      $pdf->Cell(115,5,utf8_decode(''),1,1,'C');
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
      $pdf->Cell(155,5,'ITEM',1,0,'C');
      $pdf->Cell(30,5,'CANTIDAD TIPOLOGIA',1,0,'C');
      $pdf->Cell(30,5,'EN INVENTARIO',1,0,'C');
      $pdf->Cell(30,5,'EN CORRECTIVO',1,0,'C');
      $pdf->Cell(30,5,'NO ENCONTRADO',1,1,'C');
      $pdf->SetFont('Arial','',7);

      for ($i = 0; $i < count($inventory); $i++){
        $pdf->Cell(155,5,utf8_decode($inventory[$i]['N_NAME']),1,0,'C');
        $pdf->Cell(30,5,$inventory[$i]['I_QUANTITY'],1,0,'C');
        $pdf->Cell(30,5,$inventory[$i]['funcional'],1,0,'C');
        $pdf->Cell(30,5,$inventory[$i]['averiado'],1,0,'C');
        $pdf->Cell(30,5,$inventory[$i]['NE'],1,1,'C');
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

    public function fillCorrectiveTable($pdf, $inventory){
      //Titulo
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(275,5,'ESTADO GENERAL DEL PVD Y FALLAS ENCONTRADAS',0,1,'C');
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(275,5,utf8_decode('El PVD se encuentra en funcionamiento de manera correcta en todos sus sistemas excepto en los siguientes componentes los cuales se relacionan a continuación y que serán escalados a interventoria y FONADE para su aprobación de solución'),0,1,'C');
      //Header Tabla
      $pdf->SetFont('Arial','B',6);
      $pdf->Cell(15,5,'TICKET CCC',1,0,'C');
      $pdf->Cell(20,5,'TICKET MP',1,0,'C');
      $pdf->Cell(20,5,'ID BENEFICIARIO',1,0,'C');
      $pdf->Cell(20,5,utf8_decode('FECHA DETECCIÓN'),1,0,'C');
      $pdf->Cell(25,5,utf8_decode('TÉCNICO QUE '),1,0,'C');
      $pdf->Cell(20,5,'TIPO EQUIPO',1,0,'C');
      $pdf->Cell(20,5,'SERIAL',1,0,'C');
      $pdf->Cell(20,5,'MARCA',1,0,'C');
      $pdf->Cell(20,5,'MODELO',1,0,'C');
      $pdf->Cell(20,5,utf8_decode('AREA'),1,0,'C');
      $pdf->Cell(25,5,utf8_decode('DESCRICIÓN DE'),1,0,'C');
      $pdf->Cell(20,5,'TIPO DE FALLA',1,0,'C');
      $pdf->Cell(30,5,'MATERIALES',1,1,'C');

      $pdf->Cell(15,5,'',1,0,'C');
      $pdf->Cell(20,5,'',1,0,'C');
      $pdf->Cell(20,5,'',1,0,'C');
      $pdf->Cell(20,5,utf8_decode('CORRECTIVO'),1,0,'C');
      $pdf->Cell(25,5,utf8_decode('REPORTÓ FALLA '),1,0,'C');
      $pdf->Cell(20,5,'',1,0,'C');
      $pdf->Cell(20,5,'',1,0,'C');
      $pdf->Cell(20,5,'',1,0,'C');
      $pdf->Cell(20,5,'',1,0,'C');
      $pdf->Cell(20,5,utf8_decode('DEL PVD'),1,0,'C');
      $pdf->Cell(25,5,utf8_decode('LA FALLA'),1,0,'C');
      $pdf->Cell(20,5,'',1,0,'C');
      $pdf->Cell(30,5,'PARA SOLUCIONAR',1,1,'C');

      for($i = 0; $i< count($inventory); $i++){
        for($j = 0; $j< count($inventory[$i]['inventario']); $j++){
          if($inventory[$i]['inventario'][$j]['N_ESTADO'] == "Averiado"){
            $pdf->Cell(15,5,'',1,0,'C');
            $pdf->Cell(20,5,$_GET['k_ticket'],1,0,'C');
            $pdf->Cell(20,5,'',1,0,'C');
            $pdf->Cell(20,5,utf8_decode(''),1,0,'C');
            $pdf->Cell(25,5,utf8_decode(''),1,0,'C');
            $pdf->Cell(20,5,'',1,0,'C');
            $pdf->Cell(20,5,$inventory[$i]['inventario'][$j]['N_SERIAL'],1,0,'C');
            $pdf->Cell(20,5,'',1,0,'C');
            $pdf->Cell(20,5,'',1,0,'C');
            $pdf->Cell(20,5,$inventory[$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME'],1,0,'C');
            $pdf->Cell(25,5,'',1,0,'C');
            $pdf->Cell(20,5,'',1,0,'C');
            $pdf->Cell(30,5,'',1,1,'C');
          }
        }
      }
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

}
