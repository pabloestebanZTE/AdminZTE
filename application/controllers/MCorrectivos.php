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
      print_r($_POST);
      $idEquipment = $this->dao_equipment_model->insertEquipment($_POST['field6'], $_POST['field7'], $_POST['fieldOtros'], $_POST['field8'],$_POST['field9'],$_POST['field10']);
      $this->dao_MC_model->insertMC($_POST['field1'], explode("/",$_POST['field2'])[1], explode("/",$_POST['field3'])[0], $_POST['field4'], $_POST['field5'],$_POST['field11'],$_POST['field12'],$_POST['field13'], $idEquipment);
    }

}

?>
