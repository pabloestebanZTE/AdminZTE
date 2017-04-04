<?php

$msgJS = "";

defined('BASEPATH') OR exit('No direct script access allowed');

include 'fileManager.php';       // include the class

class Mantenimientos extends CI_Controller {



    function __construct() {
        parent::__construct();
        $this->load->model('data/dao_ticket_model');
        $this->load->model('data/dao_maintenance_model');
        $this->load->model('data/dao_user_model');
        $this->load->model('data/dao_PVD_model');
        $this->load->model('user_model');
        $this->load->model('maintenance_model');
    }

    function loadMPView(){
        $PVDs = $this->dao_PVD_model->getPVDs();
        for($i = 0; $i < count($PVDs); $i++){
          $PVDs[$i]->setMaintenance($this->dao_maintenance_model->getManPrePerPVD($PVDs[$i]->getId()));
          for($j = 0; $j < count($PVDs[$i]->getMaintenance()); $j++){
            $PVDs[$i]->getMaintenance()[$j]->setTicket($this->dao_ticket_model->getTicketsPerMaintenance($PVDs[$i]->getMaintenance()[$j]->getId()));
          }
        }
        $respuesta['MP'] = $this->arregloGraficasMP($PVDs);
        $respuesta['tablas'] = $this->arregloTablas($respuesta['MP']);
        if ($GLOBALS['$msgJS'] != ""){
          $respuesta['msg'] = $GLOBALS['$msgJS'];
        }
        $this->load->view('MPreventivos', $respuesta);
    }

    function subirArchivoMP(){
        $archivo = new fileManager;
        $result = $archivo->updateFile('files/', $_FILES['file']['error'],"uploadMantenimientosP.xls",$_FILES['file']['tmp_name']);
        if($result[0] == "true"){
          $GLOBALS['$msgJS'][0] = "Bien Hecho";
          $GLOBALS['$msgJS'][1] = "Archivo cargado correctamente";
          $GLOBALS['$msgJS'][2] = "success";
        } else {
          $GLOBALS['$msgJS'][0] = "Algo salio mal";
          $GLOBALS['$msgJS'][1] = "El archivo no se cargo";
          $GLOBALS['$msgJS'][2] = "error";
        }
        $this->loadMPView();
    }

    function actualizarMP(){
        $excel = new fileManager;
        $result = $excel->excelReader("uploadMantenimientosP");
        $GLOBALS['$msgJS'][0] = "Bien Hecho";
        $GLOBALS['$msgJS'][1] = "Base de datos actualizada";
        $GLOBALS['$msgJS'][2] = "success";
        $this->loadMPView();
    }

    function arregloTablas($MP){
      $tablas['tabla1'] = $this->resumenPreventivosMes($MP);
      $tablas['tabla2'] = $this->avanceDepartamentos($MP);
      $tablas['tabla3'] = $this->detalleTickets($MP);
      return $tablas;
    }

    function avanceDepartamentos($MP){
      $tabla2['Titulos'][0] = "Departamento";
      $tabla2['Titulos'][1] = "Región";
      $tabla2['Titulos'][2] = "Planeado";
      $tabla2['Titulos'][3] = "Ejecutado";
      $tabla2['Titulos'][4] = "En Progreso";
      $tabla2['Titulos'][5] = "Ejecutado+ Progreso";
      $tabla2['Titulos'][6] = "% En Progreso";
      $tabla2['Titulos'][7] = "%(Ejecución + Progreso)";

      $counter = 0;
      for ($i = 0; $i<count($MP['Marzo'])-2;$i++){
        $flag = "true";
        for($j = 0; $j<count($ciudades); $j++){
          if($MP['Marzo'][$i]['departamento'] == $ciudades[$j]){
            $flag = "false";
          }
        }
        if($flag == "true"){
          $ciudades[$counter]=$MP['Marzo'][$i]['departamento'];
          $regiones[$counter]=$MP['Marzo'][$i]['region'];
          $counter++;
        }
      }
      $tabla2['ciudades'] = $ciudades;

      for ($i = 0; $i<count($MP['Marzo'])-2;$i++){
        for($j = 0; $j < count($ciudades); $j++){
          $tabla2[$ciudades[$j]][0] = $regiones[$j];
          $tabla2[$ciudades[$j]][1] = 0;
          $tabla2[$ciudades[$j]][2] = 0;
          $tabla2[$ciudades[$j]][3] = 0;
          $tabla2[$ciudades[$j]][4] = 0;
          $tabla2[$ciudades[$j]][5] = 0;
          $tabla2[$ciudades[$j]][6] = 0;
        }
      }

      for ($i = 0; $i<count($MP['Marzo'])-2;$i++){
        for($j = 0; $j < count($ciudades); $j++){
          if($ciudades[$j] == $MP['Marzo'][$i]['departamento']){
            if($MP['Marzo'][$i]['mantenimiento']->getTicket() == "No Ticket"){
              $tabla2[$ciudades[$j]][1]++;
            } else {
              if ($MP['Marzo'][$i]['mantenimiento']->getTicket()[0]->getStatus() == "Cerrado"){
                $tabla2[$ciudades[$j]][2]++;
                $tabla2[$ciudades[$j]][1]++;
              } else {
                $tabla2[$ciudades[$j]][3]++;
                $tabla2[$ciudades[$j]][1]++;
              }
            }
          }
        }
      }

      $precision = 2;
      for ($i = 0; $i<count($MP['Marzo'])-2;$i++){
        for($j = 0; $j < count($ciudades); $j++){
          $tabla2[$ciudades[$j]][4] = $tabla2[$ciudades[$j]][3] + $tabla2[$ciudades[$j]][2];
          $tabla2[$ciudades[$j]][5] = number_format((float) 100/$tabla2[$ciudades[$j]][1]*$tabla2[$ciudades[$j]][3], $precision, '.', '');
          $tabla2[$ciudades[$j]][6] = number_format((float) 100/$tabla2[$ciudades[$j]][1]*$tabla2[$ciudades[$j]][4], $precision, '.', '');
        }
      }

      return $tabla2;
    }

