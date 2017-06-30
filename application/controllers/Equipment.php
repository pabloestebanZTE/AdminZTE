<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_inventory_model');
        $this->load->model('user_model');
    }

    public function inventoryPVD(){
    //  echo $_GET['k_tipo'];
    //  echo $_GET['k_fase'];
    //  echo $_GET['k_pvd'];
      $respuesta['inventory'] = $this->dao_inventory_model->getEquipmentTypePVD($_GET['k_fase'], $_GET['k_tipo'], $_GET['k_pvd']);
      $respuesta['generic'] = $this->dao_inventory_model->getAllEquipment($_GET['k_fase'], $_GET['k_tipo'], $_GET['k_pvd']);


      $this->load->view('PmaintenanceProcedure', $respuesta);
    }
}
