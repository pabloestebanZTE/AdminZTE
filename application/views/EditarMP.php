<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>M. Preventivos</title>
    <meta charset="utf-8">
    <link rel="icon" href="http://cellaron.com/media/wysiwyg/zte-mwc-2015-8-l-124x124.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/AdminZTE/assets/css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="/AdminZTE/assets/css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="/AdminZTE/assets/css/zerogrid.css">
    <link rel="stylesheet" href="/AdminZTE/assets/css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="/AdminZTE/assets/css/responsive.css">
    <link rel="stylesheet" href="/AdminZTE/assets/css/tablesStyles.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/AdminZTE/assets/js/jquery-1.6.js" ></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/cufon-yui.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/cufon-replace.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/Swis721_Cn_BT_400.font.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/Swis721_Cn_BT_700.font.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/tabs.js"></script>
    <script src="/AdminZTE/assets/js/css3-mediaqueries.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/css/canvasJS/canvasjs.min.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/css/canvasJS/Charts/Charts.js"></script>
    <link rel="stylesheet" href="/AdminZTE/assets/css/sweetalert/dist/sweetalert.css" />
    <script src="/AdminZTE/assets/css/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript" charset="utf-8" async defer>
        function showMessage(){
            var a = "<?php echo $msg[0]; ?>";
            var b = "<?php echo $msg[1]; ?>";
            var c = "<?php echo $msg[2]; ?>";
            sweetAlert(a, b, c);
        }
    </script>
    <script>
        function cambiarAtributo(x, f){
          for (var i = 0; i < x; i++){
            var dateField = document.getElementById(i+"-1");
            var dateField1 = document.getElementById(i+"-2");
            var dateField2 = document.getElementById(i+"-3");
            var dateField3 = document.getElementById(i+"-8");
            var dateField4 = document.getElementById(i+"-9");
            var dateField7 = document.getElementById(i+"-12");
            var dateField8 = document.getElementById(i+"-13");
            var dateField5 = document.getElementById(i+"-10");
            var dateField6 = document.getElementById(i+"-11");
            var dateField9 = document.getElementById(i+"-14");
            var dateField10 = document.getElementById(i+"-15");


            if (dateField != null){
              dateField.removeAttribute('disabled');
              dateField2.removeAttribute('disabled');
              dateField3.removeAttribute('disabled');
              dateField4.removeAttribute('disabled');
              dateField7.removeAttribute('disabled');
              dateField8.removeAttribute('disabled');
              try {
                dateField1.removeAttribute('disabled');
                dateField5.removeAttribute('disabled');
                dateField6.removeAttribute('disabled');
                dateField9.removeAttribute('disabled');
                dateField10.removeAttribute('disabled');
              }
              catch(err) {
                console.log("fieldNotFound");
              }
            }
          }
          var buttonField = document.getElementById("BEditar"+f);
          var buttonEnviar = document.getElementById("btnSubmit"+f);
          buttonEnviar.removeAttribute('disabled');
          buttonField.setAttribute("disabled","disabled");
        }
    </script>

  </head>

  <body id="page4">
  	<div class="body1">
  	<div class="body2">
  	<div class="body5">
  		<div class="main zerogrid">
  <!-- header -->
  			<header>
  				<div class="wrapper rơw">
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
                    echo "<li id='nav4' ><a href='/AdminZTE/index.php/Mantenimientos/loadMPView'>Preventivos<span>Mantenimientos</span></a></li>";
                  }
                  if($_SESSION['permissions'][2] == 1){
                    echo "<li id='nav4'><a href='/AdminZTE/index.php/MCorrectivos/verMC'>Correctivos<span>Mantenimientos</span></a></li>";
                  }
                  if($_SESSION['permissions'][4] == 1){
                    echo "<li id='nav2'><a href='#'>Facturacion<span>Facturas</span></a></li>";
                  }
                  if($_SESSION['permissions'][5] == 1){
                    echo "<li id='nav5'><a href='#''>ZTE<span>Plataforma</span></a></li>";
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
  	<div class="body3">
  		<div class="main zerogrid">
        <!-- content -->
  			<article id="content">
          <h2 class='under'>Mantenimientos Preventivos </h2>
          <div class="wrapper tabs">
            <?php
            if($_SESSION['permissions'][6] == 1){
              $meses[1] = 'Enero';
              $meses['numerico'][1]= 1;
              $meses[2] = 'Febrero';
              $meses['numerico'][2]= 2;
              $meses[3] = 'Marzo';
              $meses['numerico'][3]= 3;
              $meses[4] = 'Abril';
              $meses['numerico'][4]= 4;
              $meses[5] = 'Mayo';
              $meses['numerico'][5]= 5;
              $meses[6] = 'Junio';
              $meses['numerico'][6]= 6;
              $meses[7] = 'Julio';
              $meses['numerico'][7]= 7;

              echo "<ul class='nav'>";
                echo "<center>";
                for ($p = 1; $p <= count($meses)-1; $p++){
                  if ($p == 1){
                    echo "<li class='selected'><a href='#tab".$p."'><center>".$meses[$p]."</center></a></li>";

                  } else {
                    echo "<li><a href='#tab".$p."'><center>".$meses[$p]."</center></a></li>";
                  }
                }
                echo "</center>";
              echo "</ul>";
              echo "<br><br><br>";

              for ($p = 1; $p <= count($meses)-1; $p++){
                echo "<div class='tab-content' id='tab".$p."'>";
                  echo "<button value='Editar".$p."' name='BEditar".$p."' id='BEditar".$p."' type='button' class='btn btn-primary' onclick= 'cambiarAtributo(".count($PVDs).", ".$p.")'>Editar</button><br><br>";
                  echo "<form method='post' name='formActualizar'>";
                    echo "<input type='submit' value='Actualizar M.P.' disabled='disabled' id='btnSubmit".$p."' name='btnSubmit".$p."' class='btn btn-success'  onclick = \"this.form.action = 'http://localhost/AdminZTE/index.php/Mantenimientos/updateMP' \">";
                    echo "<br><br><br>";
                    echo "<div class='tableFix'>";
                      echo "<div class='row header green'>";
                        echo "<div class='cell' style='font-size:13px'>Región</div>";
                        echo "<div class='cell' style='font-size:13px'>Departamento</div>";
                        echo "<div class='cell' style='font-size:13px'>Ciudad</div>";
                        echo "<div class='cell' style='font-size:13px'>PVD</div>";
                        echo "<div class='cell' style='font-size:13px'>Programado</div>";
                        echo "<div class='cell' style='font-size:13px'>Ticket</div>";
                        echo "<div class='cell' style='font-size:13px'>Estado</div>";
                        echo "<div class='cell' style='font-size:13px'>Inicio IT</div>";
                        echo "<div class='cell' style='font-size:13px'>Fin IT</div>";
                        echo "<div class='cell' style='font-size:13px'>NombreTécnicoIT</div>";
                        echo "<div class='cell' style='font-size:13px'>NombreAuxiliarIT</div>";
                        echo "<div class='cell' style='font-size:13px'>Inicio AA</div>";
                        echo "<div class='cell' style='font-size:13px'>Fin AA</div>";
                        echo "<div class='cell' style='font-size:13px'>NombreTécnicoAA</div>";
                        echo "<div class='cell' style='font-size:13px'>NombreAuxiliarAA</div>";
                        echo "<div class='cell' style='font-size:13px'>InicioM</div>";
                        echo "<div class='cell' style='font-size:13px'>FinM</div>";
                        echo "<div class='cell' style='font-size:13px'>Duración</div>";
                      echo "</div>";
                      for ($i = 0; $i<count($PVDs); $i++){
                        $mes = explode("-",$PVDs[$i]->getMaintenance()[0]->getDate());
                        if($mes[1] == $meses['numerico'][$p]){

                            echo "<div class='row'>";
                                echo "<div class='cell' style='font-size:12px'>".$PVDs[$i]->getRegion()."</div>";
                                echo "<div class='cell' style='font-size:12px'>".$PVDs[$i]->getDepartment()."</div>";
                                echo "<div class='cell' style='font-size:12px'>".$PVDs[$i]->getCity()."</div>";
                                echo "<div class='cell' style='font-size:12px'>".$PVDs[$i]->getId()."</div>";
                                if($PVDs[$i]->getMaintenance() != NULL){
                                  echo "<div class='cell'><input style='font-size:12px' id='".$i."-1' size='9' type='date' name='".$i."-1' disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getDate()."'></div>";
                                  if($PVDs[$i]->getMaintenance()[0]->getTicket() != "No Ticket"){
                                    echo "<div class='cell'>".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getId()."</div>";
                                    if($PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getStatus() == "Ejecutado"){
                                      echo "<div class='cell'><select style='font-size:12px' name='".$i."-3' id='".$i."-3' name='".$i."-3' disabled='true' aria-describedby='basic-addon1'><option selected>Ejecutado</option><option>En Progreso</option><option>Cancelado</option></select></div>";
                                    }
                                    if($PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getStatus() == "En Progreso"){
                                      echo "<div class='cell'><select style='font-size:12px' name='".$i."-3' id='".$i."-3' name='".$i."-3' disabled='true' aria-describedby='basic-addon1'><option selected>Ejecutado</option><option selected>En Progreso</option><option>Cancelado</option></select></div>";
                                    }
                                    if($PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getStatus() == "Cancelado"){
                                      echo "<div class='cell'><select style='font-size:12px' name='".$i."-3' id='".$i."-3' name='".$i."-3' disabled='true' aria-describedby='basic-addon1'><option>Ejecutado</option><option selected>En Progreso</option><option selected>Cancelado</option></select></div>";
                                    }
                                    echo "<div class='cell'><input size='9' style='font-size:12px' type='date' id='".$i."-8'  name='".$i."-8' disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDateSIT()."'></div>";
                                    echo "<div class='cell'><input size='9' style='font-size:12px' type='date' id='".$i."-9'  name='".$i."-9' disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDateFIT()."'></div>";
                                    echo "<div class='cell' style='font-size:12px'>".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getTechs()['users']['IT_T']['N_NAME']." ".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getTechs()['users']['IT_T']['N_LASTNAME']."</div>";
                                    echo "<div class='cell' style='font-size:12px'>".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getTechs()['users']['IT_A']['N_NAME']." ".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getTechs()['users']['IT_A']['N_LASTNAME']."</div>";
                                    echo "<div class='cell'><input size='9' style='font-size:12px' type='date' id='".$i."-12'  name='".$i."-12' disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDateSAA()."'></div>";
                                    echo "<div class='cell'><input size='9' style='font-size:12px' type='date' id='".$i."-13'  name='".$i."-13' disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDateFAA()."'></div>";
                                    echo "<div class='cell' style='font-size:12px'>".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getTechs()['users']['AA_T']['N_NAME']." ".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getTechs()['users']['AA_T']['N_LASTNAME']."</div>";
                                    echo "<div class='cell' style='font-size:12px'>".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getTechs()['users']['AA_A']['N_NAME']." ".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getTechs()['users']['AA_A']['N_LASTNAME']."</div>";
                                    echo "<div class='cell'>".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDateS()."</div>";
                                    echo "<div class='cell'>".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDateF()."</div>";
                                    echo "<div class='cell'>".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDuracion()."</div>";
                                  } else {
                                    echo "<div class='cell'><input style='font-size:12px' id='".$i."-2' name='".$i."-2' disabled='true' aria-describedby='basic-addon1' value=''></div>";
                                    echo "<div class='cell'><select style='font-size:12px' name='".$i."-3' id='".$i."-3' name='".$i."-3' disabled='true' aria-describedby='basic-addon1'><option></option><option>Ejecutado</option><option>En Progreso</option></select></div>";



                                    echo "<div class='cell'><input size='9' style='font-size:12px' type='date' id='".$i."-8'  name='".$i."-8' disabled='true' aria-describedby='basic-addon1' value=''></div>";
                                    echo "<div class='cell'><input size='9' style='font-size:12px' type='date' id='".$i."-9'  name='".$i."-9' disabled='true' aria-describedby='basic-addon1' value=''></div>";
                                    echo "<div class='cell'><select style='font-size:12px' name='".$i."-10' id='".$i."-10' name='".$i."-10' disabled='true' aria-describedby='basic-addon1'>";
                                    echo "<option value='-1'></option>";
                                    for($j = 0; $j<count($users); $j++){
                                      echo "<option value='".$users[$j]->getName()." ".$users[$j]->getLastname()." / ".$users[$j]->getID()."'>".$users[$j]->getName()." ".$users[$j]->getLastname()."</option>";
                                    }
                                    echo "</select></div>";
                                    echo "<div class='cell'><select style='font-size:12px' name='".$i."-11' id='".$i."-11' name='".$i."-10' disabled='true' aria-describedby='basic-addon1'>";
                                    echo "<option value='-1'></option>";
                                    for($j = 0; $j<count($users); $j++){
                                      echo "<option value='".$users[$j]->getName()." ".$users[$j]->getLastname()." / ".$users[$j]->getID()."'>".$users[$j]->getName()." ".$users[$j]->getLastname()."</option>";
                                    }
                                    echo "</select></div>";
                                    echo "<div class='cell'><input size='9' style='font-size:12px' type='date' id='".$i."-12'  name='".$i."-12' disabled='true' aria-describedby='basic-addon1' value=''></div>";
                                    echo "<div class='cell'><input size='9' style='font-size:12px' type='date' id='".$i."-13'  name='".$i."-13' disabled='true' aria-describedby='basic-addon1' value=''></div>";
                                    echo "<div class='cell'><select style='font-size:12px' name='".$i."-10' id='".$i."-10' name='".$i."-10' disabled='true' aria-describedby='basic-addon1'>";
                                    echo "<option value='-1'></option>";
                                    for($j = 0; $j<count($users); $j++){
                                      echo "<option value='".$users[$j]->getName()." ".$users[$j]->getLastname()." / ".$users[$j]->getID()."'>".$users[$j]->getName()." ".$users[$j]->getLastname()."</option>";
                                    }
                                    echo "</select></div>";
                                    echo "<div class='cell'><select style='font-size:12px' name='".$i."-10' id='".$i."-10' name='".$i."-10' disabled='true' aria-describedby='basic-addon1'>";
                                    echo "<option value='-1'></option>";
                                    for($j = 0; $j<count($users); $j++){
                                      echo "<option value='".$users[$j]->getName()." ".$users[$j]->getLastname()." / ".$users[$j]->getID()."'>".$users[$j]->getName()." ".$users[$j]->getLastname()."</option>";
                                    }
                                    echo "</select></div>";
                                    echo "<div class='cell'></div>";
                                    echo "<div class='cell'></div>";
                                    echo "<div class='cell'></div>";
                                    }
                                  echo "<input id='idM".$i."' name='".$i."-7' type='hidden'  class='form-control' value='".$PVDs[$i]->getMaintenance()[0]->getId()."'>";
                                }
                                echo "<input id='cantidad' name='cantidad' type='hidden'  class='form-control' value='".count($PVDs)."'>";
                            echo "</div>";
                        }
                      }
                    echo "</div>";
                  echo "</form>";
                echo "</div>";
              }
            }
            ?>
          </div>
  			</article>
  		</div>
  	</div>

  	<div class="body4">
  		<div class="main zerogrid">
  			<article id="content2">
  				<div class="wrapper row">

  				</div>
  			</article>
  <!-- content end -->
  		</div>
  	</div>
    <script type="text/javascript"> Cufon.now(); </script>
    <script>
    	$(document).ready(function() {
    		tabs.init();
    	})
    </script>
  </body>
</html>
