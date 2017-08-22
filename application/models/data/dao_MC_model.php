<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_MC_model extends CI_Model{

        public function __construct(){
            $this->load->model('data/configdb_model');
        }

        public function insertMC($maintenance, $idstuff){
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
            $sql2 = "INSERT INTO ticket_corrective_maintenance (K_IDTICKET_CORRECTIVE, N_DAMAGED_ELEMENTS, N_REFERENCE_D_ELEMENTS, N_FAILURE_DESCRIPTION, N_TEST, N_NEW_ELEMENTS, N_FAILURE_CLASSIFICATION, K_IDSTUFF, N_JAWS_VERSION, N_CCC)
              values('".$id."', '".$maintenance->getStuff()."', '".$maintenance->getEquipment()."', '".$maintenance->getDamage()."', '".$maintenance->getDescription()."', '".$maintenance->getSDate()."', '".$maintenance->getFDate()."', ".$idstuff.", '', '');";
            $session->query($sql2);
          } else {
            $respuesta = "Error de informacion";
          }
          return $respuesta;
        }

        public function updateMC($maintenance){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "UPDATE ticket_corrective_maintenance SET N_DAMAGED_ELEMENTS = '".$maintenance->getStuff()."', N_REFERENCE_D_ELEMENTS = '".$maintenance->getEquipment()."', N_FAILURE_DESCRIPTION='".$maintenance->getDamage()."', N_TEST = '".$maintenance->getDescription()."', N_NEW_ELEMENTS='".$maintenance->getSDate()."' WHERE K_IDTICKET_CORRECTIVE = '".$maintenance->getId()."';";
          $session->query($sql);
        }
    }
?>
