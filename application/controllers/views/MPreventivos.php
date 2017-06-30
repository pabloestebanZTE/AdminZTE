<!DOCTYPE html>
  <html lang="en">
  <head>
    <title>M. Preventivos</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="icon" href="http://cellaron.com/media/wysiwyg/zte-mwc-2015-8-l-124x124.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/assets/css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="/assets/css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="/assets/css/zerogrid.css">
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link rel="stylesheet" href="/assets/css/tablesStyles.css">
    <link rel="stylesheet" type="text/css" href="/assets/js/style/tablefilter.css">

    <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script type="text/javascript" src="/assets/js/tablefilter.js"></script>
    <script type="text/javascript" src="/assets/js/cufon-yui.js"></script>
    <script type="text/javascript" src="/assets/js/cufon-replace.js"></script>
    <script type="text/javascript" src="/assets/js/Swis721_Cn_BT_400.font.js"></script>
    <script type="text/javascript" src="/assets/js/Swis721_Cn_BT_700.font.js"></script>
    <script type="text/javascript" src="/assets/js/tabs.js"></script>
    <script src="/assets/js/css3-mediaqueries.js"></script>
    <script type="text/javascript" src="/assets/css/canvasJS/canvasjs.min.js"></script>
    <script type="text/javascript" src="/assets/css/canvasJS/charts/Charts.js"></script>
    <link rel="stylesheet" href="/assets/css/sweetalert/dist/sweetalert.css" />
    <script src="/assets/css/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript" charset="utf-8" async defer>
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
          $("#link").attr("href", "/index.php/Ticket/ticketDetails?k_ticket="+idT);
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

        function PEMP() {
          var planeado = [
          {label: "Enero", y: <?php echo $MP['Enero']['Zona']['Zona4']['Estado']['Abierto']+$MP['Enero']['Zona']['Zona4']['Estado']['Ejecutado']+$MP['Enero']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Febrero", y: <?php echo $MP['Febrero']['Zona']['Zona4']['Estado']['Abierto']+$MP['Febrero']['Zona']['Zona4']['Estado']['Ejecutado']+$MP['Febrero']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Marzo", y: <?php echo $MP['Marzo']['Zona']['Zona4']['Estado']['Abierto']+$MP['Marzo']['Zona']['Zona4']['Estado']['Ejecutado']+$MP['Marzo']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Abril", y: <?php echo $MP['Abril']['Zona']['Zona4']['Estado']['Abierto']+$MP['Abril']['Zona']['Zona4']['Estado']['Ejecutado']+$MP['Abril']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Mayo", y: <?php echo $MP['Mayo']['Zona']['Zona4']['Estado']['Abierto']+$MP['Mayo']['Zona']['Zona4']['Estado']['Ejecutado']+$MP['Mayo']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Junio", y: <?php echo $MP['Junio']['Zona']['Zona4']['Estado']['Abierto']+$MP['Junio']['Zona']['Zona4']['Estado']['Ejecutado']+$MP['Junio']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Julio", y: <?php echo $MP['Julio']['Zona']['Zona4']['Estado']['Abierto']+$MP['Julio']['Zona']['Zona4']['Estado']['Ejecutado']+$MP['Julio']['Zona']['Zona4']['Estado']['Progreso']; ?>}
          ]

          var progreso = [
          {label: "Enero", y: <?php echo $MP['Enero']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Febrero", y: <?php echo $MP['Febrero']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Marzo", y: <?php echo $MP['Marzo']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Abril", y: <?php echo $MP['Abril']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Mayo", y: <?php echo $MP['Mayo']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Junio", y: <?php echo $MP['Junio']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          {label: "Julio", y: <?php echo $MP['Julio']['Zona']['Zona4']['Estado']['Progreso']; ?>},
          ]

          var ejecutado = [
          {label: "Enero", y: <?php echo $MP['Enero']['Zona']['Zona4']['Estado']['Ejecutado']; ?>},
          {label: "Febrero", y: <?php echo $MP['Febrero']['Zona']['Zona4']['Estado']['Ejecutado']; ?>},
          {label: "Marzo", y: <?php echo $MP['Marzo']['Zona']['Zona4']['Estado']['Ejecutado']; ?>},
          {label: "Abril", y: <?php echo $MP['Abril']['Zona']['Zona4']['Estado']['Ejecutado']; ?>},
          {label: "Mayo", y: <?php echo $MP['Mayo']['Zona']['Zona4']['Estado']['Ejecutado']; ?>},
          {label: "Junio", y: <?php echo $MP['Junio']['Zona']['Zona4']['Estado']['Ejecutado']; ?>},
          {label: "Julio", y: <?php echo $MP['Julio']['Zona']['Zona4']['Estado']['Ejecutado']; ?>},
          ]

        var chart = new CanvasJS.Chart("chartContainer4",
            {
              theme: "theme3",
              animationEnabled: true,
              title:{
                text: "Mantenimientos Preventivos Zona 4",
                fontSize: 25
              },
              toolTip: {
                shared: true
              },
              axisY: {
                title: "Manteniminetos"
              },
              data: [
              {
                type: "column",
                name: "Planeado",
                legendText: "Planeados",
                showInLegend: true,
                dataPoints:planeado
              },
              {
                type: "column",
                name: "Ejecutado",
                legendText: "Ejecutados",
                showInLegend: true,
                dataPoints:ejecutado
              },
              {
                type: "column",
                name: "En Progreso",
                legendText: "En Progreso",
                showInLegend: true,
                dataPoints:progreso
              }

              ],
                  legend:{
                    cursor:"pointer",
                    itemclick: function PEMP(e){
                      if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                      }
                      else {
                        e.dataSeries.visible = true;
                      }
                      chart.render();
                    }
                  },
                });
              chart.render();
        }


        function PGEMP() {

          var datos1 = [
            {  y: <?php echo $MP['Enero']['contador']; ?>, label: "Enero"},
            {  y: <?php echo $MP['Febrero']['contador']; ?>, label: "Febrero" },
            {  y: <?php echo $MP['Marzo']['contador']; ?>, label: "Marzo" },
            {  y: <?php echo $MP['Abril']['contador']; ?>, label: "Abril" },
            {  y: <?php echo $MP['Mayo']['contador']; ?>, label: "Mayo"},
            {  y: <?php echo $MP['Junio']['contador']; ?>, label: "Junio"},
            {  y: <?php echo $MP['Julio']['contador']; ?>, label: "Julio"}
          ];

        var chart = new CanvasJS.Chart("chartContainer",
            {
            title:{
            text: "Plan General Consorcio Ejecución de Manteniminetos Preventivos",
            fontSize: 22
            },
            axisY:{
              title:"Manteniminetos"
            },
            animationEnabled: true,
            data: [
            {
              type: "stackedColumn",
              toolTipContent: "{label}<br/><span style='\"'color: {color};'\"'><strong>{name}</strong></span>: {y} Manteniminetos",
              name: "Mantenimientos Mensuales",
              dataPoints: datos1
             }
            ]
            ,
            legend:{
              cursor:"pointer",
              itemclick: function PGEMP(e) {
                if (typeof (e.dataSeries.visible) ===  "undefined" || e.dataSeries.visible) {
                  e.dataSeries.visible = false;
                }
                else
                {
                  e.dataSeries.visible = true;
                }
                chart.render();
              }
            }
            });
            chart.render();
        }


        function PGEMPln() {
          var planeado = [
          {label: "Enero", y: <?php echo $MP['Enero']['Zona']['Zona1']['Estado']['Abierto']+$MP['Enero']['Zona']['Zona1']['Estado']['Ejecutado']+$MP['Enero']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Febrero", y: <?php echo $MP['Febrero']['Zona']['Zona1']['Estado']['Abierto']+$MP['Febrero']['Zona']['Zona1']['Estado']['Ejecutado']+$MP['Febrero']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Marzo", y: <?php echo $MP['Marzo']['Zona']['Zona1']['Estado']['Abierto']+$MP['Marzo']['Zona']['Zona1']['Estado']['Ejecutado']+$MP['Marzo']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Abril", y: <?php echo $MP['Abril']['Zona']['Zona1']['Estado']['Abierto']+$MP['Abril']['Zona']['Zona1']['Estado']['Ejecutado']+$MP['Abril']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Mayo", y: <?php echo $MP['Mayo']['Zona']['Zona1']['Estado']['Abierto']+$MP['Mayo']['Zona']['Zona1']['Estado']['Ejecutado']+$MP['Mayo']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Junio", y: <?php echo $MP['Junio']['Zona']['Zona1']['Estado']['Abierto']+$MP['Junio']['Zona']['Zona1']['Estado']['Ejecutado']+$MP['Junio']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Julio", y: <?php echo $MP['Julio']['Zona']['Zona1']['Estado']['Abierto']+$MP['Julio']['Zona']['Zona1']['Estado']['Ejecutado']+$MP['Julio']['Zona']['Zona1']['Estado']['Progreso']; ?>}
          ]

          var progreso = [
          {label: "Enero", y: <?php echo $MP['Enero']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Febrero", y: <?php echo $MP['Febrero']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Marzo", y: <?php echo $MP['Marzo']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Abril", y: <?php echo $MP['Abril']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Mayo", y: <?php echo $MP['Mayo']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Junio", y: <?php echo $MP['Junio']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          {label: "Julio", y: <?php echo $MP['Julio']['Zona']['Zona1']['Estado']['Progreso']; ?>},
          ]

          var ejecutado = [
          {label: "Enero", y: <?php echo $MP['Enero']['Zona']['Zona1']['Estado']['Ejecutado']; ?>},
          {label: "Febrero", y: <?php echo $MP['Febrero']['Zona']['Zona1']['Estado']['Ejecutado']; ?>},
          {label: "Marzo", y: <?php echo $MP['Marzo']['Zona']['Zona1']['Estado']['Ejecutado']; ?>},
          {label: "Abril", y: <?php echo $MP['Abril']['Zona']['Zona1']['Estado']['Ejecutado']; ?>},
          {label: "Mayo", y: <?php echo $MP['Mayo']['Zona']['Zona1']['Estado']['Ejecutado']; ?>},
          {label: "Junio", y: <?php echo $MP['Junio']['Zona']['Zona1']['Estado']['Ejecutado']; ?>},
          {label: "Julio", y: <?php echo $MP['Julio']['Zona']['Zona1']['Estado']['Ejecutado']; ?>},
          ]

          var chart = new CanvasJS.Chart("chartContainer3",
              {
                theme: "theme3",
                animationEnabled: true,
                title:{
                  text: "Mantenimientos Preventivos Zona 1",
                  fontSize: 25
                },
                toolTip: {
                  shared: true
                },
                axisY: {
                  title: "Manteniminetos"
                },
                data: [
                {
                  type: "column",
                  name: "Planeado",
                  legendText: "Planeados",
                  showInLegend: true,
                  dataPoints:planeado
                },
                {
                  type: "column",
                  name: "Ejecutado",
                  legendText: "Ejecutados",
                  showInLegend: true,
                  dataPoints:ejecutado
                },
                {
                  type: "column",
                  name: "En Progreso",
                  legendText: "En Progreso",
                  showInLegend: true,
                  dataPoints:progreso
                }

                ],
                    legend:{
                      cursor:"pointer",
                      itemclick: function PEMP(e){
                        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                          e.dataSeries.visible = false;
                        }
                        else {
                          e.dataSeries.visible = true;
                        }
                        chart.render();
                      }
                    },
                  });
                chart.render();
        }


        function  PGEMPln2() {
          var Enero = <?php echo $MP['Enero']['contador']; ?>;
          var Febrero = Enero + <?php echo $MP['Febrero']['contador']; ?>;
          var Marzo = Febrero + <?php echo $MP['Marzo']['contador']; ?>;
          var Abril = Marzo + <?php echo $MP['Abril']['contador']; ?>;
          var Mayo = Abril + <?php echo $MP['Mayo']['contador']; ?>;
          var Junio = Mayo + <?php echo $MP['Junio']['contador']; ?>;
          var Julio = Junio + <?php echo $MP['Julio']['contador']; ?>;
          var totalMantenimientos = Julio;

          var EneroE = <?php echo $MP['Enero']['Zona']['Zona1']['Estado']['Ejecutado'] + $MP['Enero']['Zona']['Zona4']['Estado']['Ejecutado']; ?>;
          var FebreroE = EneroE + <?php echo $MP['Febrero']['Zona']['Zona1']['Estado']['Ejecutado'] + $MP['Febrero']['Zona']['Zona4']['Estado']['Ejecutado']; ?>;
          var MarzoE = FebreroE + <?php echo $MP['Marzo']['Zona']['Zona1']['Estado']['Ejecutado'] + $MP['Marzo']['Zona']['Zona4']['Estado']['Ejecutado']; ?>;
          var AbrilE = MarzoE + <?php echo $MP['Abril']['Zona']['Zona1']['Estado']['Ejecutado'] + $MP['Abril']['Zona']['Zona4']['Estado']['Ejecutado']; ?>;
          var MayoE = AbrilE + <?php echo $MP['Mayo']['Zona']['Zona1']['Estado']['Ejecutado'] + $MP['Mayo']['Zona']['Zona4']['Estado']['Ejecutado']; ?>;
          var JunioE = MayoE + <?php echo $MP['Junio']['Zona']['Zona1']['Estado']['Ejecutado'] + $MP['Junio']['Zona']['Zona4']['Estado']['Ejecutado']; ?>;
          var JulioE = JunioE + <?php echo $MP['Julio']['Zona']['Zona1']['Estado']['Ejecutado'] + $MP['Julio']['Zona']['Zona4']['Estado']['Ejecutado']; ?>;

                var datos1 = [
                  { label: "Enero", y: 10/totalMantenimientos*Enero},
                  { label: "Febrero", y: 1/totalMantenimientos*Febrero},
                  { label: "Marzo", y: 1/totalMantenimientos*Marzo},
                  { label: "Abril", y: 1/totalMantenimientos*Abril},
                  { label: "Mayo", y: 1/totalMantenimientos*Mayo},
                  { label: "Junio", y: 1/totalMantenimientos*Junio},
                  { label: "Julio", y: 1/totalMantenimientos*Julio}
              ];

              var datos2 = [
                { label: "Enero", y: 10/totalMantenimientos*EneroE},
                { label: "Febrero", y: 1/totalMantenimientos*FebreroE},
                { label: "Marzo", y: 1/totalMantenimientos*MarzoE},
                { label: "Abril", y: 1/totalMantenimientos*AbrilE},
                { label: "Mayo", y: 1/totalMantenimientos*MayoE},
                { label: "Junio", y: 1/totalMantenimientos*JunioE},
                { label: "Julio", y: 1/totalMantenimientos*JulioE}
            ];

              var chart = new CanvasJS.Chart("chartContainer2",
              {
                title:{
                 text: "Plan General Consorcio Ejecución de Manteniminetos Preventivos %",
                 fontZise: 22
               },
               toolTip: {
                        shared: true,
                        contentFormatter: function (e) {
                          var content = " ";
                          for (var i = 0; i < e.entries.length; i++) {
                            content += e.entries[i].dataSeries.name + " " + "<strong>" + (e.entries[i].dataPoint.y * 100).toFixed(0) + "%" + "</strong>";
                            content += "<br/>";
                          }
                          return content;
                          }
                        },
               theme: "theme1",
               animationEnabled: true,
               axisX: {
                 valueFormatString: "MMM"
                },
                axisY:{
                  maximum: 1.20,
                  interval: 0.20,
                  valueFormatString: "#0 %"
                },
               data: [
               {
                 type: "area",
                 color: "rgba(40,175,101,0.6)",
                 markerSize: 0,
                 showInLegend: true,
                 legendText: "Planeados",
                 name: "Planeados",
                 dataPoints:datos1
              },
              {
                type: "area",
                color: "rgba(0,75,141,0.7)",
                markerSize: 0,
                showInLegend: true,
                legendText: "Ejecutados",
                name: "Ejecutados",
                dataPoints:datos2
             }
              ]
            });

            chart.render();
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
          <h1><a id="logo"><img src="/assets/images/logo.png" /></a></h1>
  				<nav>
  					<ul id="menu">
              <?php
                if ($_SESSION['permissions'] != NULL){
                  echo "<li id='nav1'><a href='/index.php/User/loadPrincipalView'>Bienvenid@<span>".$_SESSION['name']."</span></a></li>";
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
                    echo "<li id='nav5'><a href='/index.php/ZTEPlatform/platformZTE'>ZTE<span>Plataforma</span></a></li>";
                  }
                }
              ?>
              <li id="nav6"><a href="/index.php/Welcome/index">Salir<span>Logout</span></a></li>
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
        echo "<script type='text/javascript'>PGEMP();</script>";
        echo "<script type='text/javascript'>PEMP();</script>";
        echo "<script type='text/javascript'>PGEMPln();</script>";
        echo "<script type='text/javascript'>PGEMPln2();</script>";
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

    <script data-config>
      var filtersConfig = {
        col_0: "none",
        col_1: "none",
        col_10: "none",
        base_path: '/assets/js/',
        filters_row_index: 1,
        alternate_rows: true,
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
