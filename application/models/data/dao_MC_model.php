<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_MC_model extends CI_Model{

        public function __construct(){
            $this->load->model('data/configdb_model');
        }

        public function insertMC($ticket, $user, $PVD, $place, $quantity, $damage, $description, $stuff, $equipment){
          $dbConnection = new configdb_model();
          $session = $dbConnection->openSession();
          $sql = "INSERT INTO corrective_maintenance (K_IDTICKET, K_IDUSER, K_IDPVD, K_IDPVDPLACE, Q_QUANTITY, K_IDFALLO, N_DESCRIPTION, N_STUFF, K_IDEQUIPMENT)
          values ('".$ticket."',".$user.",".$PVD.",".$place.",".$quantity.",".$damage.",'".$description."','".$stuff."',".$equipment.");";
          $session->query($sql);
        }


    }
?>
