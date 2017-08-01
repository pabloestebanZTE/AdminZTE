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

    <script type="text/javascript" charset="utf-8">
        function showMessage(){
            var a = "<?php echo $msg[0]; ?>";
            var b = "<?php echo $msg[1]; ?>";
            var c = "<?php echo $msg[2]; ?>";
            sweetAlert(a, b, c);
        }

        function modalEditar(idpvd, city, deparment, region, direction, tipo, idT, estado, fechaI, fechaF, fechaIIT, fechaIAA, fechaFIT, fechaFAA, duracion, color, users){
          $('#idpvd').val("");
          $('#ciudad').val("");
          $('#departamento').val("");
          $('#region').val("");
          $('#direccion').val("");
          $('#tipo').val("");
          $('#idticket').val("");
          $('#estado').val("");
          $('#fechai').val("");
          $('#fechaf').val("");
          $('#duracion').val("");
          $('#fechaiit').val("");
          $('#fechafit').val("");
          $('#fechaiaa').val("");
          $('#fechafaa').val("");
          $('#tit').val("");
          $('#ait').val("");
          $('#taa').val("");
          $('#aaa').val("");

          $('#idpvd').val(idpvd);
          $('#ciudad').val(city);
          $('#departamento').val(deparment);
          $('#region').val(region);
          $('#direccion').val(direction);
          $('#tipo').val(tipo);
          $('#idticket').val(idT);
          $('#estado').val(estado);
          $('#fechai').val(fechaI);
          $('#fechaf').val(fechaF);
          $('#duracion').val(duracion);
          $('#fechaiit').val(fechaIIT);
          $('#fechafit').val(fechaFIT);
          $('#fechaiaa').val(fechaFAA);
          $('#fechafaa').val(fechaFAA);

          $("#link").attr("href", "/AdminZTE/index.php/Ticket/ticketDetails?k_ticket="+idT);

          try {
              $('#tit').val(users.users.IT_T.N_NAME+" "+users.users.IT_T.N_LASTNAME);
          } catch (e) {
            console.log("no tit");
          }
          try {
              $('#ait').val(users.users.IT_A.N_NAME+" "+users.users.IT_A.N_LASTNAME);
          } catch (e) {
            console.log("no ait");
          }
          try {
              $('#taa').val(users.users.AA_T.N_NAME+" "+users.users.AA_T.N_LASTNAME);
          } catch (e) {
            console.log("no taa");
          }
          try {
              $('#aaa').val(users.users.AA_A.N_NAME+" "+users.users.AA_A.N_LASTNAME);
          } catch (e) {
            console.log("no aaa");
          }
          $('#myModal').modal('show');
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
                    echo "<li id='nav4'><a href='/AdminZTE/index.php/MCorrectivos/verMC'>Correctivos<span>Mantenimientos</span></a></li>";
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
              if($_SESSION['permissions'][1] == 1){
                if (isset($tablas)){
                  $meses[1] = 'Enero';
                  $meses[2] = 'Febrero';
                  $meses[3] = 'Marzo';
                  $meses[4] = 'Abril';
                  $meses[5] = 'Mayo';
                  $meses[6] = 'Junio';
                  $meses[7] = 'Julio';
                  $meses[8] = 'Agosto';

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
                        echo "<div class='table' id='table1-".$p."'>";
                          echo "<div class='row header blue'>";
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
                        echo "<tbody></div>";

                        //Tabla 2
                        echo "<h2 class='under'>"."Avance Departamentos zonas 1 y 4 mes de ".$meses[$p]."</h2>";
                        echo "<div class='table' id='table2-".$p."'>";
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
                        echo "<table id='table3-".$p."'>";
                          echo "<thead>  <tr>";
                          for ($i = 0; $i<count($tablas[$meses[$p]]['tabla3']['Titulos']); $i++){
                            echo "<th>".$tablas[$meses[$p]]['tabla3']['Titulos'][$i]."</th>";
                          }
                          echo "<tr></thead><tbody>";
                          for ($i = 0; $i<count($tablas[$meses[$p]]['tabla3']['lineas']); $i++){
                            echo "<tr>";
                              for ($j = 0; $j<count($tablas[$meses[$p]]['tabla3']['lineas'][$i]); $j++){
                                if ($j == 6){
                                  for($l = 0; $l < count($PVDs); $l++){
                                    if($tablas[$meses[$p]]['tabla3']['lineas'][$i][4] == $PVDs[$l]->getId()){
                                      echo "<td><a onclick='modalEditar(".json_encode($PVDs[$l]->getId()).",".json_encode($PVDs[$l]->getCity()).",".json_encode($PVDs[$l]->getDepartment()).",".json_encode($PVDs[$l]->getRegion()).",".json_encode($PVDs[$l]->getDireccion()).",".
                                      json_encode($PVDs[$l]->getTipologia()).",".json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getId()).",".json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getStatus()).",".json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getDateS()).",".
                                      json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getDateF()).",".json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getDateSIT()).",".json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getDateSAA()).",".
                                      json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getDateFIT()).",".json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getDateFAA()).",".json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getDuracion()).",".
                                      json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getColor()).",".json_encode($PVDs[$l]->getMaintenance()[0]->getTicket()[0]->getTechs()).")'>".$tablas[$meses[$p]]['tabla3']['lineas'][$i][$j]."</a></td>";
                                    }
                                  }
                                } else {
                                  if($j == 0){
                                    if($tablas[$meses[$p]]['tabla3']['lineas'][$i][$j] != null){
                                      echo "<td><div style='width: 20px; height: 20px; border-radius: 50%; background: #".$tablas[$meses[$p]]['tabla3']['lineas'][$i][$j]."; '>&nbsp;</div></td>";
                                    } else {
                                      echo "<td><div style='width: 20px; height: 20px; border-radius: 50%; background: #FFFFFF; border: solid black 1px;'>&nbsp;</div></td>";
                                    }
                                  }else{
                                    echo "<td>".$tablas[$meses[$p]]['tabla3']['lineas'][$i][$j]."</td>";
                                  }
                                }
                              }
                            echo "</tr>";
                          }
                        echo "</tbody></table>";
                      echo "</div>";
                    echo "</div>";
                  }
                }
              }
              ?>
            </div>
  				</div>
  			</article>
  		</div>
  	</div>

      <!-- Fin tablas -->

    <?php
    if($_SESSION['permissions'][1] == 1){
      if(isset($MP)){
        echo "<script type='text/javascript'>PGEMP(".json_encode($MP).");</script>";
        echo "<script type='text/javascript'>PEMP(".json_encode($MP).");</script>";
        echo "<script type='text/javascript'>PGEMPln(".json_encode($MP).");</script>";
        echo "<script type='text/javascript'>PGEMPln2(".json_encode($MP).");</script>";
        if ($msg != ""){
          echo "<script type='text/javascript'>showMessage();</script>";
        }
      }
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


        <!-- MODAL MP -->
        <div id="myModal" class="modal fade" role="dialog">
          <section id="contact">
          			<div class="contact-section">
          			<div class="container">
          				<form>
          					<div class="col-md-6 form-line">
          			  			<div class="form-group">
          			  				<label for="exampleInputUsername">Id PVD :</label>
          					    	<input type="text" class="form-control" id="idpvd" name="idPVD" disabled="disabled">
          				  		</div>
          				  		<div class="form-group">
          					    	<label for="exampleInputEmail">Región :</label>
          					    	<input type="email" class="form-control" id="region" name="region" disabled="disabled">
          					  	</div>
          					  	<div class="form-group">
          					    	<label for="telephone">Departamento :</label>
          					    	<input type="tel" class="form-control" id="departamento" name="dep" disabled="disabled">
          			  			</div>
          					  	<div class="form-group">
          					    	<label for="telephone">Ciudad :</label>
          					    	<input type="tel" class="form-control" id="ciudad" name="ciudad" disabled="disabled">
          			  			</div>
          					  	<div class="form-group">
          					    	<label for="telephone">Dirección :</label>
          					    	<input type="tel" class="form-control" id="direccion" name="direccion" disabled="disabled">
          			  			</div>
          					  	<div class="form-group">
          					    	<label for="telephone">Tipologia :</label>
          					    	<input type="tel" class="form-control" id="tipo" name="tipo" disabled="disabled">
          			  			</div>
          			  	</div>
                    <div class="col-md-6 form-line">
          			  			<div class="form-group">
          			  				<label for="exampleInputUsername">Id Ticket :</label>
          					    	<input type="text" class="form-control" id="idticket" name="idticket" disabled="disabled">
          				  		</div>
          				  		<div class="form-group">
          					    	<label for="exampleInputEmail">Estado :</label>
          					    	<input type="email" class="form-control" id="estado" name="estado" disabled="disabled">
          					  	</div>
          					  	<div class="form-group">
          					    	<label for="telephone">Fecha Inicio :</label>
          					    	<input type="tel" class="form-control" id="fechai" name="fechai" disabled="disabled">
          			  			</div>
          					    <div class="form-group">
          					    	<label for="telephone">Fecha Fin :</label>
          					    	<input type="tel" class="form-control" id="fechaf" name="fechaf" disabled="disabled">
          			  			</div>
                        <div class="form-group">
          					    	<label for="telephone">Duración :</label>
          					    	<input type="tel" class="form-control" id="duracion" name="duracion" disabled="disabled">
          			  			</div>
          			  	</div>
                    <div class="col-md-6 form-line">
                        <div class="form-group">
                          <label for="exampleInputUsername">Técnico IT :</label>
                          <input type="text" class="form-control" id="tit" name="tit" disabled="disabled">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail">Auxiliar IT :</label>
                          <input type="email" class="form-control" id="ait" name="ait" disabled="disabled">
                        </div>
                        <div class="form-group">
                          <label for="telephone">Fecha Inicio IT :</label>
                          <input type="tel" class="form-control" id="fechaiit" name="fechaiit" disabled="disabled">
                        </div>
                        <div class="form-group">
                          <label for="telephone">Fecha Fin IT :</label>
                          <input type="tel" class="form-control" id="fechafit" name="fechafit" disabled="disabled">
                        </div>
                        <br><br><br><br><br><br>
                        <a href="#" class="btn btn-success" role="button" id="link" name="link">Más detalles</a>
                    </div>
          			  	<div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputUsername">Técnico AA :</label>
                        <input type="text" class="form-control" id="taa" name="taa" disabled="disabled">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail">Auxiliar AA :</label>
                        <input type="email" class="form-control" id="aaa" name="aaa" disabled="disabled">
                      </div>
                      <div class="form-group">
                        <label for="telephone">Fecha Inicio AA :</label>
                        <input type="tel" class="form-control" id="fechaiaa" name="fechaiaa" disabled="disabled">
                      </div>
                      <div class="form-group">
                        <label for="telephone">Fecha Fin AA :</label>
                        <input type="tel" class="form-control" id="fechafaa" name="fechafaa" disabled="disabled">
                      </div>
                      <br><br><br><br><br><br>
                        <button type="button" class="btn btn-default submit" data-dismiss="modal"><i class="fa fa-paper-plane" aria-hidden="true"></i> Volver</button>
                    </div>
          				</form>
          			</div>
              </div>

          		</section>
            </div>

    <script type="text/javascript"> Cufon.now(); </script>
    <script>
    	$(document).ready(function() {
    		tabs.init();
    	})
    </script>
    <script src="/AdminZTE/assets/js/tablefilter.js"></script>
    <link rel="stylesheet" type="text/css" href="/AdminZTE/assets/css/style/tablefilter.css">
    <script data-config>
      var filtersConfig = {
        col_0: "none",
        col_1: "none",
        col_10: "none",
        base_path: '/AdminZTE/assets/css/',
        filters_row_index: 1,
        alternate_rows: true,
        grid_cont_css_class: 'grd-main-cont',
        grid_tblHead_cont_css_class: 'grd-head-cont',
        grid_tbl_cont_css_class: 'grd-cont',
		    loader: true
      };
        var tf1 = new TableFilter('table3-1', filtersConfig);
        tf1.init();
        var tf2 = new TableFilter('table3-2', filtersConfig);
        tf2.init();
        var tf3 = new TableFilter('table3-3', filtersConfig);
        tf3.init();
        var tf4 = new TableFilter('table3-4', filtersConfig);
        tf4.init();
        var tf5 = new TableFilter('table3-5', filtersConfig);
        tf5.init();
        var tf6 = new TableFilter('table3-6', filtersConfig);
        tf6.init();
        var tf7 = new TableFilter('table3-7', filtersConfig);
        tf7.init();
    </script>
  </body>
</html>
