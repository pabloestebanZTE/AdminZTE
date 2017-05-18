<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include 'PHPExcel-1.8/Classes/PHPExcel.php';       // include the class

class MCorrectivos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_ticket_model');
        $this->load->model('data/dao_maintenance_model');
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_MC_model');
        $this->load->model('data/dao_equipment_model');
        $this->load->model('data/dao_PVD_model');
        $this->load->model('user_model');
        $this->load->model('maintenance_model');
        $this->load->model('equipment_model');
        $this->load->model('correctiveM_model');
        $this->load->model('ticket_model');
    }

    public function verMC(){
      $respuesta['mc'] = $this->dao_MC_model->getAllMC();
      $respuesta['usuariosMC'] = $this->dao_MC_model->getAllUsersMC();
      $respuesta['titulosMCResumen'] = $this->crearTitulos();
      $this->defineDates($respuesta['mc']);

      $this->load->view('verMC', $respuesta);
    }

    public function formMC(){
      $respuesta['tickets'] = $this->dao_ticket_model->getAllTickets();
      $respuesta['users'] = $this->dao_user_model->getAllUsers();
      $respuesta['places'] = $this->dao_PVD_model->getAllPlaces();
      $respuesta['pvds'] = $this->dao_PVD_model->getAllPVDs();
      $respuesta['categoriaE'] = $this->dao_equipment_model->getAllCategories();
      $respuesta['categoriaE'] = $this->dao_equipment_model->getAllTypeEquipment($respuesta['categoriaE']);
      $respuesta['categoriaE'] = $this->dao_equipment_model->getAllTypeEquipment2($respuesta['categoriaE']);
      $respuesta['daños'] = $this->dao_equipment_model->getAllDamages();
      $this->load->view('CrearMC', $respuesta);
    }

    public function crearMC(){
      $equipment = new equipment_model;
      $maintenaceC = new correctiveM_model;
      $equipment = $equipment->createEquipment("", $_POST['field6'], "", $_POST['field14'], $_POST['fieldOtros'], $_POST['field8'],$_POST['field9'],$_POST['field10']);
      $idEquipment = $this->dao_equipment_model->insertEquipment($equipment);
      date_default_timezone_set('America/Bogota');
      $date = date('m/d/Y', time());
      $maintenaceC = $maintenaceC->createMaintenance("", $_POST['field1'], explode("/",$_POST['field2'])[1], explode("/",$_POST['field3'])[0],$_POST['field4'], $_POST['field5'],$_POST['field11'],$idEquipment,$_POST['field12'],$_POST['field13'],$date,"",4);
      $this->dao_MC_model->insertMC($maintenaceC);
      $respuesta['mc'] = $this->dao_MC_model->getAllMC();
      $respuesta['usuariosMC'] = $this->dao_MC_model->getAllUsersMC();
      $respuesta['titulosMCResumen'] = $this->crearTitulos();
      $this->load->view('verMC', $respuesta);
    }

    public function crearTitulos(){
        $tituloResumen[0] = "ID";
        $tituloResumen[1] = "PVD";
        $tituloResumen[2] = "Región";
        $tituloResumen[3] = "Ticket";
        $tituloResumen[4] = "Fecha inicio";
        $tituloResumen[5] = "Técnico";
      return $tituloResumen;
    }

    public function exportXL(){
      $objPHPExcel = new PHPExcel();
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'Ticket CC');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'Ticket Aranda');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, 'PVD');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, 'Fase');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, 'Region');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, 'Departamento');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 1, 'Municipio');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 1, 'Direccion PVD');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Tipologia');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 1, 'Ticket MP');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, 1, 'Fecha Inicio MP');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, 1, 'Mes Inicio MP');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, 1, 'Técnico');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, 1, 'Cantidad Equipos');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, 1, 'Categoria Equipo');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, 1, 'Subcategoria1 ');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, 1, 'Subcategoria2 ');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, 1, 'Serial');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, 1, 'Marca');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, 1, 'Ubicacion dentro del PVD');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, 1, 'Diagnostico Técnico');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, 1, 'Observaciones Diagnostico');
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, 1, 'Estado');

      $MC = $this->dao_MC_model->getAllMC();
      for($i = 0; $i<count($MC); $i++){
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i+2, $MC[$i]->getPVD()->getId());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i+2, $MC[$i]->getPVD()->getFase());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i+2, $MC[$i]->getPVD()->getRegion());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i+2, $MC[$i]->getPVD()->getDepartment());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i+2, $MC[$i]->getPVD()->getCity());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i+2, $MC[$i]->getPVD()->getDireccion());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i+2, $MC[$i]->getPVD()->getTipologia());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i+2, $MC[$i]->getTicket());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $i+2, $MC[$i]->getUser()->getName()." ". $MC[$i]->getUser()->getLastname());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $i+2, $MC[$i]->getQuantity());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $i+2, $MC[$i]->getEquipment()->getCategoria()['N_NAME']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $i+2, $MC[$i]->getEquipment()->getTipo1()['N_NAME']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $i+2, $MC[$i]->getEquipment()->getTipo2()['N_NAME']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $i+2, $MC[$i]->getEquipment()->getSerial());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $i+2, $MC[$i]->getEquipment()->getMarca());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $i+2, "Area de ".$MC[$i]->getPlace()['nombre']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $i+2, $MC[$i]->getDescription());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $i+2, $MC[$i]->getStuff());
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, $i+2, $MC[$i]->getStatus()['N_NAME']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('MC');
      $callStartTime = microtime(true);
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
      $callEndTime = microtime(true);
      $callTime = $callEndTime - $callStartTime;
      $respuesta['mc'] = $MC;
      $respuesta['usuariosMC'] = $this->dao_MC_model->getAllUsersMC();
      $respuesta['titulosMCResumen'] = $this->crearTitulos();
      $this->load->view('verMC', $respuesta);
    }

    public function defineDates($MC){
      $months = array(0 => 0, 1  => 0, 2  => 0, 3  => 0, 4  => 0, 5  => 0, 6  => 0, 7  => 0, 8  => 0, 9  => 0, 10  => 0, 11  => 0, 12  => 0);
      $years[0] = 2017;
      $years[1] = 2018;
      $years[2] = $months;
      $years[3] = $months;

      for ($i = 0; $i < count($MC); $i++){
        $date = $MC[$i]->getSDate();
        $data = explode("-",$date);
        for($j = 0; $j < count($years)/2;$j++){
          if($data[0] == $years[$j]){
            for($k = 0; $k < (count($years)/2)+$j; $k++){

            }
          }
        }
      }

    }

}

?>
