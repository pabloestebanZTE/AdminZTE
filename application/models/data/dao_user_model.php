<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class dao_user_model extends CI_Model{

        public function __construct(){
            $this->load->model('user_model');
            $this->load->model('data/configdb_model');
        }

        public function startSession(user_model $user){
            $dbConnection = new configdb_model();
            $session = $dbConnection->openSession();
            $sql = "SELECT * FROM user where K_IDUSER = "."'".$user->getId()."' and N_PASSWORD = '".$user->getPass()."';";
            if ($session != "false"){
                $result = $session->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $user->setName($row['N_NAME']);
                    $user->setLastname($row['N_LASTNAME']);

                    $sql2 = "SELECT * FROM user_permission WHERE  k_idtypeuser = ".$row['K_IDTYPEUSER'];
                    $result2 = $session->query($sql2);
                    if ($result2->num_rows > 0) {
                        $count = 0;
                        while($row2 = $result2->fetch_assoc()) {
                            $permissons[$count] = $row2['K_IDPERMISSION'];
                            $count++;
                        }
                        $user->setPermissions($permissons);
                        $dbConnection->startSession($user->getId(),$user->getPass(),$user->getName(),$user->getLastname(),$this->arrayPermissions($user->getPermissions()));
                    }
                } else {
                    $user = "Error de informacion";
                }
                $dbConnection->closeSession($session);
                return $user;
            }
        }

        public function arrayPermissions($permissions){
            for($i = 0; $i<11; $i++){
                $arrayPermissions[$i] = 0;
            }
            for($i = 0; $i <count($permissions); $i++){
              $arrayPermissions[$permissions[$i]] = 1;
            }
            return $arrayPermissions;
        }
    }
?>