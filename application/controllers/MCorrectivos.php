<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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

    public function formMC(){
      $respuesta['tickets'] = $this->dao_ticket_model->getAllTickets();
      $respuesta['users'] = $this->dao_user_model->getAllUsers();
      $respuesta['places'] = $this->dao_PVD_model->getAllPlaces();
      $respuesta['pvds'] = $this->dao_PVD_model->getAllPVDs();
      $respuesta['categoriaE'] = $this->dao_equipment_model->getAllCategories();
      $respuesta['categoriaE'] = $this->dao_equipment_model->getAllTypeEquipment($respuesta['categoriaE']);
      $respuesta['daños'] = $this->dao_equipment_model->getAllDamages();
      $this->load->view('CrearMC', $respuesta);
    }

    public function crearMC(){
      $equipment = new equipment_model;
      $maintenaceC = new correctiveM_model;
      $equipment = $equipment->createEquipment("", $_POST['field6'], $_POST['field7'], $_POST['fieldOtros'], $_POST['field8'],$_POST['field9'],$_POST['field10']);
      $idEquipment = $this->dao_equipment_model->insertEquipment($equipment);
      $maintenaceC = $maintenaceC->createMaintenance("", $_POST['field1'], explode("/",$_POST['field2'])[1], explode("/",$_POST['field3'])[0],$_POST['field4'], $_POST['field5'],$_POST['field11'],$idEquipment,$_POST['field12'],$_POST['field13']);
      $this->dao_MC_model->insertMC($maintenaceC);
      $respuesta['mc'] = $this->dao_MC_model->getAllMC();
      $respuesta['usuariosMC'] = $this->dao_MC_model->getAllUsersMC();
      print_r($respuesta['usuariosMC']);
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

}

?>
