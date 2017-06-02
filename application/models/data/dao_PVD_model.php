<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
//    session_start();
    class dao_PVD_model extends CI_Model{
        public function __construct(){
            $this->load->model('pvd_model');
            $this->load->model('data/configdb_model');
        }

        public function getPVDbyId($id){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "SELECT PVD.K_IDPVD, PVD.K_IDCITY, PVD.K_IDEJECUTOR, PVD.K_IDADMIN, PVD.N_NAME, PVD.N_DIRECCION, PVD.N_TIPOLOGIA, PVD.N_FASE, REGION.N_NAME FROM PVD, CITY, DEPARTMENT, REGION WHERE PVD.K_IDPVD = '".$id."' and  PVD.K_IDCITY = CITY.K_IDCITY and CITY.K_IDDEPARTMENT = DEPARTMENT.K_IDDEPARTMENT and DEPARTMENT.K_IDREGION = REGION.K_IDREGION ORDER BY REGION.N_NAME, DEPARTMENT.N_NAME, CITY.N_NAME;";
          if ($session != "false"){
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $sql2 = "SELECT REGION.N_NAME as rn, DEPARTMENT.N_NAME as dn, CITY.N_NAME as cn FROM PVD, CITY, DEPARTMENT, REGION where PVD.K_IDCITY = CITY.K_IDCITY and CITY.K_IDDEPARTMENT = DEPARTMENT.K_IDDEPARTMENT and DEPARTMENT.K_IDREGION = REGION.K_IDREGION and PVD.K_IDPVD =".$row['K_IDPVD'].";";
              $result2 = $session->query($sql2);
              if ($result2->num_rows > 0) {
                $row2 = $result2->fetch_assoc();
                $PVD = new PVD_model();
                $PVD = $PVD->createPVD($row['K_IDPVD'], $row2['cn'], $row2['dn'], $row2['rn'], $row['N_DIRECCION'], $row['N_FASE]'], $row['N_TIPOLOGIA']);
                $respuesta = $PVD;
              }
            }
          } else {
            $respuesta = "Error de informacion";
          }
          return $respuesta;
        }

        public function getPVDs(){
            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT PVD.K_IDPVD, PVD.K_IDCITY, PVD.K_IDEJECUTOR, PVD.K_IDADMIN, PVD.N_NAME, PVD.N_DIRECCION, PVD.N_TIPOLOGIA, PVD.N_FASE, REGION.N_NAME FROM PVD, CITY, DEPARTMENT, REGION WHERE PVD.K_IDCITY = CITY.K_IDCITY and CITY.K_IDDEPARTMENT = DEPARTMENT.K_IDDEPARTMENT and DEPARTMENT.K_IDREGION = REGION.K_IDREGION ORDER BY REGION.N_NAME, DEPARTMENT.N_NAME, CITY.N_NAME;";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $i = 0;
                while($row = $result->fetch_assoc()) {
                  $sql2 = "SELECT REGION.N_NAME as rn, DEPARTMENT.N_NAME as dn, CITY.N_NAME as cn FROM PVD, CITY, DEPARTMENT, REGION where PVD.K_IDCITY = CITY.K_IDCITY and CITY.K_IDDEPARTMENT = DEPARTMENT.K_IDDEPARTMENT and DEPARTMENT.K_IDREGION = REGION.K_IDREGION and PVD.K_IDPVD =".$row['K_IDPVD'].";";
                  $result2 = $session->query($sql2);
                  if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();
                    $PVD = new PVD_model();
                    $PVD = $PVD->createPVD($row['K_IDPVD'], $row2['cn'], $row2['dn'], $row2['rn'], $row['N_DIRECCION'], $row['N_FASE]'], $row['N_TIPOLOGIA']);
                    $sql3 = "SELECT * from admin_pvd where K_IDADMIN =". $row['K_IDADMIN'].";";
                    $result3 = $session->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $PVD->setAdmin($row3);
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

        public function getAllPlaces(){
          $zones = $this->getPVDZone();
          $place = $this->getPVDPlace();
          for ($i = 0; $i<count($place); $i++){
            for ($j = 0; $j<count($zones); $j++){
              if ($zones[$j]['id'] == $place[$i]['idZONE']){
                $place[$i]['id'] = $zones[$j];
              }
            }
          }
          return $place;
        }

        public function getAllPVDs(){
            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM pvd;";

            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $i = 0;
                while($row = $result->fetch_assoc()) {
                  $PVD = new PVD_model();
                  $PVD = $PVD->createPVD($row['K_IDPVD'],"", "", "", "", "", $row['N_TIPOLOGIA']);
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

          public function getPVDZone(){
            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM pvd_zone;";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $i = 0;
                while($row = $result->fetch_assoc()) {
                  $respuesta[$i]['id'] = $row['K_IDPVDZONE'];
                  $respuesta[$i]['name'] = $row['N_NAME'];
                  $i++;
                }
              }
            }
            return $respuesta;
          }

          public function getPVDPlace(){
            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM pvd_place;";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $i = 0;
                while($row = $result->fetch_assoc()) {
                  $respuesta[$i]['idTIPO'] = $row['K_IDPVDT'];
                  $respuesta[$i]['idZONE'] = $row['K_IDPVDZONE'];
                  $i++;
                }
              }
            }
            return $respuesta;
          }

          public function getPVDZoneById($id){
            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM pvd_zone where K_IDPVDZONE = ".$id.";";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $respuesta['id'] = $row['K_IDPVDZONE'];
                $respuesta['nombre'] = $row['N_NAME'];
              }
            }
            return $respuesta;
          }
        }
?>
