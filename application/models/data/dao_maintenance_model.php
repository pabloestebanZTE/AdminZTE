<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_maintenance_model extends CI_Model{

        public function __construct(){
            $this->load->model('maintenance_model');
            $this->load->model('data/configdb_model');
        }

        public function getManPrePerPVD($id){

            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM maintenance where K_IDMAINTENANCET = 1 and K_IDPVD = ".$id.";";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $i = 0;
                while($row = $result->fetch_assoc()) {
                    $maintenance = new maintenance_model();
                    $maintenance = $maintenance->createMaintenance($row['K_IDMAINTENANCE'], $row['K_IDPVD'], "Preventivo", $row['D_STARTDATE']);
                    $respuesta[$i] = $maintenance;
                    $i++;
                }
              }
            }
            else {
              $respuesta = "Error de informacion";
            }
              //  $db->Connection->closeSession($session);
            return $respuesta;
            }

            public function getManPrePerID($id){
              $dbConnection = new configdb_model();
              $session = $dbConnection->openSession();
              $sql = "SELECT * FROM maintenance where K_IDMAINTENANCE = ".$id.";";
              if ($session != "false"){
                $result = $session->query($sql);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $maintenance = new maintenance_model();
                      $maintenance = $maintenance->createMaintenance($row['K_IDMAINTENANCE'], $row['K_IDPVD'], "Preventivo", $row['D_STARTDATE']);
                      $respuesta = $maintenance;
                  }
                } else {
                    $respuesta = "No existe mantenimiento";
                }
              } else {
                $respuesta = "Error de informacion";
              }
              return $respuesta;
            }

            public function updateDateManPre($id, $newdate){
              $dbConnection = new configdb_model();
              $session = $dbConnection->openSession();
              $sql = "UPDATE maintenance SET D_STARTDATE = STR_TO_DATE('".$newdate."', '%Y-%m-%d') where K_IDMAINTENANCE = ".$id.";";
              if ($session != "false"){
                $result = $session->query($sql);
              } else {
                $respuesta = "No se pudo actualizar";
              }
            }
        }
?>
