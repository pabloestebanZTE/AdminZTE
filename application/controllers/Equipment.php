<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_PVD_model');
        $this->load->model('data/dao_inventory_model');
        $this->load->model('user_model');
        $this->load->model('equipment_model');
    }

    public function inventoryPVD(){
    //  echo $_GET['k_tipo'];
    //  echo $_GET['k_fase'];
    //  echo $_GET['k_pvd'];
      $respuesta['PVD'] = $this->dao_PVD_model->getPVDbyId($_GET['k_pvd']);
      $respuesta['inventory'] = $this->dao_inventory_model->getEquipmentTypePVD($_GET['k_fase'], $_GET['k_tipo'], $_GET['k_pvd']);
      $respuesta['generic'] = $this->dao_inventory_model->getAllEquipment($_GET['k_fase'], $_GET['k_tipo'], $_GET['k_pvd']);
      if ($respuesta['PVD']->getRegion() == "Zona 1"){
        $stirngPrecio = "V_PRICE_R1";
      }
      if ($respuesta['PVD']->getRegion() == "Zona 4"){
        $stirngPrecio = "V_PRICE_R4";
      }
      for($i = 0; $i< count($respuesta['generic']); $i++){
        for($j = 0; $j <count($respuesta['generic'][$i]['category']); $j++){
          if($respuesta['generic'][$i]['category'][$j]['V_PRICE_R4'] > 0){
            $respuesta['inventory'][$i]['price'] = $respuesta['generic'][$i]['category'][$j][$stirngPrecio];
          }
        }
      }

      for($i = 0; $i< count($respuesta['inventory']); $i++){
        $respuesta['inventory'][$i]['valorT'] = 0;
        $respuesta['inventory'][$i]['funcional'] = 0;
        $respuesta['inventory'][$i]['averiado'] = 0;
        for($j = 0; $j< count($respuesta['inventory'][$i]['inventario']); $j++){
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Funcional"){
            if($respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio] > 0){
              $respuesta['inventory'][$i]['funcional']++;
            }
            if($respuesta['inventory'][$i]['inventario'][$j]['Q_PROGRESS'] == 1){
              $respuesta['inventory'][$i]['valorT'] += $respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio];
            }
          }
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Averiado"){
            $respuesta['inventory'][$i]['averiado']++;
          }
        }
      }
      $this->load->view('PmaintenanceProcedure', $respuesta);
    }

    public function updateInventory(){

      print_r($_POST);
      $cantidadElementos = $_POST['Elements'];
      for($i = 0; $i < $cantidadElementos; $i++){
        $equipment = new equipment_model;
        $equipment = $equipment->createEquipment($_POST['idElement'.$i], $_POST['selectElement'.$i], "", "", "", $_POST['fieldName'.$i], $_POST['selectMarca'.$i], $_POST['selectModelo'.$i], $_POST['fieldPlaca'.$i], $_POST['fieldParte'.$i], $_POST['selectEstados'.$i], $_POST['selectFinalizado'.$i]);
        if($_POST['idElement'.$i] == ""){
          $respuesta = $this->dao_inventory_model->insertEquipment($equipment, $_POST['pvd']);
        } else {
          $respueta = $this->dao_inventory_model->updateEquipment($equipment,$_POST['pvd'] );
        }
      }
      $respuesta['PVD'] = $this->dao_PVD_model->getPVDbyId($_POST['pvd']);
      print_r($respuesta['PVD']);
      $respuesta['inventory'] = $this->dao_inventory_model->getEquipmentTypePVD($respuesta['PVD']->getFase(), $respuesta['PVD']->getTipologia(), $_POST['pvd']);
      $respuesta['generic'] = $this->dao_inventory_model->getAllEquipment($respuesta['PVD']->getFase(), $respuesta['PVD']->getTipologia(), $_POST['pvd']);
      if ($respuesta['PVD']->getRegion() == "Zona 1"){
        $stirngPrecio = "V_PRICE_R1";
      }
      if ($respuesta['PVD']->getRegion() == "Zona 4"){
        $stirngPrecio = "V_PRICE_R4";
      }
      for($i = 0; $i< count($respuesta['generic']); $i++){
        for($j = 0; $j <count($respuesta['generic'][$i]['category']); $j++){
          if($respuesta['generic'][$i]['category'][$j]['V_PRICE_R4'] > 0){
            $respuesta['inventory'][$i]['price'] = $respuesta['generic'][$i]['category'][$j][$stirngPrecio];
          }
        }
      }

      for($i = 0; $i< count($respuesta['inventory']); $i++){
        $respuesta['inventory'][$i]['valorT'] = 0;
        $respuesta['inventory'][$i]['funcional'] = 0;
        $respuesta['inventory'][$i]['averiado'] = 0;
        for($j = 0; $j< count($respuesta['inventory'][$i]['inventario']); $j++){
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Funcional"){
            if($respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio] > 0){
              $respuesta['inventory'][$i]['funcional']++;
            }
            if($respuesta['inventory'][$i]['inventario'][$j]['Q_PROGRESS'] == 1){
              $respuesta['inventory'][$i]['valorT'] += $respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio];
            }
          }
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Averiado"){
            $respuesta['inventory'][$i]['averiado']++;
          }
        }
      }
      $this->load->view('PmaintenanceProcedure', $respuesta);
    }
}
