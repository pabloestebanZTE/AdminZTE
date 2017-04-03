<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_ticket_model extends CI_Model{

        public function __construct(){
            $this->load->model('ticket_model');
            $this->load->model('data/configdb_model');
        }

        public function getTicketsPerMaintenance($id){

            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM ticket where K_IDMAINTENANCE = ".$id.";";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $ticket = new ticket_model();
                    $sql2 = "SELECT n_name from ticket_status where K_IDSTATUSTICKET = ".$row['K_IDSTATUSTICKET'].";";
                    $result2 = $session->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $ticket = $ticket->createTicket($row['ID_TICKET'], $row['K_IDMAINTENANCE'], $row2['n_name'], $row['D_STARTDATE'], $row['D_FINISHDATE'], $row['I_DURATION']);
                    $respuesta[$i] = $ticket;
                    $i++;
                }
              } else {
                $respuesta = "No Ticket";
              }
            }
            else {
              $respuesta = "Error de informacion";
            }
              //  $db->Connection->closeSession($session);
            return $respuesta;
            }

            public function getTicketByID($id){
              $dbConnection = new configdb_model();
              $session = $dbConnection->openSession();
              $sql = "SELECT * FROM ticket where ID_TICKET = '".$id."';";
              if ($session != "false"){
                $result = $session->query($sql);
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $ticket = new ticket_model();
                  $sql2 = "SELECT n_name from ticket_status where K_IDSTATUSTICKET = ".$row['K_IDSTATUSTICKET'].";";
                  $result2 = $session->query($sql2);
                  $row2 = $result2->fetch_assoc();
                  $ticket = $ticket->createTicket($row['ID_TICKET'], $row['K_IDMAINTENANCE'], $row2['n_name'], $row['D_STARTDATE'], $row['D_FINISHDATE'], $row['I_DURATION']);
                  $respuesta = $ticket;
                } else {
                  $respuesta = "No ticket";
                  }
              } else {
                $respuesta = "Error en BD";
              }
              return $respuesta;
            }

            public function insertTicket($ticket, $tipo){
              $dbConnection = new configdb_model();
              $session = $dbConnection->openSession();
              $sql = "SELECT K_IDSTATUSTICKET from ticket_status where N_NAME = '".$ticket->getStatus()."';";
              $result = $session->query($sql);
              $row = $result->fetch_assoc();

             if ($tipo == "Cerrado"){
                $sql = "insert into TICKET (ID_TICKET, K_IDMAINTENANCE, K_IDSTATUSTICKET, D_STARTDATE, D_FINISHDATE, I_DURATION)
                  values ('".$ticket->getId()."',".$ticket->getIdM().",".$row['K_IDSTATUSTICKET'].",STR_TO_DATE('".$ticket->getDateS()."', '%Y-%m-%d'),STR_TO_DATE('".$ticket->getDateF()."', '%Y-%m-%d'),".$ticket->getDuracion().");";
              } else {
                $sql = "insert into TICKET (ID_TICKET, K_IDMAINTENANCE, K_IDSTATUSTICKET, D_STARTDATE)
                  values ('".$ticket->getId()."',".$ticket->getIdM().",".$row['K_IDSTATUSTICKET'].",STR_TO_DATE('".$ticket->getDateS()."', '%Y-%m-%d'));";
              }
              $session->query($sql);
            }

            public function updateTicket($ticket, $tipo){
              $dbConnection = new configdb_model();
              $session = $dbConnection->openSession();
              $sql = "SELECT K_IDSTATUSTICKET from ticket_status where N_NAME = '".$ticket->getStatus()."';";
              $result = $session->query($sql);
              $row = $result->fetch_assoc();

             if ($tipo == "Cerrado"){
                $sql = "UPDATE ticket SET K_IDSTATUSTICKET=".$row['K_IDSTATUSTICKET'].", D_STARTDATE = STR_TO_DATE('".$ticket->getDateS()."', '%Y-%m-%d'), D_FINISHDATE= STR_TO_DATE('".$ticket->getDateF()."', '%Y-%m-%d'), I_DURATION=".$ticket->getDuracion()." WHERE ID_TICKET='".$ticket->getId()."';";
             } else {
                $sql = "UPDATE ticket SET D_STARTDATE = STR_TO_DATE('".$ticket->getDateS()."', '%Y-%m-%d')"." WHERE ID_TICKET='".$ticket->getId()."';";
             }
            $session->query($sql);
            }
        }
?>
