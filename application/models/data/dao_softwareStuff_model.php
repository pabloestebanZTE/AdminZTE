<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_softwareStuff_model extends CI_Model{

        public function __construct(){
            $this->load->model('data/configdb_model');
        }

        public function createSoftwareStuff($OS, $OF, $OV, $AV, $AVV, $BR, $BRV, $SI, $SIV, $MA, $MAV, $SAC, $SACV, $SEM, $SEMV, $id){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          if ($session != "false"){
              $sql = "INSERT INTO software_inventory (N_OPERATIVE_SYSTEM, N_OFFICE, N_OFFICE_VERSION, N_ANTIVIRUS, N_ANTIVIRUS_VERSION, N_BROWSER, N_BROWSER_VERSION, N_SIMONTIC, N_SIMONTIC_VERSION, N_MAGIC, N_MAGIC_VERSION, N_SAC, N_SAC_VERSION, N_SEMILLA, N_SEMILLA_VERSION, K_IDSTUFF)
                VALUES ('".$OS."', '".$OF."', '".$OV."', '".$AV."', '".$AVV."', '".$BR."', '".$BRV."', '".$SI."', '".$SIV."', '".$MA."', '".$MAV."', '".$SAC."', '".$SACV."', '".$SEM."', '".$SEMV."', ".$id.");";
              $result = $session->query($sql);
          } else {
            $user = "Error de informacion";
          }
          $sql = "INSERT INTO software_inventory ";

          return $respuesta;
        }

        public function getAllSoftwareInventoryPerPVD($idPVD){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "SELECT K_SOFTWARE_INVENTORY,N_OPERATIVE_SYSTEM,N_OFFICE,N_OFFICE_VERSION,N_ANTIVIRUS,N_ANTIVIRUS_VERSION,N_BROWSER,N_BROWSER_VERSION,N_SIMONTIC,N_SIMONTIC_VERSION,N_MAGIC,N_MAGIC_VERSION,N_SAC,N_SAC_VERSION,N_SEMILLA,N_SEMILLA_VERSION
          FROM software_inventory, pvd, stuff WHERE software_inventory.K_IDSTUFF = stuff.K_IDSTUFF and stuff.K_IDPVD = pvd.K_IDPVD and pvd.K_IDPVD = ".$idPVD.";";
          if ($session != "false"){
            $result = $session->query($sql);
            if ($result->num_rows > 0) {
              $i = 0;
              while($row = $result->fetch_assoc()) {
                $respuesta[$i] = $row;
                $i++;
              }
            }
          } else {
            $respuesta = "Error de informacion";
          }
          return $respuesta;
        }
    }
?>