<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_MC_model extends CI_Model{

        public function __construct(){
            $this->load->model('data/configdb_model');
        }

        public function insertMC($maintenance, $idstuff){
          print_r($maintenance);
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql =  "SELECT count(*) from ticket_corrective_maintenance";
          if ($session != "false"){
            $result = $session->query($sql);
            $row = $result->fetch_assoc();
            $id = "TCM-";
            for($i = count($row['count(*)']); $i < 6; $i++){
              $id = $id."0";
            }
            $id = $id.$row['count(*)'];
            $sql2 = "INSERT INTO ticket_corrective_maintenance (K_IDTICKET_CORRECTIVE, N_DAMAGED_ELEMENTS, N_REFERENCE_D_ELEMENTS, N_FAILURE_DESCRIPTION, N_TEST, N_NEW_ELEMENTS, N_FAILURE_CLASSIFICATION, K_IDSTUFF)
              values('".$id."', '".$maintenance->getStuff()."', '".$maintenance->getEquipment()."', '".$maintenance->getDamage()."', '".$maintenance->getDescription()."', '".$maintenance->getSDate()."', '".$maintenance->getFDate()."', ".$idstuff." );";
            $session->query($sql2);
          } else {
            $respuesta = "Error de informacion";
          }
          return $respuesta;
        }






    }
?>
