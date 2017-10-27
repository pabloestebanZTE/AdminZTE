<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Mail_manager extends CI_Model{

        public function __construct(){
            $this->load->model('data/dao_ticket_model');
            $this->load->model('data/dao_maintenance_model');
            $this->load->model('data/dao_PVD_model');
            $this->load->model('data/configdb_model');
        }

        public function mailNotification($pvd){
          $ticket = $this->dao_ticket_model->getTicketByID($pvd);
          $maintenace = $this->dao_maintenance_model->getManPrePerID($ticket->getIdM());
          $pvd = $this->dao_PVD_model->getPVDbyId($maintenace->getIdPVD());
          echo "<br><br>";
          print_r($pvd);
          echo "<br><br>";

          print_r($maintenace);
          echo "<br><br>";

          print_r($ticket);

          if(explode(" ",$pvd->getRegion())[1] == 1){
            $destinatario = "coordinador.tecnico1@fonadeud.com.co";
          }

          if(explode(" ",$pvd->getRegion())[1] == 4){
            $destinatario = "coordinador.tecnico4@fonadeud.com.co,gioangar@gmail.com";
          }
          $asunto = "Finalización mantenimiento preventivo en el PVD ".$pvd->getId();
          $hearder = 'MIME-Version: 1.0' . "\r\n";
          $hearder .= 'Content-type: text/html; charset=utf-8' . "\r\n";
          $hearder .= "From: ZolidZTE";
          $cuerpo = "
          <html>
          <head>
             <title></title>
          </head>
          <body>
          <h1>Hola prueba</h1>
          <p>
          <b>Este es el correo  electrónico de prueba</b>. Esta es una prueba de envio de correo . Este es el cuerpo del mensaje, es una prueba sin envio de ninguna variable y pruebo enviando a dos destinatarios, ya no se que mas escrbirle al cuerpo para quede mas largo y lo pueda visualizar mejor.
          </p>
          </body>
          </html>
          ";
          echo "<br><br><br>";
          echo "correo enviado";
          mail($destinatario,$asunto,$cuerpo,$hearder);
          return "ok";
        }
    }
?>
