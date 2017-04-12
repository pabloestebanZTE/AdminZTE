<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MCorrectivos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_ticket_model');
        $this->load->model('data/dao_maintenance_model');
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_PVD_model');
        $this->load->model('user_model');
        $this->load->model('maintenance_model');
        $this->load->model('ticket_model');
    }

    public function formMC(){
      $respuesta['tickets'] = $this->dao_ticket_model->getAllTickets();
      $respuesta['users'] = $this->dao_user_model->getAllUsers();
      $respuesta['pvds'] = $this->dao_PVD_model->getAllPVDs();

    //  print_r(  $respuesta['pvds']);
      $this->load->view('CrearMC', $respuesta);
    }

}

?>
