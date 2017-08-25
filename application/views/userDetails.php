<!DOCTYPE html>
<html lang="en">
<head>
<title>Personal</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="icon" href="http://cellaron.com/media/wysiwyg/zte-mwc-2015-8-l-124x124.png">
<link rel="stylesheet" href="/AdminZTE/assets/css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/zerogrid.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/responsive.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/forms.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/wheelmenu.css">
<link href="/AdminZTE/assets/css/index.css" rel="stylesheet">
<link rel="stylesheet" href="/AdminZTE/assets/css/sweetalert/dist/sweetalert.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/responsiveslides.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/multiTable.css">
<!--estilo ventana emergente-->
<link rel="stylesheet" href="/AdminZTE/assets/css/emergente.min.css">
<!--etiquetas de texto de iconos de menu-->
<link rel="stylesheet" href="/AdminZTE/assets/css/etiqueta.css">
<!-- CSS dopdown   -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teko:400,700">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script type="text/javascript" src="/AdminZTE/assets/js/jquery-1.6.js" ></script>
<script type="text/javascript" src="/AdminZTE/assets/js/cufon-yui.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/cufon-replace.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/Swis721_Cn_BT_400.font.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/Swis721_Cn_BT_700.font.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/tms-0.3.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/tms_presets.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/jcarousellite.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/script.js"></script>
<script src="/AdminZTE/assets/js/css3-mediaqueries.js"></script>
<script src="/AdminZTE/assets/js/responsiveslides.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/tabs.js"></script>
<script src="/AdminZTE/assets/css/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/jquery.wheelmenu.js"></script>
<!--JS dropdown-->
<link rel="stylesheet" href="/AdminZTE/assets/plugins/select2/select2.min.css">
<!--   CALENDAR JS    -->
<script src="/AdminZTE/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='/AdminZTE/assets/plugins/fullcalendar/lib/moment.min.js'></script>
  <link rel='stylesheet' href='/Datafill_OT/assets/plugins/fullcalendar/fullcalendar.css' />
  <script src='/AdminZTE/assets/plugins/fullcalendar/fullcalendar.js'></script>
  <script>
 

  var indiceFor;

      function loadCalendar() {
        $("#calendar").remove();
        $("#calendarDiv").append("<div id='calendar'></div>");

        var user = '<?php echo json_encode($user); ?>';
        var users = JSON.parse(user);
        console.log(users);
//console.log("'#"+users[7].idTicket[0].color);
        //console.log(users[7].idTicket[0].idMaintenance.idPVD.city);
        //console.log(users[i].idTicket[j].idMaintenance.idPVD.city);
       // console.log(users[7].idTicket[0].dateStart);
        var idUse = $("#persona option:selected").attr('value');
        for(var i = 0; i < users.length; i++){
          if(users[i].id == idUse){
              var ev = [];
              indiceFor = i;

            for(var j = 0; j < users[i].idTicket.length; j++){
              var color = "#"+users[i].idTicket[j].color;

                    if (users[i].idTicket[j].dateStartAA != null) {
                      var inicio = users[i].idTicket[j].dateStartAA;
                      var final = users[i].idTicket[j].dateFinishAA;
                    }
                    else if (users[i].idTicket[j].dateStartIT != null) {
                      var inicio = users[i].idTicket[j].dateStartIT;
                      var final = users[i].idTicket[j].dateFinishIT;
                    }
                    if (typeof inicio != 'undefined') {
                     ev[j] = {
                      title : users[i].idTicket[j].idMaintenance.idPVD.city,
                      start : inicio,
                      end : final,
                      color: color,
                      ticket: users[i].idTicket[j].id}; 
                    }else{
                      ev[j] = {
                      title : users[i].idTicket[j].idMaintenance.idPVD.city,
                      start : '0000-00-00',
                      color: color,
                      ticket: users[i].idTicket[j].id}; 
                    }
            }
          }
        }
        //console.log(ev);

        $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,listWeek'
                },
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: ev,

                eventClick: function(event, jsEvent, view) {
               //alert("hola\n" +event.title);
              $('#name').html(users[indiceFor].name+" "+users[indiceFor].lastname);
              $('#ticket').html("<b>ticket: </b><a href='/AdminZTE/index.php/Ticket/ticketODetails?k_ticket="+event.ticket+"'>"+event.ticket+"</a>");
              $('#modalEvento').modal();

              

            }
         });

      }



  </script>

