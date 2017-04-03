<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>M. Preventivos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/AdminZTE/assets/css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="/AdminZTE/assets/css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="/AdminZTE/assets/css/zerogrid.css">
    <link rel="stylesheet" href="/AdminZTE/assets/css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="/AdminZTE/assets/css/responsive.css">
    <link rel="stylesheet" href="/AdminZTE/assets/css/tablesStyles.css">
<!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->
    <script type="text/javascript" src="/AdminZTE/assets/js/jquery-1.6.js" ></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/cufon-yui.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/cufon-replace.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/Swis721_Cn_BT_400.font.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/Swis721_Cn_BT_700.font.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/tabs.js"></script>
    <script src="/AdminZTE/assets/js/css3-mediaqueries.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/css/canvasJS/canvasjs.min.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/css/canvasJS/Charts/Charts.js"></script>

    <script type="text/javascript">
      PGEMP();
      PGEMPln();
      PEMP();
      PGEMPln2();
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
              <li id="nav6"><a href="#">Salir<span>Logout</span></a></li>
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

  					<section class="col-1-1">
  					<div class="wrap-col">
  						<div class="wrapper pad_bot2">
                <?php
                    if(isset($tablas)){
                      echo "<div class='wrapperTable'>";

                        //Tabla 1
                        echo "<h2 class='under'>"."Porcentaje de avance por zonas mes de Marzo"."</h2>";
                        echo "<div class='table'>";
                          echo "<div class='row header'>";
                          for ($i = 0; $i<count($tablas['tabla1']['Titulos']); $i++){
                            echo "<div class='cell'>".$tablas['tabla1']['Titulos'][$i]."</div>";
                          }
                          echo "</div>";
                          for ($i = 1; $i<count($tablas['tabla1']); $i++){
                            echo "<div class='row'>";
                              for ($j = 0; $j<count($tablas['tabla1']['linea'.$i]); $j++){
                                echo "<div class='cell'>".$tablas['tabla1']['linea'.$i][$j]."</div>";
                              }
                            echo "</div>";
                          }
                        echo "</div>";

                        //Tabla 2
                        echo "<h2 class='under'>"."Avance Departamentos zonas 1 y 4 mes de Marzo"."</h2>";
                        echo "<div class='table'>";
                          echo "<div class='row header green'>";
                          for ($i = 0; $i<count($tablas['tabla2']['Titulos']); $i++){
                            echo "<div class='cell'>".$tablas['tabla2']['Titulos'][$i]."</div>";
                          }
                          echo "</div>";

                          for ($i = 0; $i<count($tablas['tabla2']['ciudades']); $i++){
                            echo "<div class='row'>";
                            echo "<div class='cell'>".$tablas['tabla2']['ciudades'][$i]."</div>";
                              for ($j = 0; $j<count($tablas['tabla2'][$tablas['tabla2']['ciudades'][$i]]); $j++){
                                echo "<div class='cell'>".$tablas['tabla2'][$tablas['tabla2']['ciudades'][$i]][$j]."</div>";
                              }
                            echo "</div>";
                          }
                        echo "</div>";

                        //Tabla 3
                        echo "<h2 class='under'>"."Detalle de tickets zona 1 y 4 mes de Marzo"."</h2>";
                        echo "<div class='table'>";
                          echo "<div class='row header blue'>";
                          for ($i = 0; $i<count($tablas['tabla3']['Titulos']); $i++){
                            echo "<div class='cell'>".$tablas['tabla3']['Titulos'][$i]."</div>";
                          }
                          echo "</div>";
                          for ($i = 0; $i<count($tablas['tabla3']['lineas']); $i++){
                            echo "<div class='row'>";
                              for ($j = 0; $j<count($tablas['tabla3']['lineas'][$i]); $j++){
                                echo "<div class='cell'>".$tablas['tabla3']['lineas'][$i][$j]."</div>";
                              }
                            echo "</div>";
                          }
                        echo "</div>";
                      echo "</div>";
                    //  print_r($tablas['tabla3']);
                    }
                 ?>
  						</div>
  					</div>
  					</section>

            <?php
              echo "<section class='col-3-4'>";
                echo "<div class='wrap-col'>";

                <h2 class="under">Actualizar</h2>
                <form id="ContactForm" method="post"  enctype="multipart/form-data">
                  <div id="divFileActividad" class="form-group">
                    <label for='fileActividad'>Archivo Adjunto:</label>
                    <input type="file" id='file' name="file" required/>
                  </div>
                  <div>
                    <?php
                      echo "<input type='submit' value='Subir Archivo' id='btnSubmit' class='btn btn-warning' onclick = \"this.form.action = 'http://localhost/AdminZTE/index.php/Mantenimientos/subirArchivoMP' \">";
                      echo "</br></br>";
                    ?>
                  </div>
                </form>
                <?php
                  echo "<a href='/AdminZTE/index.php/Mantenimientos/actualizarMP' class='btn btn-danger' role='button' >Actuzalizar B.D. M.P.</a>";
                ?>
                </div>
                </section>




             ?>
            <section class="col-3-4">
            <div class="wrap-col">
              <h2 class="under">Actualizar</h2>
              <form id="ContactForm" method="post"  enctype="multipart/form-data">
                <div id="divFileActividad" class="form-group">
                  <label for='fileActividad'>Archivo Adjunto:</label>
                  <input type="file" id='file' name="file" required/>
                </div>
                <div>
                  <?php
                    echo "<input type='submit' value='Subir Archivo' id='btnSubmit' class='btn btn-warning' onclick = \"this.form.action = 'http://localhost/AdminZTE/index.php/Mantenimientos/subirArchivoMP' \">";
                    echo "</br></br>";
                  ?>
                </div>
              </form>
              <?php
                echo "<a href='/AdminZTE/index.php/Mantenimientos/actualizarMP' class='btn btn-danger' role='button' >Actuzalizar B.D. M.P.</a>";
              ?>
              </div>
            </section>

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
  		<div class="main zerogrid">
  <!-- footer -->
  			<footer>
          <a href="#" target="_blank">ZTE </a> designed by <a href="#" target="_blank">ZTE Colombia</a><br>
  			</footer>
  <!-- footer end -->
  		</div>
  <script type="text/javascript"> Cufon.now(); </script>
  <script>
  	$(document).ready(function() {
  		tabs.init();
  	})
  </script>
  </body>
</html>
