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
    <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/AdminZTE/assets/css/index.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    <script type="text/javascript" src="/AdminZTE/assets/js/required/raphael.min.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/required/raphael.icons.js"></script>
    <script type="text/javascript" src="/AdminZTE/assets/js/dist/wheelnav.js"></script>
    <script type="text/javascript">

        window.onload = function () {
            new wheelnav("divWheelnav");
        };
        function showMessage(){
            var a = "<?php echo $msj[0]; ?>";
            var b = "<?php echo $msj[1]; ?>";
            var c = "<?php echo $msj[2]; ?>";
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
                    echo "<li id='nav4'><a href='/AdminZTE/index.php/Mantenimientos/loadMPView'>Preventivos<span>Mantenimientos</span></a></li>";
                  }
                  if($_SESSION['permissions'][2] == 1){
                    echo "<li id='nav4'><a href='/AdminZTE/index.php/MCorrectivos/verMC'>Correctivos<span>Mantenimientos</span></a></li>";
                  }
                  if($_SESSION['permissions'][4] == 1){
                    echo "<li id='nav2'><a href='#'>Facturacion<span>Facturas</span></a></li>";
                  }
                  if($_SESSION['permissions'][5] == 1){
                    echo "<li id='nav5' class='active'><a href='#''>ZTE<span>Plataforma</span></a></li>";
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
  			<article id="content">
  				<div class="wrapper">
            <?php
              if($_SESSION['permissions'][5] == 1){
                echo "<div id='divWheelnav' class='wheelNav' data-wheelnav data-wheelnav-slicepath='PieArrowSlice' data-wheelnav-colors='#00A3EE,#F5D908,#9C1A5B' data-wheelnav-navangle='90'>";
                    echo "<div data-wheelnav-navitemtext='KPIs'><a href='/AdminZTE/index.php/KPI/KPIPrincial'>href</a></div>";
                    echo "<label data-wheelnav-navitemtext='Procedimientos'>Elemento 2</label><br/>";
                    echo "<button data-wheelnav-navitemtext='Calidad' >Elemento 1</button>";
                echo "</div>";
                if (isset($kpis)){
                  echo "<a href='/AdminZTE/index.php/KPI/exportXL' class='btn btn-primary' role='button' >Ver KPI´s </a>";

                  echo "<div class='wrapper tabs'>";
                    echo "<br>";
                    echo "<h2 class='under'>"."Lista de KPI´s"."</h2>";
                    echo "<div class='table'>";
                      echo "<div class='row header'>";
                        echo "<div class='cell'>Nombre</div>";
                        echo "<div class='cell'>Descripcion</div>";
                      echo "</div>";
                      for ($i = 1; $i<count($kpis); $i++){
                        echo "<div class='row'>";
                          echo "<div class='cell'><a href='/AdminZTE/index.php/KPI/evaluateKPI?k_kpi=".$kpis[$i]['K_IDKPI']."'>".$kpis[$i]['N_NAME']."</a></div>";
                          echo "<div class='cell'>".$kpis[$i]['N_DESCRIPTION']."</div>";
                        echo "</div>";
                      }
                    echo "</div>";
                  echo "</div>";
                }


                for($i = 0; $i< count($kpis); $i++){
                  print_r($kpis[$i]);
                  echo "<br><br>";
                }


              }
              if ($msj != ""){
                echo "<script type='text/javascript'>showMessage();</script>";
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
