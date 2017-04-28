<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_MC_model extends CI_Model{

        public function __construct(){
            $this->load->model('data/configdb_model');
        }

        public function insertMC($maintenance){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "INSERT INTO corrective_maintenance (K_IDTICKET, K_IDUSER, K_IDPVD, K_IDPVDZONE, Q_QUANTITY, K_IDDAMAGE, N_DESCRIPTION, N_STUFF, K_IDEQUIPMENT, K_IDSTATUSMC, D_STARTDATE)
          values ('".$maintenance->getTicket()."',".$maintenance->getUser().",".$maintenance->getPVD().",".$maintenance->getPlace().",".$maintenance->getQuantity().",".$maintenance->getDamage().",'".
            $maintenance->getDescription()."','".$maintenance->getStuff()."',".$maintenance->getEquipment().", ".$maintenance->getStatus().", STR_TO_DATE('".$maintenance->getSDate()."', '%m/%d/%Y'));";
          $session->query($sql);
        }

        public function getAllMC(){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "SELECT * FROM corrective_maintenance";
          if ($session != "false"){
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
              $i = 0;
              while($row = $result->fetch_assoc()) {
                $row['K_IDPVD'] = $this->dao_PVD_model->getPVDbyId($row['K_IDPVD']);
                $row['K_IDPVDZONE'] = $this->dao_PVD_model->getPVDZoneById($row['K_IDPVDZONE']);
                $row['K_IDUSER'] = $this->dao_user_model->getUserById($row['K_IDUSER']);
                $row['K_IDFALLO'] = $this->dao_equipment_model->getDamageById($row['K_IDFALLO']);
                $row['K_IDEQUIPMENT']=$this->dao_equipment_model->getEquipmentById($row['K_IDEQUIPMENT'] );
                $row['K_STATUS']=$this->getStatusbyId($row['K_IDSTATUSMC']);
                $maintenanceC = new correctiveM_model();
                $maintenanceC = $maintenanceC->createMaintenance($row['K_IDCORRECTIVE_MAINTENANCE'], $row['K_IDTICKET'], $row['K_IDUSER'], $row['K_IDPVD'], $row['K_IDPVDZONE'], $row['Q_QUANTITY'], $row['K_IDFALLO'], $row['K_IDEQUIPMENT'], $row['N_DESCRIPTION'], $row['N_STUFF'], $row['D_STARTDATE'], $row['D_FINISHDATE'], $row['K_STATUS']);
                $respuesta[$i] = $maintenanceC;
                $i++;
              }
            }
          }
          return $respuesta;
        }

        public function getAllUsersMC(){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "SELECT user.K_IDUSER, user.N_NAME, user.N_LASTNAME FROM corrective_maintenance, zte_fonade.user where corrective_maintenance.K_IDUSER = user.K_IDUSER GROUP BY user.K_IDUSER ;";
          if ($session != "false"){
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
              $i = 0;
              while($row = $result->fetch_assoc()) {
                $respuesta[$i] = $row;
                $i++;
              }
            }
          }
          return $respuesta;
        }

        public function getStatusbyId($id){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "SELECT * FROM mc_status WHERE K_IDSTATUSMC = ".$id.";";
          if ($session != "false"){
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $respuesta = $row;
            }
          }
          return $respuesta;
        }
    }
?>
