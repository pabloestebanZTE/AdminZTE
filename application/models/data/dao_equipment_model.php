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

        public function insertEquipment($category, $type, $other, $serial, $manufacturer, $model){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          if ($type == "-1"){
            $sql = "INSERT INTO equipment (N_NAME, K_IDCATEGORIAE, N_OTROTIPO, N_SERIAL, N_MARCA, N_MODELO)
              values ("."'',".$category.",'".$other."','".$serial."','".$manufacturer."','".$model."');";
              $sql2 = "SELECT K_IDEQUIPMENT FROM equipment where K_IDCATEGORIAE = ".$category." and N_OTROTIPO = '".$other."' and N_SERIAL ='".$serial."' and N_MARCA = '".$manufacturer."' and N_MODELO = '".$model."';";
          } else {
            $sql = "INSERT INTO equipment (N_NAME, K_IDCATEGORIAE, K_IDTIPOE, N_SERIAL, N_MARCA, N_MODELO)
              values ("."'',".$category.",".$type.",'".$serial."','".$manufacturer."','".$model."');";
            $sql2 = "SELECT K_IDEQUIPMENT FROM equipment where K_IDCATEGORIAE = ".$category." and K_IDTIPOE = ".$type." and N_SERIAL ='".$serial."' and N_MARCA = '".$manufacturer."' and N_MODELO = '".$model."';";
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

    }
?>