</head>

<body id="page1">
<div class="body1">
  <div class="body2">
  <div class="body5">
    <div class="main zerogrid">
<!-- header -->
      <header>
        <div class="wrapper row">
        <h1><a id="logo"><img src="/AdminZTE/assets/images/logo.png" /></a></h1>
        <nav>
          <ul id="menu">
            <?php
              if ($_SESSION['permissions'] != NULL){
                echo "<li id='nav1'><a href='/AdminZTE/index.php/User/loadPrincipalView'>Bienvenid@<span>".$_SESSION['name']."</span></a></li>";
                if($_SESSION['permissions'][3] == 1){
                  echo "<li id='nav3'><a href='#'>PVD<span>HV</span></a></li>";
                }
                if($_SESSION['permissions'][1] == 1){
                  echo "<li id='nav4'><a href='/AdminZTE/index.php/Mantenimientos/loadMPView'>Preventivos<span>Mantenimientos</span></a></li>";
                }
                if($_SESSION['permissions'][2] == 1){
                  echo "<li id='nav4'><a href='/AdminZTE/index.php/MCorrectivos/formMC'>Correctivos<span>Mantenimientos</span></a></li>";
                }
                if($_SESSION['permissions'][4] == 1){
                  echo "<li id='nav2'><a href='#'>Facturacion<span>Facturas</span></a></li>";
                }
                if($_SESSION['permissions'][5] == 1){
                  echo "<li id='nav5'><a href='/AdminZTE/index.php/ZTEPlatform/platformZTE'>ZTE<span>Plataforma</span></a></li>";
                }
              }
            ?>
            <li id="nav6"><a href="/AdminZTE/index.php/welcome/index">Salir<span>Logout</span></a></li>
          </ul>
        </nav>
        </div>
      </header>
<!-- header end-->
    </div>
    </div>
  </div>
</div>
  
  <?php
  //print_r($user[3]);
      echo "<div class='box box-default'>";
        echo "<div class='box-body'>";
          echo "<div class='row'>";
            echo "<div class='col-md-8' style='margin-left: 17%;margin-top: 15px'>";
              echo "<div class='form-group'>";
                echo "<label>Selecciona Usuario</label>";
                echo "<select class='form-control select2' onchange='loadCalendar()' id='persona' style='width: 100%;'>";
                 for($i =0; $i < count($user); $i++){
                    if ($user[$i]->getIdTicket() != "" || $user[$i]->getIdTicket() != null) {
                        echo "<option value='".$user[$i]->getId()."'>".$user[$i]->getName()." ".$user[$i]->getLastname()."</option>";
                    }
                  }                  
                echo "</select>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
  
//echo "<script type='text/javascript'>loadCalendar();</script>";
  ?>

          </div>
      </div>

<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
</head>
<body>
<br><br><br>

<div id='calendarDiv'>
  <div id='calendar'></div>
</div>

<div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-primary" role="document">
      <div class="modal-content">
        <div class="modal-header bg-red">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h1 class="modal-title">Detalles del Evento</h1><br><br>


          <h3 id="name"></h3>
        </div>

            <div class="modal-body">
              <p id="ticket"></p>
              <p><b>region: </b></p>
              <p><b>departamento: </b></p>
              <p><b>ciudad: </b></p>
              <p><b>direccion: </b></p>
              <p><b>fecha inicio: </b></p>
              <p><b>fecha fin: </b></p>
              <p><b>PVD: </b></p>
            </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-defauld btn-block" id="btnCerrarModal" data-dismiss="modal">CERRAR</button>
        </div>
      </div>
    </div>
  </div>

<script src="/AdminZTE/assets/plugins/select2/select2.full.min.js"></script>
  <script>
    $(function () {
      $(".select2").select2();
    });
  </script>

</body>

</html>
