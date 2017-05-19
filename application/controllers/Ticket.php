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

    public function TicketPrincial(){
      $respuesta['pvds'] = $this->dao_PVD_model->getPVDs();
      $respuesta['users'] = $this->dao_user_model->getAllUsers();
      $respuesta['msj'] = $GLOBALS['$msj'];
      $this->load->view('ticketCreation', $respuesta);
    }

    public function createTicketMP(){
      $date = explode("-",$_POST['date']);
      $newdate = $date[0]."-".$date[1]."-01";
      $pvd = explode("/",$_POST['pvd']);
      $maintenance = new maintenance_model;
      $maintenance = $maintenance->createMaintenance("",$pvd[0],"1",$newdate);
      $idMiantenance = $this->dao_maintenance_model->createMaintenance($maintenance);
      if($idMiantenance != "No existe mantenimiento" && $idMiantenance != "Error de informacion"){
        $count = $this->dao_ticket_model->ticketQuantity();
        for($i = strlen($count); $i <5; $i++){
          $count = "0".$count;
        }
        $idNewTicket = "TPM-".$pvd[0]."-".$count;
        $ticket = new ticket_model;
        $ticket = $ticket->createTicket($idNewTicket, $idMiantenance, "Abierto", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $this->dao_ticket_model->insertTicket($ticket, 1);
        $id = $this->dao_ticket_model->getTicketByID($idNewTicket);
        if($id != "No ticket" && $id != "Error en BD"){
          if($_POST['TIT'] != -1){
            $this->dao_ticket_model->insertTech($ticket->getId(), explode("/",$_POST['TIT'])[1], "IT-T");
          }
          if($_POST['AIT'] != -1){
            $this->dao_ticket_model->insertTech($ticket->getId(), explode("/",$_POST['AIT'])[1], "IT-A");
          }
          if($_POST['TAA'] != -1){
            $this->dao_ticket_model->insertTech($ticket->getId(), explode("/",$_POST['TAA'])[1], "AA-T");
          }
          if($_POST['AAA'] != -1){
            $this->dao_ticket_model->insertTech($ticket->getId(), explode("/",$_POST['AAA'])[1], "AA-A");
          }
          $GLOBALS['$msj'][0] = "Ticket Creado";
          $GLOBALS['$msj'][1] = "Ticket ID: ".$ticket->getId();
          $GLOBALS['$msj'][2] = "success";
        } else {
          $GLOBALS['$msj'][0] = "Algo salio mal";
          $GLOBALS['$msj'][1] = "Contacte al administrador del servicio";
          $GLOBALS['$msj'][2] = "error";
        }
      } else {
        $GLOBALS['$msj'][0] = "Algo salio mal";
        $GLOBALS['$msj'][1] = "Contacte al administrador del servicio";
        $GLOBALS['$msj'][2] = "error";
      }

      $this->TicketPrincial();
      //  if()
    }
}

?>
