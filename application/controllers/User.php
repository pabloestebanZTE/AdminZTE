<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_user_model');
        $this->load->model('user_model');
    }

    public function loadPrincipalView(){
      $this->load->view('principal');
    }

    function loginUser() {
      $user = new user_model();
      $user = $user->createUser($_POST['user'], $_POST['password'],'','');
      $user = $this->dao_user_model->startSession($user);
      $respuesta['user'] = $user;
      if ($user != "Error de informacion"){
        $this->load->view('principal');
      } else {
        $this->load->view('login', $respuesta);
      }
    }
}

?>
