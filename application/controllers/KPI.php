<?php

$msj = "";
defined('BASEPATH') OR exit('No direct script access allowed');

class KPI extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_kpi_model');
    }

    public function KPIPrincial(){
      $this->load->view('viewKPI');
    }

    public function KPIList(){
      echo "o.o";
      $KPIs = $this->dao_kpi_model->getAllKPI();
      for($i = 0; $i< count($KPIs); $i++){
        print_r($KPIs[$i]);
        echo "<br><br>";
      }
    }

    public function getKPIperSource(){
      $respuesta['KPIsPP'] = $this->dao_kpi_model->getKPIperSource($_SESSION['id']);
      $respuesta['msj'] = $GLOBALS['$msj'];
      $this->load->view('viewKPI', $respuesta);
    }

    public function evaluateKPI(){
      $personas = $this->dao_kpi_model->getKPIEvaluates($_GET['k_kpi']);
      $respuesta['dates'] = $personas[1];
      $respuesta['kpis'] = $personas[2];
      $respuesta['cantidad'] = $personas[3];
      $this->load->view('qualifyKPIs', $respuesta);
    }

    public function updateKPI(){
      $index = 0;
      for($i = 0; $i < $_POST['cantidadY']; $i++){
        for($j = 0; $j < 12; $j++){
          for($k = 0; $k < $_POST['cantidadU']; $k++){
            if($_POST['idKPI-'.$i."-".$j."-".$k]){
              $kpi[$index]['id'] = $_POST['idKPI-'.$i."-".$j."-".$k];
              if($_POST['field-'.$i."-".$j."-".$k."-1"] != null){
                $kpi[$index]['value1'] = $_POST['field-'.$i."-".$j."-".$k."-1"]."<br>";
              }
              if($_POST['field-'.$i."-".$j."-".$k."-2"] != null){
                $kpi[$index]['value2'] = $_POST['field-'.$i."-".$j."-".$k."-2"]."<br>";
              }
              if($_POST['field-'.$i."-".$j."-".$k."-3"] != null){
                $kpi[$index]['value3'] = $_POST['field-'.$i."-".$j."-".$k."-3"]."<br>";
              }
              $index++;
            }
          }
        }
      }

      $respuesta = $this->dao_kpi_model->updateKPIResuelto($kpi);
      if ($respuesta == "false"){
        $GLOBALS['$msj'][0] = "Algo salio mal";
        $GLOBALS['$msj'][1] = "Contacte al administrador del servicio";
        $GLOBALS['$msj'][2] = "error";
      } else {
        $GLOBALS['$msj'][0] = "Bien Hecho";
        $GLOBALS['$msj'][1] = "Información actualizada";
        $GLOBALS['$msj'][2] = "success";
      }
      $this->getKPIperSource();
    }

}

?>
