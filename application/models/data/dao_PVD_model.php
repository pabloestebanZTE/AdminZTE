<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_PVD_model extends CI_Model{

        public function __construct(){
            $this->load->model('pvd_model');
            $this->load->model('data/configdb_model');
        }

        public function getAllPVDs(){

            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM PVD;";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $i = 0;
                while($row = $result->fetch_assoc()) {
                  $PVD = new PVD_model();
                  $PVD = $PVD->createPVD($row['K_IDPVD'],"", "", "", "", "", "");
                  $respuesta[$i] = $PVD;
                  $i++;
                }
              }
            } else {
              $respuesta = "Error de informacion";
            }
              //  $db->Connection->closeSession($session);
                return $respuesta;
          }


        }
?>
