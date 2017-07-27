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
      $inventory = $this->dao_inventory_model->getEquipmentTypePVD($_GET['k_fase'], $_GET['k_tipo'], $_GET['k_pvd']);

      $timezone = date_default_timezone_get();
      $date = date('m/d/Y', time());

      $pdf=new FPDF('L','mm','A4');
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',9);

      //LLenar header
      $this->fillHeaderTable($pdf, $pvd, $date);

      //Texto de compromiso
      $pdf->Ln(5);
      $pdf->SetFont('Arial','',6);
      $pdf->Cell(275,5,utf8_decode('Yo _________________________, identificado con C.C. No. __________ de ___________, actuando como Administrador PVD _____ certifico que ________________, identificado con C.C. __________ de _____________ en representación del Consorcio Integradores 2018'),0,1,'C');
      $pdf->Cell(275,5,utf8_decode('bajo el contrato suscrito con Fonade, se presentó al Punto Vive Digital con el objetivo de realizar mantenimiento preventivo'),0,1,'C');
      $pdf->Ln(5);
      $pdf->Cell(275,5,utf8_decode('El resultado del mantenimiento se describe a continuación:'),0,1,'L');

      //Llenar tabla de correctivos
      $this->fillCorrectiveTable($pdf, $inventory);


      $pdf->Output();
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
      $pdf->Cell(275,5,'Informe de Mantenimiento Preventivo IT',1,1,'C');
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
      $pdf->Cell(95,5,'',1,0,'C');
      $pdf->Cell(20,5,'Correo',1,0,'C');
      $pdf->Cell(120,5,'',1,1,'C');
      //Quinta linea de la tabla
      $pdf->Cell(40,5,utf8_decode('Identificación'),1,0,'C');
      $pdf->Cell(95,5,'',1,0,'C');
      $pdf->Cell(20,5,utf8_decode('Teléfono'),1,0,'C');
      $pdf->Cell(120,5,'',1,1,'C');
      //Sexta linea de la tablas
      $pdf->Cell(40,5,'Representante del integrador',1,0,'C');
      $pdf->Cell(115,5,'',1,0,'C');
      $pdf->Cell(30,5,utf8_decode('Identificación'),1,0,'C');
      $pdf->Cell(90,5,'',1,1,'C');
    }

}
