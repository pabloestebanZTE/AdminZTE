<?php

 defined('BASEPATH') OR exit('No direct script access allowed');
 $msj = "";
class Ticket extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_maintenance_model');
        $this->load->model('data/dao_PVD_model');
        $this->load->model('data/dao_ticket_model');
        $this->load->model('data/dao_user_model');
    }

    public function TicketPrincipal(){
      $this->load->view('ticketsPrincipal');
    }

    public function TicketCreation(){
        $respuesta['pvds'] = $this->dao_PVD_model->getPVDs();
        $respuesta['users'] = $this->dao_user_model->getAllUsers();
        $respuesta['msj'] = $GLOBALS['$msj'];
        $this->load->view('ticketCreation', $respuesta);
    }

    public function ticketDetails(){
      $respuesta['ticket'] = $this->dao_ticket_model->getTicketByID($_GET['k_ticket']);
      $respuesta['maintenance'] = $this->dao_maintenance_model->getManPrePerID($respuesta['ticket']->getIdM());
      $respuesta['PVD'] = $this->dao_PVD_model->getPVDbyId($respuesta['maintenance']->getIdPVD());
      $this->load->view('ticketDetail', $respuesta);
    }

}

?>