    function detalleTickets($MP){
      $tabla3['Titulos'][0] = "Item";
      $tabla3['Titulos'][1] = "Inicio";
      $tabla3['Titulos'][2] = "Fin";
      $tabla3['Titulos'][3] = "Días";
      $tabla3['Titulos'][4] = "Región";
      $tabla3['Titulos'][5] = "Estado";
      $tabla3['Titulos'][6] = "Ticket";
      $tabla3['Titulos'][7] = "PVD";
      $tabla3['Titulos'][8] = "Tipo";
      $tabla3['Titulos'][9] = "Departamento / Ciudad";

      $contador = 0;
      for ($i = 0; $i<count($MP['Marzo'])-2;$i++){
        if ($MP['Marzo'][$i]['mantenimiento']->getTicket() != 'No Ticket'){
            $tabla3['lineas'][$contador][0] = $contador+1;
            $tabla3['lineas'][$contador][1] = $MP['Marzo'][$i]['mantenimiento']->getTicket()[0]->getDateS();
            $tabla3['lineas'][$contador][2] = $MP['Marzo'][$i]['mantenimiento']->getTicket()[0]->getDateF();
            $tabla3['lineas'][$contador][3] = $MP['Marzo'][$i]['mantenimiento']->getTicket()[0]->getDuracion();
            $tabla3['lineas'][$contador][4] = $MP['Marzo'][$i]['region'];
            $tabla3['lineas'][$contador][5] = $MP['Marzo'][$i]['mantenimiento']->getTicket()[0]->getStatus();
            $tabla3['lineas'][$contador][6] = $MP['Marzo'][$i]['mantenimiento']->getTicket()[0]->getId();
            $tabla3['lineas'][$contador][7] = $MP['Marzo'][$i]['idPVD'];
            $tabla3['lineas'][$contador][8] = $MP['Marzo'][$i]['tipologia'];
            $tabla3['lineas'][$contador][9] = $MP['Marzo'][$i]['departamento']." / ".$MP['Marzo'][$i]['ciudad'];
            $contador++;
        }
      }
      return $tabla3;
    }

