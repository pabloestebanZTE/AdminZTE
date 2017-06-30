<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  //    session_start();

  class dao_inventory_model extends CI_Model{
    public function __construct(){
      $this->load->model('data/configdb_model');
    }

    public function getEquipmentTypePVD($id_fase, $id_tipo, $id_pvd){
      if ($id_tipo == "A" || $id_tipo == "B" || $id_tipo == "C" || $id_tipo == "D"){
        $id_tipo = "Tipo ".$id_tipo;
      }
      $dbConnection = new configdb_model();
      $session = $dbConnection->openSession();
      $sql = "SELECT K_IDTYPOLOGY from typology where N_NAME = '".$id_tipo."';";
      if ($session != "false"){
        $result = $session->query($sql);
        $row = $result->fetch_assoc();
        $sql = "SELECT * FROM equipment_type where K_IDPHASE = ".$id_fase." and K_IDTYPOLOGY =".$row['K_IDTYPOLOGY'].";";
        $result = $session->query($sql);
        if ($result->num_rows > 0) {
          $i = 0;
          while($row = $result->fetch_assoc()) {
            $sql2 = "SELECT N_NAME FROM equipment_generic where K_IDEQUIPMENT_GENERIC = ".$row['K_IDEQUIPMENT_GENERIC'].";";
            $result2 = $session->query($sql2);
            $row2 = $result2->fetch_assoc();
            $row['N_NAME'] = $row2['N_NAME'];
            $respuesta[$i] = $row;
            $sql3 = "SELECT * from stuff where K_IDEQUIPMENT_GENERIC = ".$row['K_IDEQUIPMENT_GENERIC']." and K_IDPVD = ".$id_pvd.";";
            $result3 = $session->query($sql3);
            if ($result3->num_rows > 0) {
              $j = 0;
              while($row3 = $result3->fetch_assoc()) {
                $respuesta[$i]['inventario'][$j] = $row3;
                $j++;
              }
            } else {
              $respuesta[$i]['inventario'] = "NI";
            }
            $i++;
          }
        }
      } else {
        $respuesta = "Error de informacion";
      }
      return $respuesta;
    }

    public function getAllEquipment($id_fase, $id_tipo, $id_pvd){
      if ($id_tipo == "A" || $id_tipo == "B" || $id_tipo == "C" || $id_tipo == "D"){
        $id_tipo = "Tipo ".$id_tipo;
      }
      $dbConnection = new configdb_model();
      $session = $dbConnection->openSession();
      $sql = "SELECT K_IDTYPOLOGY from typology where N_NAME = '".$id_tipo."';";
      if ($session != "false"){
        $result = $session->query($sql);
        $row = $result->fetch_assoc();
        $sql = "SELECT * FROM equipment_type where K_IDPHASE = ".$id_fase." and K_IDTYPOLOGY =".$row['K_IDTYPOLOGY'].";";
        $result = $session->query($sql);
        if ($result->num_rows > 0) {
          $i = 0;
          while($row = $result->fetch_assoc()) {
            $sql2 = "SELECT N_NAME FROM equipment_generic where K_IDEQUIPMENT_GENERIC = ".$row['K_IDEQUIPMENT_GENERIC'].";";
            $result2 = $session->query($sql2);
            $row2 = $result2->fetch_assoc();
            $row['N_NAME'] = $row2['N_NAME'];
            $respuesta[$i] = $row;
            $sql3 =  "SELECT * FROM stuff_category WHERE K_IDEQUIPMENT_GENERIC = ".$row['K_IDEQUIPMENT_GENERIC'].";";
            $result3 = $session->query($sql3);
            if ($result3->num_rows > 0) {
              $j = 0;
              while($row3 = $result3->fetch_assoc()) {
                $respuesta[$i]['category'][$j] = $row3;
                $sql4 = "SELECT * FROM model where K_IDSTUFF_CATEGORY = ".$row3['K_IDSTUFF_CATEGORY'].";";
                $result4 = $session->query($sql4);
                  if ($result4->num_rows > 0) {
                    $k = 0;
                    while($row4 = $result4->fetch_assoc()) {
                      $sql5 = "SELECT * FROM manufacturer WHERE K_IDMANUFACTURER = ".$row4['K_IDMANUFACTURER'].";";
                      $result5 = $session->query($sql5);
                      $row5 = $result5->fetch_assoc();
                      $row4['K_IDMANUFACTURER'] = $row5;
                      $respuesta[$i]['category'][$j]['model'][$k] = $row4;
                      $k++;
                    }
                  }
                  $sql6 = "SELECT * FROM checklist where K_IDEQUIPMENT_GENERIC = ".$row['K_IDEQUIPMENT_GENERIC'].";";
                  $result6 = $session->query($sql6);
                  if ($result6->num_rows > 0) {
                    $l = 0;
                    while($row6 = $result6->fetch_assoc()) {
                      $sql7 = "SELECT * FROM item_checklist WHERE K_IDITEM_CHECKLIST = ".$row6['K_IDITEM_CHECKLIST'].";";
                      $result7 = $session->query($sql7);
                      $row7 = $result7->fetch_assoc();
                      $row6['K_IDITEM_CHECKLIST'] = $row7;
                      $respuesta[$i]['rutina'][$l] = $row6;
                      $l++;
                    }
                  }
                $j++;
              }
            }
        //    print_r($respuesta[$i]);
        //    echo "<br><br>";
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
