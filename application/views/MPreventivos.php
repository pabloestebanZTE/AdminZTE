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
    <!-- graficas -->
  			<article id="content">
  				<div class="wrapper">
            <h2 class="under">Información General</h2>
  					<section class="col-1-2">
  					<div class="wrap-col">
  						<div class="wrapper pad_bot2">
                <div id="chartContainer" style="height: 300px; width: 100%;">
                </div>
  						</div>
  						<div class="wrapper">
                <div id="chartContainer3" style="height: 300px; width: 100%;">
                </div>
  						</div>
  					</div>
  					</section>

  					<section class="col-1-2">
  					<div class="wrap-col">
  						<div class="wrapper pad_bot2">
                <div id="chartContainer2" style="height: 300px; width: 100%;">
                </div>
  						</div>
  						<div class="wrapper">
                <div id="chartContainer4" style="height: 300px; width: 100%;">
                </div>
  						</div>
  					</div>
  					</section>
      <!-- fin graficas -->
      <!-- tablas -->
  					<div class="wrapper tabs">
              <?php
              if (isset($tablas)){
                $meses[1] = 'Enero';
                $meses[2] = 'Febrero';
                $meses[3] = 'Marzo';
                $meses[4] = 'Abril';
                $meses[5] = 'Mayo';
                $meses[6] = 'Junio';
                $meses[7] = 'Julio';

                echo "<br><br><br>";
                echo "<h2 class='under'>"."Resumen mensual de estados por Ticket".$meses[$p]."</h2>";
                echo "<ul class='nav'>";
                  echo "<center>";
                  for ($p = 1; $p <= count($meses); $p++){
                    if ($p == 1){
                      echo "<li class='selected'><a href='#tab".$p."'><center>".$meses[$p]."</center></a></li>";

                    } else {
                      echo "<li><a href='#tab".$p."'><center>".$meses[$p]."</center></a></li>";
                    }
                  }
                  echo "</center>";
                echo "</ul>";

                for ($p = 1; $p <= count($meses); $p++){
                  echo "<div class='tab-content' id='tab".$p."'>";
                    echo "<div class='wrapperTable'>";
                      //Tabla 1
                      echo "<h2 class='under'>"."Porcentaje de avance por zonas mes de ".$meses[$p]."</h2>";
                      echo "<div class='table'>";
                        echo "<div class='row header'>";
                        for ($i = 0; $i<count($tablas[$meses[$p]]['tabla1']['Titulos']); $i++){
                          echo "<div class='cell'>".$tablas[$meses[$p]]['tabla1']['Titulos'][$i]."</div>";
                        }
                        echo "</div>";
                        for ($i = 1; $i<count($tablas[$meses[$p]]['tabla1']); $i++){
                          echo "<div class='row'>";
                            for ($j = 0; $j<count($tablas[$meses[$p]]['tabla1']['linea'.$i]); $j++){
                              echo "<div class='cell'>".$tablas[$meses[$p]]['tabla1']['linea'.$i][$j]."</div>";
                            }
                          echo "</div>";
                        }
                      echo "</div>";

                      //Tabla 2
                      echo "<h2 class='under'>"."Avance Departamentos zonas 1 y 4 mes de ".$meses[$p]."</h2>";
                      echo "<div class='table'>";
                        echo "<div class='row header green'>";
                        for ($i = 0; $i<count($tablas[$meses[$p]]['tabla2']['Titulos']); $i++){
                          echo "<div class='cell'>".$tablas[$meses[$p]]['tabla2']['Titulos'][$i]."</div>";
                        }
                        echo "</div>";
                        for ($i = 0; $i<count($tablas[$meses[$p]]['tabla2']['ciudades']); $i++){
                          echo "<div class='row'>";
                          echo "<div class='cell'>".$tablas[$meses[$p]]['tabla2']['ciudades'][$i]."</div>";
                            for ($j = 0; $j<count($tablas[$meses[$p]]['tabla2'][$tablas[$meses[$p]]['tabla2']['ciudades'][$i]]); $j++){
                              echo "<div class='cell'>".$tablas[$meses[$p]]['tabla2'][$tablas[$meses[$p]]['tabla2']['ciudades'][$i]][$j]."</div>";
                            }
                          echo "</div>";
                        }
                      echo "</div>";

                      //Tabla 3
                      echo "<h2 class='under'>"."Detalle de tickets zona 1 y 4 mes de ".$meses[$p]."</h2>";
                      echo "<div class='table'>";
                        echo "<div class='row header blue'>";
                        for ($i = 0; $i<count($tablas[$meses[$p]]['tabla3']['Titulos']); $i++){
                          echo "<div class='cell'>".$tablas[$meses[$p]]['tabla3']['Titulos'][$i]."</div>";
                        }
                        echo "</div>";
                        for ($i = 0; $i<count($tablas[$meses[$p]]['tabla3']['lineas']); $i++){
                          echo "<div class='row'>";
                            for ($j = 0; $j<count($tablas[$meses[$p]]['tabla3']['lineas'][$i]); $j++){
                              echo "<div class='cell'>".$tablas[$meses[$p]]['tabla3']['lineas'][$i][$j]."</div>";
                            }
                          echo "</div>";
                        }
                      echo "</div>";
                    echo "</div>";
                  echo "</div>";
                }
              }
              ?>
            </div>

            <?php
            if($_SESSION['permissions'][6] == 1){
              echo "<section class='col-3-4'>";
                echo "<div class='wrap-col'>";
                  echo "<h2 class='under'>Ver todos los MP</h2>";
                  echo "<a href='/AdminZTE/index.php/Mantenimientos/editarMP' class='btn btn-primary' role='button' >Ver M.P.</a>";
                echo "</div>";
                echo "</section>";
            }
            ?>
  				</div>
  			</article>
  		</div>
  	</div>

      <!-- Fin tablas -->

    <?php
        echo "<script type='text/javascript'>PGEMP(".json_encode($MP).");</script>";
        echo "<script type='text/javascript'>PEMP(".json_encode($MP).");</script>";
        echo "<script type='text/javascript'>PGEMPln(".json_encode($MP).");</script>";
        echo "<script type='text/javascript'>PGEMPln2(".json_encode($MP).");</script>";
        if ($msg != ""){
          echo "<script type='text/javascript'>showMessage();</script>";
        }
    ?>

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
