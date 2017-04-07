<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_PVD_model extends CI_Model{

        public function __construct(){
            $this->load->model('pvd_model');
            $this->load->model('data/configdb_model');
        }

        public function getPVDs(){

            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM PVD;";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $i = 0;
                while($row = $result->fetch_assoc()) {
                  $sql2 = "SELECT region.N_NAME as rn, department.N_NAME as dn, city.N_NAME as cn FROM pvd, city, department, region where pvd.K_IDCITY = city.K_IDCITY and city.K_IDDEPARTMENT = department.K_IDDEPARTMENT and department.K_IDREGION = region.K_IDREGION and pvd.K_IDPVD =".$row['K_IDPVD']." ORDER BY region.N_NAME;";
                  $result2 = $session->query($sql2);
                  if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();
                    $PVD = new PVD_model();
                    $PVD = $PVD->createPVD($row['K_IDPVD'], $row2['cn'], $row2['dn'], $row2['rn'], $row['N_DIRECCION'], $row['N_FASE]'], $row['N_TIPOLOGIA']);
                    $respuesta[$i] = $PVD;
                    $i++;
                  }
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