    function resumenPreventivosMes($MP){

      $precision = 2;
      $tabla1['Titulos'][0] = "Región";
      $tabla1['Titulos'][1] = "Planeado";
      $tabla1['Titulos'][2] = "Ejecutado";
      $tabla1['Titulos'][3] = "En Progreso";
      $tabla1['Titulos'][4] = "Ejecutado + Progreso";
      $tabla1['Titulos'][5] = "% de Ejecución";
      $tabla1['Titulos'][6] = "% (Ejecución + Progreso)";

      $tabla1['linea1'][0]='Región 1';
      $tabla1['linea1'][1]= $MP['Marzo']['Zona']['Zona1']['Estado']['Progreso']+$MP['Marzo']['Zona']['Zona1']['Estado']['Ejecutado']+$MP['Marzo']['Zona']['Zona1']['Estado']['Abierto'];
      $tabla1['linea1'][2]= $MP['Marzo']['Zona']['Zona1']['Estado']['Ejecutado'];
      $tabla1['linea1'][3]= $MP['Marzo']['Zona']['Zona1']['Estado']['Progreso'];
      $tabla1['linea1'][4]= $MP['Marzo']['Zona']['Zona1']['Estado']['Progreso']+$MP['Marzo']['Zona']['Zona1']['Estado']['Ejecutado'];
      $tabla1['linea1'][5]= number_format((float) 100/$tabla1['linea1'][1]*$tabla1['linea1'][2], $precision, '.', '');
      $tabla1['linea1'][6]= number_format((float) 100/$tabla1['linea1'][1]*($tabla1['linea1'][2]+$tabla1['linea1'][3]), $precision, '.', '');

      $tabla1['linea2'][0]='Región 4';
      $tabla1['linea2'][1]= $MP['Marzo']['Zona']['Zona4']['Estado']['Progreso']+$MP['Marzo']['Zona']['Zona4']['Estado']['Ejecutado']+$MP['Marzo']['Zona']['Zona4']['Estado']['Abierto'];
      $tabla1['linea2'][2]= $MP['Marzo']['Zona']['Zona4']['Estado']['Ejecutado'];
      $tabla1['linea2'][3]= $MP['Marzo']['Zona']['Zona4']['Estado']['Progreso'];
      $tabla1['linea2'][4]= $MP['Marzo']['Zona']['Zona4']['Estado']['Progreso']+$MP['Marzo']['Zona']['Zona4']['Estado']['Ejecutado'];
      $tabla1['linea2'][5]= number_format((float) 100/$tabla1['linea2'][1]*$tabla1['linea2'][2], $precision, '.', '');
      $tabla1['linea2'][6]= number_format((float) 100/$tabla1['linea2'][1]*($tabla1['linea2'][2]+$tabla1['linea2'][3]), $precision, '.', '');

      $tabla1['linea3'][0]= "Total";
      $tabla1['linea3'][1]= $tabla1['linea2'][1]+$tabla1['linea1'][1];
      $tabla1['linea3'][2]= $tabla1['linea2'][2]+$tabla1['linea1'][2];
      $tabla1['linea3'][3]= $tabla1['linea2'][3]+$tabla1['linea1'][3];
      $tabla1['linea3'][4]= $tabla1['linea2'][4]+$tabla1['linea1'][4];
      $tabla1['linea3'][5]= $tabla1['linea2'][5]+$tabla1['linea1'][5];
      $tabla1['linea3'][6]= $tabla1['linea2'][6]+$tabla1['linea1'][6];

      return $tabla1;
    }

    function arregloGraficasMP($PVDs){
      $MP = $this->definirArregloMP();

      for($i = 0; $i < count($PVDs); $i++){
        for($j = 0; $j < count($PVDs[$i]->getMaintenance()); $j++){
          $MP = $this->reconocerMes($PVDs[$i]->getMaintenance()[$j], $MP, $PVDs[$i]->getRegion(), $PVDs[$i]->getCity(), $PVDs[$i]->getDepartment(), $PVDs[$i]->getId(), $PVDs[$i]->getRegion(),$PVDs[$i]->getTipologia());
        }
      }
      return $MP;
    }

