<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ZTEPlatform extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_ticket_model');
        $this->load->model('data/dao_maintenance_model');
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_MC_model');
        $this->load->model('data/dao_equipment_model');
        $this->load->model('data/dao_PVD_model');
        $this->load->model('user_model');
        $this->load->model('maintenance_model');
        $this->load->model('equipment_model');
        $this->load->model('correctiveM_model');
        $this->load->model('ticket_model');
    }

    public function platformZTE(){
      $this->load->view('ZTEPlatform');
    }

}

?>
