<?php

 defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_maintenance_model');
        $this->load->model('data/dao_PVD_model');
        $this->load->model('data/dao_ticket_model');
        $this->load->model('data/dao_user_model');
    }

    public function TicketPrincial(){
      $respuesta['pvds'] = $this->dao_PVD_model->getPVDs();
      $respuesta['users'] = $this->dao_user_model->getAllUsers();
      $this->load->view('ticketCreation', $respuesta);
    }

    public function createTicket(){
      print_r($_POST);
      $date = explode("-",$_POST['date']);
      $newdate = $date[0]."-".$date[1]."-01";
      $pvd = explode("/",$_POST['pvd']);
      $maintenance = new maintenance_model;
      $maintenance = $maintenance->createMaintenance("",$pvd[0],"1",$newdate);
      $idMiantenance = $this->dao_maintenance_model->createMaintenance($maintenance);
      echo $idMiantenance;
      $count = $this->dao_ticket_model->ticketQuantity();
      echo $count;
    }
}

?>
