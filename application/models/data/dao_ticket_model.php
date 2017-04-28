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
                    $sql2 = "SELECT n_name from TICKET_STATUS where K_IDSTATUSTICKET = ".$row['K_IDSTATUSTICKET'].";";
                    $result2 = $session->query($sql2);
                    $row2 = $result2->fetch_assoc();

                    $sql3 = "SELECT * FROM ticket_user where K_IDTICKET = '".$row['K_IDTICKET']."';";
                    $result3 = $session->query($sql3);
                    while($row3 = $result3->fetch_assoc()) {
                      $sql4 = "SELECT N_NAME, N_LASTNAME, K_IDUSER FROM user where K_IDUSER = ".$row3['K_IDUSER'].";";
                      $result4 = $session->query($sql4);
                      $row4 = $result4->fetch_assoc();
                      $tipoTech = explode("-",$row3['N_TYPE']);
                      if($tipoTech[0] == "IT"){
                        if ($tipoTech[1] == "T"){
                          $users['users']['IT_T'] = $row4;
                        } else {
                          $users['users']['IT_A'] = $row4;
                        }
                      } else {
                        if ($tipoTech[1] == "T"){
                          $users['users']['AA_T'] = $row4;
                        } else {
                          $users['users']['AA_A'] = $row4;
                        }
                      }
                    }
                    $ticket = $ticket->createTicket($row['K_IDTICKET'], $row['K_IDMAINTENANCE'], $row2['n_name'], $row['D_STARTDATE'], $row['D_FINISHDATE'], $row['I_DURATION'], $row['D_STARTDATEIT'], $row['D_FINISHDATEIT'], $row['D_STARTDATEAA'], $row['D_FINISHDATEAA'], $users, $row['N_COLOR']);
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
              $sql = "SELECT * FROM ticket where K_IDTICKET = '".$id."';";
              if ($session != "false"){
                $result = $session->query($sql);
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $ticket = new ticket_model();
                  $sql2 = "SELECT n_name from TICKET_STATUS where K_IDSTATUSTICKET = ".$row['K_IDSTATUSTICKET'].";";
                  $result2 = $session->query($sql2);
                  $row2 = $result2->fetch_assoc();
                  $ticket = $ticket->createTicket($row['K_IDTICKET'], $row['K_IDMAINTENANCE'], $row2['n_name'], $row['D_STARTDATE'], $row['D_FINISHDATE'], $row['I_DURATION']);
                  $respuesta = $ticket;
                } else {
                  $respuesta = "No ticket";
                  }
              } else {
                $respuesta = "Error en BD";
              }
              return $respuesta;
            }

            public function getAllTickets(){
              $dbConnection = new configdb_model();
              $session = $dbConnection->openSession();
              $sql = "SELECT * FROM ticket;";
              if ($session != "false"){
                $result = $session->query($sql);
                if ($result->num_rows > 0) {
                  $i = 0;
                  while($row = $result->fetch_assoc()) {
                      $ticket = new ticket_model();
                      $sql2 = "SELECT n_name from TICKET_STATUS where K_IDSTATUSTICKET = ".$row['K_IDSTATUSTICKET'].";";
                      $result2 = $session->query($sql2);
                      $row2 = $result2->fetch_assoc();
                      $ticket = $ticket->createTicket($row['K_IDTICKET'], $row['K_IDMAINTENANCE'], $row2['n_name'], $row['D_STARTDATE'], $row['D_FINISHDATE'], $row['I_DURATION']);
                      $respuesta[$i] = $ticket;
                      $i++;
                  }
                } else {
                  $respuesta = "No tickets";
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

             if ($tipo == "Ejecutado"){
                $sql = "insert into TICKET (K_IDTICKET, K_IDMAINTENANCE, K_IDSTATUSTICKET, D_STARTDATE, D_FINISHDATE, I_DURATION)
                  values ('".$ticket->getId()."',".$ticket->getIdM().",".$row['K_IDSTATUSTICKET'].",STR_TO_DATE('".$ticket->getDateS()."', '%Y-%m-%d'),STR_TO_DATE('".$ticket->getDateF()."', '%Y-%m-%d'),".$ticket->getDuracion().");";
              } else {
                $sql = "insert into TICKET (K_IDTICKET, K_IDMAINTENANCE, K_IDSTATUSTICKET, D_STARTDATE)
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

             if ($tipo == "Ejecutado"){
                $sql = "UPDATE TICKET SET K_IDSTATUSTICKET=".$row['K_IDSTATUSTICKET'].", D_STARTDATE = STR_TO_DATE('".$ticket->getDateS()."', '%Y-%m-%d'), D_FINISHDATE= STR_TO_DATE('".$ticket->getDateF()."', '%Y-%m-%d'), I_DURATION=".$ticket->getDuracion()." WHERE K_IDTICKET='".$ticket->getId()."';";
             } else {
                $sql = "UPDATE TICKET SET D_STARTDATE = STR_TO_DATE('".$ticket->getDateS()."', '%Y-%m-%d')"." WHERE K_IDTICKET='".$ticket->getId()."';";
             }
            $session->query($sql);
            }
        }
?>
