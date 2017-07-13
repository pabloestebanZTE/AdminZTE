<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/aws_s3_sdk/aws-autoloader.php';
use Aws\S3\S3Client;

$s3Client = S3Client::factory(array(
  'http' => [ 'verify' => false ],
    'version' => 'latest',
    'region' => 'us-west-2',
    'credentials' => array(
        'key'    => 'AKIAJUCUHLTBZFNXHJ6Q',
        'secret' => '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',
    )
));

$iterator = $s3Client->getIterator('ListObjects', array(
    'Bucket' => strtolower($_GET['k_ticket'])
));

$GLOBALS['bucket'] = $iterator;

class Equipment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_PVD_model');
        $this->load->model('data/dao_inventory_model');
        $this->load->model('user_model');
        $this->load->model('equipment_model');
    }

    public function listBucket($folder){
      try {
        foreach ($GLOBALS['bucket'] as $object) {
      //    print_r($object);
          $direccion = explode("/", $object['Key']);
          if(count($direccion)>4){
            if($direccion[4] != ""){
              $folder[$direccion[1]][$direccion[2]][$direccion[3]] = 1;
            }
            $direccion = NULL;
          }
        }
      } catch (Exception $e ) {
        echo ".o.o";
      }
    //  print_r($folder);
      return $folder;
    }

    public function inventoryPVD(){
    //  echo $_GET['k_tipo'];
    //  echo $_GET['k_fase'];
    //  echo $_GET['k_pvd'];
      $folders = $this->createFolders();
      $folders = $this->listBucket($folders);
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
    //  print_r($respuesta['inventory']);
      for($i = 0; $i< count($respuesta['inventory']); $i++){
        $respuesta['inventory'][$i]['valorT'] = 0;
        $respuesta['inventory'][$i]['funcional'] = 0;
        $respuesta['inventory'][$i]['averiado'] = 0;
        $respuesta['inventory'][$i]['avance'] = 0;
        for($j = 0; $j< count($respuesta['inventory'][$i]['inventario']); $j++){
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Funcional"){
            if($respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio] > 0){
              $respuesta['inventory'][$i]['funcional']++;
            }
            if($respuesta['inventory'][$i]['inventario'][$j]['Q_PROGRESS'] == 1){
              $respuesta['inventory'][$i]['valorT'] += $respuesta['inventory'][$i]['inventario'][$j][$stirngPrecio];
              $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 40;
            }
          }
          if($respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] == "Averiado"){
            $respuesta['inventory'][$i]['averiado']++;
          }
          if($folders[$respuesta['inventory'][$i]['N_NAME']][$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']]['Antes del Mantenimiento'] == 1 && $respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] != "Averiado"){
            $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 20;
          }
          if($folders[$respuesta['inventory'][$i]['N_NAME']][$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']]['Durante el Mantenimiento'] == 1 && $respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] != "Averiado"){
            $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 20;
          }
          if($folders[$respuesta['inventory'][$i]['N_NAME']][$respuesta['inventory'][$i]['inventario'][$j]['K_IDPVD_PLACE']['N_NAME']]['Despues del Mantenimiento'] == 1 && $respuesta['inventory'][$i]['inventario'][$j]['N_ESTADO'] != "Averiado"){
            $respuesta['inventory'][$i]['inventario'][$j]['progreso'] = $respuesta['inventory'][$i]['inventario'][$j]['progreso'] + 20;
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
        $equipment->setZona($_POST['selectZones'.$i]);

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

    public function createFolders(){
      $folders['Computador convencional']['Acceso a Internet']['Antes del Mantenimiento'] = "";
      $folders['Computador convencional']['Acceso a Internet']['Despues del Mantenimiento'] = "";
      $folders['Computador convencional']['Acceso a Internet']['Durante el Mantenimiento'] = "";
      $folders['Computador convencional']['Aspectos generales'] = $folders['Computador convencional']['Servicios complementarios'] = $folders['Computador convencional']['Recepción y registro'] = $folders['Computador convencional']['Producción de contenidos'] = $folders['Computador convencional']['Consultas rápidas'] = $folders['Computador convencional']['Almacenamiento'] = $folders['Computador convencional']['Capacitación'] = $folders['Computador convencional']['Entretenimiento'] = $folders['Computador convencional']['Innovación'] = $folders['Computador convencional']['Acceso a internet'];
      $folders['Soporte consolas y televisores'] = $folders['Mobiliario (muebles, enceres y señalización)'] = $folders['Alarma para PVD'] = $folders['Redes de datos'] = $folders['Redes electricas'] = $folders['Camara IP'] = $folders['DVD player'] = $folders['Video Beam'] = $folders['Mesa electrificada de 6 a 8 puestos'] = $folders['Mezclador de audio'] = $folders['Grabadora audio digital'] = $folders['Tripode para microfonos'] = $folders['Tripode de cabeza fluida para camara'] = $folders['Tripode ajustable para luces'] = $folders['Microfono inalambrico de solapa'] = $folders['Microfono con cable'] = $folders['Mezclador de video'] = $folders['Camara fotografica'] = $folders['Camara de video'] = $folders['Audifonos para estudio profesional'] = $folders['Lampara escualizable'] = $folders['Diadema para equipo de computo con microfono'] = $folders['Membrana táctil para televisores de 55 Y 58'] = $folders['Home cinema'] = $folders['Consola de juegos'] = $folders['UPS'] = $folders['Televisor LED desde 32 a 42'] = $folders['Tableta digitalizadora'] = $folders['Impresora'] = $folders['Servidor'] = $folders['Workstation y-o administrador de red'] = $folders['Computador All in One'] = $folders['Computador portatil'] = $folders['Computador convencional'];
      return $folders;
    }
}
