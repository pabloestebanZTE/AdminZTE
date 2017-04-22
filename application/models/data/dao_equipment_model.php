<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_equipment_model extends CI_Model{

        public function __construct(){
            $this->load->model('data/configdb_model');
        }

        public function getAllCategories(){
            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM CATEGORIA_EQUIPO;";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {

                $i = 0;
                while($row = $result->fetch_assoc()) {
                  $respuesta[$i]['id'] = $row['K_IDCATEGORIAE'];
                  $respuesta[$i]['nombre'] = $row['N_NAME'];
                  $i++;
                }
              }
            } else {
              $respuesta = "Error de informacion";
            }
              //  $db->Connection->closeSession($session);
                return $respuesta;
          }

        public function getAllTypeEquipment($categorias){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          for($i = 0; $i<count($categorias); $i++){
            $sql = "SELECT * FROM TIPO_EQUIPO WHERE K_IDCATEGORIAE = ".$categorias[$i]['id'].";";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $j = 0;

                while($row = $result->fetch_assoc()) {
                  $tipo[$j]['id'] = $row['K_IDCATEGORIAE'];
                  $tipo[$j]['tipoId'] = $row['K_IDTIPOE'];
                  $tipo[$j]['nombre'] = $row['N_NAME'];
                  $j++;
                }
                $categorias[$i]['tipo']=$tipo;
                $tipo = NULL;
              }
            } else {
              $respuesta = "Error de informacion";
            }
          }
          return $categorias;
        }

        public function getAllDamages(){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "SELECT * FROM damage;";
          if ($session != "false"){
            $result = $session->query($sql);
            if ($result->num_rows > 0) {

              $i = 0;
              while($row = $result->fetch_assoc()) {
                $respuesta[$i]['id'] = $row['K_IDDAMAGE'];
                $respuesta[$i]['nombre'] = $row['N_NAME'];
                $i++;
              }
            }
          } else {
            $respuesta = "Error de informacion";
          }
          return $respuesta;
        }

        public function insertEquipment($equipment){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          if ($equipment->getTipo() == -1){
            $sql = "INSERT INTO equipment (N_NAME, K_IDCATEGORIAE, N_OTROTIPO, N_SERIAL, N_MARCA, N_MODELO)
              values ("."'',".$equipment->getCategoria().",'".$equipment->getOther()."','".$equipment->getSerial()."','".$equipment->getMarca()."','".$equipment->getModelo()."');";
              $sql2 = "SELECT K_IDEQUIPMENT FROM equipment where K_IDCATEGORIAE = ".$equipment->getCategoria()." and N_OTROTIPO = '".$equipment->getOther()."' and N_SERIAL ='".$equipment->getSerial()."' and N_MARCA = '".$equipment->getMarca()."' and N_MODELO = '".$equipment->getModelo()."';";
          } else {
            $sql = "INSERT INTO equipment (N_NAME, K_IDCATEGORIAE, K_IDTIPOE, N_SERIAL, N_MARCA, N_MODELO)
              values ("."'',".$equipment->getCategoria().",".$equipment->getTipo().",'".$equipment->getSerial()."','".$equipment->getMarca()."','".$equipment->getModelo()."');";
            $sql2 = "SELECT K_IDEQUIPMENT FROM equipment where K_IDCATEGORIAE = ".$equipment->getCategoria()." and K_IDTIPOE = ".$equipment->getTipo()." and N_SERIAL ='".$equipment->getSerial()."' and N_MARCA = '".$equipment->getMarca()."' and N_MODELO = '".$equipment->getModelo()."';";
          }
          if ($session != "false"){
            $session->query($sql);
            $result = $session->query($sql2);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $respuesta = $row['K_IDEQUIPMENT'];
              }
            }
          }
          return $respuesta;
        }

        public function getDamageById($id){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "SELECT * FROM damage where K_IDDAMAGE = ".$id.";";
          if ($session != "false"){
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $respuesta['id'] = $row['K_IDDAMAGE'];
              $respuesta['nombre'] = $row['N_NAME'];
            }
          } else {
            $respuesta = "Error de informacion";
          }
          return $respuesta;
        }

        public function getEquipmentById($id){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "SELECT * FROM equipment where K_IDEQUIPMENT = ".$id.";";
          if ($session != "false"){
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $sql = "SELECT * FROM categoria_equipo where K_IDCATEGORIAE = ".$row['K_IDCATEGORIAE'].";";
              $result = $session->query($sql);
              $row2 = $result->fetch_assoc();
              $row['K_IDCATEGORIAE'] = $row2;
              if($row['K_IDTIPOE'] != ""){
                $sql = "SELECT * FROM tipo_equipo where K_IDTIPOE = ".$row['K_IDTIPOE'].";";
                $result = $session->query($sql);
                $row3 = $result->fetch_assoc();
                $row['K_IDTIPOE'] = $row3;
              }
              $respuesta = $row;
            }
          } else {
            $respuesta = "Error de informacion";
          }
          return $respuesta;
        }
    }
?>
