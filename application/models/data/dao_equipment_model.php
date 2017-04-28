<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_equipment_model extends CI_Model{

        public function __construct(){
            $this->load->model('data/configdb_model');
        //    $this->load->model('data/equipment_model');
        }

        public function getAllCategories(){
            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM equipment_category;";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {

                $i = 0;
                while($row = $result->fetch_assoc()) {
                  $respuesta[$i]['id'] = $row['K_IDCATEGORYE'];
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
            $sql = "SELECT * FROM equipment_type1 WHERE K_IDCATEGORYE = ".$categorias[$i]['id'].";";
            if ($session != "false"){
              $result = $session->query($sql);
              if ($result->num_rows > 0) {
                $j = 0;

                while($row = $result->fetch_assoc()) {
                  $tipo[$j]['id'] = $row['K_IDTYPEE1'];
                  $tipo[$j]['tipoId'] = $row['K_IDCATEGORYE'];
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

        public function getAllTypeEquipment2($categorias){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          for($i = 0; $i<count($categorias); $i++){
            for($j = 0; $j < count($categorias[$i]['tipo']); $j++){
              $sql = "SELECT * FROM equipment_type2 WHERE K_IDTYPEE1 = ".$categorias[$i]['tipo'][$j]['id'].";";
              if ($session != "false"){
                $result = $session->query($sql);
                if ($result->num_rows > 0) {
                  $k = 0;
                  while($row = $result->fetch_assoc()) {
                    $tipo2[$k]['id2'] = $row['K_IDTYPEE2'];
                    $tipo2[$k]['tipoId1'] = $row['K_IDTYPEE1'];
                    $tipo2[$k]['nombre'] = $row['N_NAME'];
                    $k++;
                  }
                  $categorias[$i]['tipo'][$j]['tipo2']=$tipo2;
                  $tipo2 = NULL;
                } else {
                  $respuesta = "Error de informacion";
                }
              }
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
          $sql = "INSERT INTO equipment (N_NAME, K_IDCATEGORYE, N_OTHERTYPE, N_SERIAL, N_MANUFACTURER, N_MODEL, K_IDTYPEE2)
            values ("."'',".$equipment->getCategoria().",'".$equipment->getOther()."','".$equipment->getSerial()."','".$equipment->getMarca()."','".$equipment->getModelo()."',".$equipment->getTipo2().");";
          $sql2 = "SELECT K_IDEQUIPMENT FROM equipment where K_IDCATEGORYE = ".$equipment->getCategoria()." and N_OTHERTYPE = '".$equipment->getOther()."' and N_SERIAL ='".$equipment->getSerial()."' and N_MANUFACTURER = '".$equipment->getMarca()."' and N_MODEL = '".$equipment->getModelo()."' and K_IDTYPEE2 =".$equipment->getTipo2().";";
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
              $sql = "SELECT * FROM equipment_category where K_IDCATEGORYE = ".$row['K_IDCATEGORYE'].";";
              $result = $session->query($sql);
              $row2 = $result->fetch_assoc();
              $row['K_IDCATEGORYE'] = $row2;
              $sql = "SELECT * FROM equipment_type2 where K_IDTYPEE2 = ".$row['K_IDTYPEE2'].";";
              $result = $session->query($sql);
              $row3 = $result->fetch_assoc();
              $row['K_IDTYPEE2'] = $row3;
              $sql = "SELECT * FROM equipment_type1 where K_IDTYPEE1 = ".$row3['K_IDTYPEE1'].";";
              $result = $session->query($sql);
              $row4 = $result->fetch_assoc();
              $equipment = new equipment_model();
              $equipment = $equipment->createEquipment($row['K_IDEQUIPMENT'], $row2, $row4, $row3, $row['N_OTHERTYPE'], $row['N_SERIAL'], $row['N_MANUFACTURER'], $row['N_MODEL']);
              $respuesta = $equipment;
            }
          } else {
            $respuesta = "Error de informacion";
          }
          return $respuesta;
        }
    }
?>
