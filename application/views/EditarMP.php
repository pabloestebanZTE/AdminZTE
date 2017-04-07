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
        function cambiarAtributo(x){
          for (var i = 0; i < x; i++){
            var dateField = document.getElementById(i+"-1");
            var dateField1 = document.getElementById(i+"-2");
            var dateField2 = document.getElementById(i+"-3");
            var dateField3 = document.getElementById(i+"-4");
            var dateField4 = document.getElementById(i+"-5");
            var dateField5 = document.getElementById(i+"-6");

            if (dateField != null){
              dateField.removeAttribute('disabled');
              dateField1.removeAttribute('disabled');
              dateField2.removeAttribute('disabled');
              dateField3.removeAttribute('disabled');
              dateField4.removeAttribute('disabled');
              dateField5.removeAttribute('disabled');
            }
          }
          var buttonField = document.getElementById("BEditar");
      //    var buttonEnviar = document.getElementById("btnSubmit");
//    buttonEnviar.removeAttribute('disabled');
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
                    echo "<li id='nav4' class='active'><a>Preventivos<span>Mantenimientos</span></a></li>";
                  }
                  if($_SESSION['permissions'][2] == 1){
                    echo "<li id='nav4'><a href='#'>Correctivos<span>Mantenimientos</span></a></li>";
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
          <?php
          if($_SESSION['permissions'][6] == 1){
            echo "<h2 class='under'>"."Mantenimientos Preventivos </h2>";
            echo "<button value='Editar' name='BEditar' id='BEditar' type='button' class='btn btn-primary' onclick= 'cambiarAtributo(".count($PVDs).")'>Editar</button><br><br>";
            echo "<div class='table'>";
              echo "<div class='row header green'>";
                echo "<div class='cell'>Región</div>";
                echo "<div class='cell'>Departamento</div>";
                echo "<div class='cell'>Ciudad</div>";
                echo "<div class='cell'>PVD</div>";
                echo "<div class='cell'>Programado</div>";
                echo "<div class='cell'>Ticket</div>";
                echo "<div class='cell'>Estado</div>";
                echo "<div class='cell'>Inicio</div>";
                echo "<div class='cell'>Fin</div>";
                echo "<div class='cell'>Duración</div>";
              echo "</div>";
              for ($i = 0; $i<count($PVDs); $i++){
                echo "<div class='row'>";
                    echo "<div class='cell'>".$PVDs[$i]->getRegion()."</div>";
                    echo "<div class='cell'>".$PVDs[$i]->getDepartment()."</div>";
                    echo "<div class='cell'>".$PVDs[$i]->getCity()."</div>";
                    echo "<div class='cell'>".$PVDs[$i]->getId()."</div>";
                    if($PVDs[$i]->getMaintenance() != NULL){
                      echo "<div class='cell'><input id='".$i."-1' name='".$i."-1' size=12 disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getDate()."'></div>";
                      if($PVDs[$i]->getMaintenance()[0]->getTicket() != "No Ticket"){
                        echo "<div class='cell'><input id='".$i."-2' name='".$i."-2' size=14 disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getId()."'></div>";
                        if($PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getStatus() == "Cerrado"){
                          echo "<div class='cell'><select name='transporte' id='".$i."-3' name='".$i."-3' disabled='true' aria-describedby='basic-addon1'><option selected>Cerrado</option><option>En Progreso</option></select></div>";
                        }
                        if($PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getStatus() == "En Progreso"){
                          echo "<div class='cell'><select name='transporte' id='".$i."-3' name='".$i."-3' disabled='true' aria-describedby='basic-addon1'><option selected>Cerrado</option><option selected>En Progreso</option></select></div>";
                        }
                        echo "<div class='cell'><input type='date' id='".$i."-4' name='".$i."-4' size=12 disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDateS()."'></div>";
                        echo "<div class='cell'><input type='date' id='".$i."-5' name='".$i."-5' size=12 disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDateF()."'></div>";
                        echo "<div class='cell'><input id='".$i."-6' name='".$i."-6' size='8' disabled='true' aria-describedby='basic-addon1' value='".$PVDs[$i]->getMaintenance()[0]->getTicket()[0]->getDuracion()."'></div>";
                      } else {
                        echo "<div class='cell'><input id='".$i."-2' name='".$i."-2' size=14 disabled='true' aria-describedby='basic-addon1' value=''></div>";
                        echo "<div class='cell'><select name='transporte' id='".$i."-3' name='".$i."-3' disabled='true' aria-describedby='basic-addon1'><option></option><option>Cerrado</option><option>En Progreso</option></select></div>";
                        echo "<div class='cell'><input type='date' id='".$i."-4' name='".$i."-4' size=12 disabled='true' aria-describedby='basic-addon1' value=''></div>";
                        echo "<div class='cell'><input type='date' id='".$i."-5' name='".$i."-5' size=12 disabled='true' aria-describedby='basic-addon1' value=''></div>";
                        echo "<div class='cell'><input id='".$i."-6' name='".$i."-6' size='8' disabled='true' aria-describedby='basic-addon1' value=''></div>";
                      }
                    } else {
                      echo "<div class='cell'><input id='".$i."-1' name='".$i."-1' size=12 disabled='true' aria-describedby='basic-addon1' value=''></div>";
                      echo "<div class='cell'><input id='".$i."-2' name='".$i."-2' size=14 disabled='true' aria-describedby='basic-addon1' value=''></div>";
                      echo "<div class='cell'><select name='transporte' id='".$i."-3' name='".$i."-3' disabled='true' aria-describedby='basic-addon1'><option></option><option>Cerrado</option><option>En Progreso</option></select></div>";
                      echo "<div class='cell'><input type='date' id='".$i."-4' name='".$i."-4' size=12 disabled='true' aria-describedby='basic-addon1' value=''></div>";
                      echo "<div class='cell'><input type='date' id='".$i."-5' name='".$i."-5' size=12 disabled='true' aria-describedby='basic-addon1' value=''></div>";
                      echo "<div class='cell'><input id='".$i."-6' name='".$i."-6' size='8' disabled='true' aria-describedby='basic-addon1' value=''></div>";
                    }
                echo "</div>";
              }
            echo "</div>";
          }
          ?>
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