    function reconocerMes($mantenimiento , $MP, $region, $city, $department, $id, $regionPVD, $tipologia){
      $month = explode("-",$mantenimiento->getDate());
      switch ($month[1]) {
        case 1:
    //      $MP['Enero'][$MP['Enero']['contador']]= $mantenimiento;
          $MP['Enero']['contador']++;
          $MP['Enero']['Zona']=$this->reconocerZona($region, $MP['Enero']['Zona'], $mantenimiento);
          break;
        case 2:
        //  $MP['Febrero'][$MP['Febrero']['contador']]= $mantenimiento;
          $MP['Febrero']['contador']++;
          $MP['Febrero']['Zona']=$this->reconocerZona($region, $MP['Febrero']['Zona'], $mantenimiento);
          break;
        case 3:
          $MP['Marzo'][$MP['Marzo']['contador']]['mantenimiento']= $mantenimiento;
          $MP['Marzo'][$MP['Marzo']['contador']]['ciudad']= $city;
          $MP['Marzo'][$MP['Marzo']['contador']]['departamento']= $department;
          $MP['Marzo'][$MP['Marzo']['contador']]['idPVD']= $id;
          $MP['Marzo'][$MP['Marzo']['contador']]['region']= $regionPVD;
          $MP['Marzo'][$MP['Marzo']['contador']]['tipologia']= $tipologia;
          $MP['Marzo']['contador']++;
          $MP['Marzo']['Zona']=$this->reconocerZona($region, $MP['Marzo']['Zona'], $mantenimiento);
          break;
        case 4:
      //    $MP['Abril'][$MP['Abril']['contador']]= $mantenimiento;
          $MP['Abril']['contador']++;
          $MP['Abril']['Zona']=$this->reconocerZona($region, $MP['Abril']['Zona'], $mantenimiento);
          break;
        case 5:
        //  $MP['Mayo'][$MP['Mayo']['contador']]= $mantenimiento;
          $MP['Mayo']['contador']++;
          $MP['Mayo']['Zona']=$this->reconocerZona($region, $MP['Mayo']['Zona'], $mantenimiento);
          break;
        case 6:
        //  $MP['Junio'][$MP['Junio']['contador']]= $mantenimiento;
          $MP['Junio']['contador']++;
          $MP['Junio']['Zona']=$this->reconocerZona($region, $MP['Junio']['Zona'], $mantenimiento);
          break;
        case 7:
          //$MP['Julio'][$MP['Julio']['contador']]= $mantenimiento;
          $MP['Julio']['contador']++;
          $MP['Julio']['Zona']=$this->reconocerZona($region, $MP['Julio']['Zona'], $mantenimiento);
          break;
        case 8:
        //  $MP['Agosto'][$MP['Agosto']['contador']]= $mantenimiento;
          $MP['Agosto']['contador']++;
          $MP['Agosto']['Zona']=$this->reconocerZona($region, $MP['Agosto']['Zona'], $mantenimiento);
          break;
        case 9:
        //  $MP['Septiembre'][$MP['Septiembre']['contador']]= $mantenimiento;
          $MP['Septiembre']['Septiembre']++;
          $MP['Septiembre']['Zona']=$this->reconocerZona($region, $MP['Septiembre']['Zona'],$mantenimiento);
          break;
        case 10:
          //$MP['Octubre'][$MP['Octubre']['contador']]= $mantenimiento;
          $MP['Octubre']['contador']++;
          $MP['Octubre']['Zona']=$this->reconocerZona($region, $MP['Octubre']['Zona'], $mantenimiento);
          break;
        case 11:
        //  $MP['Noviembre'][$MP['Noviembre']['contador']]= $mantenimiento;
          $MP['Noviembre']['contador']++;
          $MP['Noviembre']['Zona']=$this->reconocerZona($region, $MP['Noviembre']['Zona'], $mantenimiento);
          break;
        case 12:
        //  $MP['Diciembre'][$MP['Diciembre']['contador']]= $mantenimiento;
          $MP['Diciembre']['contador']++;
          $MP['Diciembre']['Zona']=$this->reconocerZona($region, $MP['Diciembre']['Zona'], $mantenimiento);
          break;
        default:
          break;
      }
      return $MP;
    }

    function reconocerZona($zona, $arregloZona, $mantenimiento){
      switch ($zona) {
        case 'Zona 1':
          $arregloZona['Zona1']['Cantidad']++;
          $arregloZona['Zona1']['Estado'] = $this->reconocerEstado($mantenimiento->getTicket(), $arregloZona['Zona1']['Estado']);
          break;
        case 'Zona 4':
          $arregloZona['Zona4']['Cantidad']++;
          $arregloZona['Zona4']['Estado'] = $this->reconocerEstado($mantenimiento->getTicket(), $arregloZona['Zona4']['Estado']);
          break;
        default:
          break;
      }
      return $arregloZona;
    }

    function reconocerEstado($estado, $arregloEstado){
      if($estado != 'No Ticket'){
        $estado = $estado[0]->getStatus();
      }

      switch ($estado) {
        case 'No Ticket':
          $arregloEstado['Abierto']++;
          break;
        case 'En Progreso':
          $arregloEstado['Progreso']++;
          break;
        case 'Cerrado':
          $arregloEstado['Ejecutado']++;
          break;
        default:
          break;
      }
      return $arregloEstado;
    }

