<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>M. Correctivos ZTE-FONADE</title>
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
                    echo "<li id='nav4'><a href='/AdminZTE/index.php/Mantenimientos/loadMPView'>Preventivos<span>Mantenimientos</span></a></li>";
                  }
                  if($_SESSION['permissions'][2] == 1){
                    echo "<li id='nav4' class='active'><a >Correctivos<span>Mantenimientos</span></a></li>";
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

      <!-- tablas -->
            <?php
          //  echo "<select id='field4' name='field4' required>";
            echo "<br><br><a href='/AdminZTE/index.php/MCorrectivos/formMC' class='btn btn-primary' role='button' >Crear Mto. Correctivo</a>";

  					echo "<div class='wrapper tabs'>";
              echo "<h2 class='under'>"."Resumen mantenimientos correctivos".$meses[$p]."</h2>";
              echo "<div class='table2'>";
                echo "<div class='row header green'>";
                for ($i = 0; $i<count($titulosMCResumen); $i++){
                  echo "<div class='cell'>".$titulosMCResumen[$i]."</div>";
                }
                echo "</div>";
                for ($i = 1; $i<count($mc); $i++){
                  echo "<div class='row'>";
                    echo "<div class='cell'>".$mc[$i]->getId()."</div>";
                    echo "<div class='cell'>".$mc[$i]->getPVD()->getId()."</div>";
                    echo "<div class='cell'>".$mc[$i]->getPVD()->getRegion()."</div>";
                    echo "<div class='cell'>".$mc[$i]->getTicket()."</div>";
                    echo "<div class='cell'>".$mc[$i]->getSDate()."</div>";
                    echo "<div class='cell'>".$mc[$i]->getUser()->getName()." ".$mc[$i]->getUser()->getLastname()."</div>";
                    echo "</div>";
                }
              echo "</div>";
              echo "<a href='/AdminZTE/index.php/MCorrectivos/exportXL' class='btn btn-primary' role='button' >Actualizar Excel</a>";
            echo "</div>";
            ?>

  				</div>
  			</article>
  		</div>
  	</div>

      <!-- Fin tablas -->


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