    function definirArregloMP(){
      $MP['Enero']['contador']=0;
      $MP['Febrero']['contador']=0;
      $MP['Marzo']['contador']=0;
      $MP['Abril']['contador']=0;
      $MP['Mayo']['contador']=0;
      $MP['Junio']['contador']=0;
      $MP['Julio']['contador']=0;

      $MP['Enero']['Zona']['Zona1']['Cantidad']=0;
      $MP['Enero']['Zona']['Zona4']['Cantidad']=0;
      $MP['Febrero']['Zona']['Zona1']['Cantidad']=0;
      $MP['Febrero']['Zona']['Zona4']['Cantidad']=0;
      $MP['Marzo']['Zona']['Zona1']['Cantidad']=0;
      $MP['Marzo']['Zona']['Zona4']['Cantidad']=0;
      $MP['Abril']['Zona']['Zona1']['Cantidad']=0;
      $MP['Abril']['Zona']['Zona4']['Cantidad']=0;
      $MP['Mayo']['Zona']['Zona1']['Cantidad']=0;
      $MP['Mayo']['Zona']['Zona4']['Cantidad']=0;
      $MP['Junio']['Zona']['Zona1']['Cantidad']=0;
      $MP['Junio']['Zona']['Zona4']['Cantidad']=0;
      $MP['Julio']['Zona']['Zona1']['Cantidad']=0;
      $MP['Julio']['Zona']['Zona4']['Cantidad']=0;

      $MP['Enero']['Zona']['Zona1']['Estado']['Abierto']=0;
      $MP['Enero']['Zona']['Zona1']['Estado']['Ejecutado']=0;
      $MP['Enero']['Zona']['Zona1']['Estado']['Progreso']=0;
      $MP['Enero']['Zona']['Zona4']['Estado']['Abierto']=0;
      $MP['Enero']['Zona']['Zona4']['Estado']['Ejecutado']=0;
      $MP['Enero']['Zona']['Zona4']['Estado']['Progreso']=0;
      $MP['Febrero']['Zona']['Zona1']['Estado']['Abierto']=0;
      $MP['Febrero']['Zona']['Zona1']['Estado']['Ejecutado']=0;
      $MP['Febrero']['Zona']['Zona1']['Estado']['Progreso']=0;
      $MP['Febrero']['Zona']['Zona4']['Estado']['Abierto']=0;
      $MP['Febrero']['Zona']['Zona4']['Estado']['Ejecutado']=0;
      $MP['Febrero']['Zona']['Zona4']['Estado']['Progreso']=0;
      $MP['Marzo']['Zona']['Zona1']['Estado']['Abierto']=0;
      $MP['Marzo']['Zona']['Zona1']['Estado']['Ejecutado']=0;
      $MP['Marzo']['Zona']['Zona1']['Estado']['Progreso']=0;
      $MP['Marzo']['Zona']['Zona4']['Estado']['Abierto']=0;
      $MP['Marzo']['Zona']['Zona4']['Estado']['Ejecutado']=0;
      $MP['Marzo']['Zona']['Zona4']['Estado']['Progreso']=0;
      $MP['Abril']['Zona']['Zona1']['Estado']['Abierto']=0;
      $MP['Abril']['Zona']['Zona1']['Estado']['Ejecutado']=0;
      $MP['Abril']['Zona']['Zona1']['Estado']['Progreso']=0;
      $MP['Abril']['Zona']['Zona4']['Estado']['Abierto']=0;
      $MP['Abril']['Zona']['Zona4']['Estado']['Ejecutado']=0;
      $MP['Abril']['Zona']['Zona4']['Estado']['Progreso']=0;
      $MP['Mayo']['Zona']['Zona1']['Estado']['Abierto']=0;
      $MP['Mayo']['Zona']['Zona1']['Estado']['Ejecutado']=0;
      $MP['Mayo']['Zona']['Zona1']['Estado']['Progreso']=0;
      $MP['Mayo']['Zona']['Zona4']['Estado']['Abierto']=0;
      $MP['Mayo']['Zona']['Zona4']['Estado']['Ejecutado']=0;
      $MP['Mayo']['Zona']['Zona4']['Estado']['Progreso']=0;
      $MP['Junio']['Zona']['Zona1']['Estado']['Abierto']=0;
      $MP['Junio']['Zona']['Zona1']['Estado']['Ejecutado']=0;
      $MP['Junio']['Zona']['Zona1']['Estado']['Progreso']=0;
      $MP['Junio']['Zona']['Zona4']['Estado']['Abierto']=0;
      $MP['Junio']['Zona']['Zona4']['Estado']['Ejecutado']=0;
      $MP['Junio']['Zona']['Zona4']['Estado']['Progreso']=0;
      $MP['Julio']['Zona']['Zona1']['Estado']['Abierto']=0;
      $MP['Julio']['Zona']['Zona1']['Estado']['Ejecutado']=0;
      $MP['Julio']['Zona']['Zona1']['Estado']['Progreso']=0;
      $MP['Julio']['Zona']['Zona4']['Estado']['Abierto']=0;
      $MP['Julio']['Zona']['Zona4']['Estado']['Ejecutado']=0;
      $MP['Julio']['Zona']['Zona4']['Estado']['Progreso']=0;
      return $MP;
    }

}

?>
