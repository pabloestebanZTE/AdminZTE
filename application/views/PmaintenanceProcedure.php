<!DOCTYPE html>
<html lang="en">
<head>
<title>Creacion Tickets</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="icon" href="http://cellaron.com/media/wysiwyg/zte-mwc-2015-8-l-124x124.png">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="/AdminZTE/assets/css/mainModalWindow2.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/chunkyButtons.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/zerogrid.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/responsive.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/wheelmenu.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/index.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/sweetalert/dist/sweetalert.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/tablesInventory.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/multiTable.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Teko:400,700">
<script type="text/javascript" src="/AdminZTE/assets/js/jquery-1.6.js" ></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="/AdminZTE/assets/js/cufon-yui.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/cufon-replace.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/Swis721_Cn_BT_400.font.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/Swis721_Cn_BT_700.font.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/tms-0.3.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/tms_presets.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/jcarousellite.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/script.js"></script>
<script src="/AdminZTE/assets/js/css3-mediaqueries.js"></script>
<script src="/AdminZTE/assets/js/responsiveslides.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/tabs.js"></script>
<script src="/AdminZTE/assets/css/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/jquery.wheelmenu.js"></script>

<script>
var newElementQuantity = 0;
var equipmentType;
var inventory;
var category;
var checklist;
var zones;

    function showMessage(){
        var a = "<?php echo $msj[0]; ?>";
        var b = "<?php echo $msj[1]; ?>";
        var c = "<?php echo $msj[2]; ?>";
        sweetAlert(a, b, c);
    }

    function showModal(idEquipo, inventario, name, categorias, rutina){
      newElementQuantity = 0;
    //  console.log(idEquipo);
    //  console.log(inventario);
      //console.log(name);
  //    console.log(categorias);
      checklist = rutina;
      equipmentType = idEquipo;
      inventory = inventario;
      category = categorias;
      $('#chk').remove();
      $('#inventory').remove();
      $('#corrective').remove();

      nameZones = ""+"<?php
         for($i=0;$i<count($PVD->getZones());$i++){
           echo $PVD->getZones()[$i]['N_NAME'];
           echo "@";
         }
        ?>";
      idZones = ""+"<?php
         for($i=0;$i<count($PVD->getZones());$i++){
           echo $PVD->getZones()[$i]['K_IDPVDZONE'];
           echo "-";
         }
        ?>";

        nameZones = nameZones.split("@");
        idZones = idZones.split("-");

        $selectZones = "";
        for(var i = 0; i < idZones.length -1; i++){
          $selectZones = $selectZones+"<option value='"+idZones[i]+"'>"+nameZones[i]+"</option>";
        }
        zones = $selectZones

      $('#tableInventory').append("<tbody id='inventory' name='inventory'></tbody>");
      $('#tableCorrective').append("<tbody id='corrective' name='corrective'></tbody>");
      if(inventario != "NI"){
        for(var i = 0; i<inventario.length; i++){
          for (var j = 0; j<categorias.length; j++){
            if (categorias[j].K_IDSTUFF_CATEGORY == inventario[i].K_IDSTUFF_CATEGORY){
              var elemento =  "<td>"+categorias[j].N_NAME+"</td>";
              for(k = 0; k<categorias[j].model.length; k++){
                if(categorias[j].model[k].K_IDMODEL == inventario[i].K_IDMODEL){
                  var modelo =  "<td>"+categorias[j].model[k].N_NAME+"</td>";
                  var marca =  "<td>"+categorias[j].model[k].K_IDMANUFACTURER.N_NAME+"</td>";
                }
              }
            }
          }
          var serial =  "<td>"+inventario[i].N_SERIAL+"</td>";
          var placa =  "<td>"+inventario[i].N_PLACAINVENTARIO+"</td>";
          var parte =  "<td>"+inventario[i].N_PARTE+"</td>";
          var zone =  "<td name='selectZones"+newElementQuantity+"' id='selectZones"+newElementQuantity+"'>"+inventario[i].K_IDPVD_PLACE.N_NAME+"</td>";
          var id = "<td hidden><input id='idElement"+newElementQuantity+"' name='idElement"+newElementQuantity+"' value='"+inventario[i].K_IDSTUFF+"'></td>";
          var fotos = "<td><a class='push_button red' role='button' href='https://console.aws.amazon.com/s3/buckets/tt201701260001/Registro%20Fotografico/Camara%20IP/?region=us-west-2&tab=overview' target='_blank'>Ver</a></td>";


          if(inventario[i].Q_PROGRESS == "0"){
            var finalizado = "<td><select style='font-size:10px' name='selectFinalizado"+newElementQuantity+"' id='selectFinalizado"+newElementQuantity+"' aria-describedby='basic-addon1'>";
            finalizado = finalizado+"<option value='0'>No</option><option value='1'>Si</option>";
            finalizado = finalizado+"</select></td>";
          } else {
            var finalizado = "<td><select style='font-size:10px' name='selectFinalizado"+newElementQuantity+"' id='selectFinalizado"+newElementQuantity+"' aria-describedby='basic-addon1'>";
            finalizado = finalizado+"<option value='1'>Si</option><option value='0'>No</option>";
            finalizado = finalizado+"</select></td>";
          }

          if (inventario[i].N_ESTADO == "Funcional"){
            var estados = "<td><select onchange='cambioTabla("+newElementQuantity+")' style='font-size:10px' name='selectEstados"+newElementQuantity+"' id='selectEstados"+newElementQuantity+"' aria-describedby='basic-addon1'>";
            estados = estados+"<option value='Funcional'>Funcional</option><option value='Averiado'>Averiado</option>";
            estados = estados+"</select></td>";
            $('#inventory').append( "<tr id='linea"+newElementQuantity+"' name='linea"+newElementQuantity+"'>"+elemento+marca+modelo+serial+placa+parte+zone+estados+fotos+finalizado+id+"</tr>" );
          }
          if (inventario[i].N_ESTADO == "Averiado"){
            var estados = "<td><select onchange='cambioTabla("+newElementQuantity+")' style='font-size:10px' name='selectEstados"+newElementQuantity+"' id='selectEstados"+newElementQuantity+"' aria-describedby='basic-addon1'>";
            estados = estados+"<option value='Averiado'>Averiado</option><option value='Funcional'>Funcional</option>";
            estados = estados+"</select></td>";
            $('#corrective').append( "<tr id='linea"+newElementQuantity+"' name='linea"+newElementQuantity+"'>"+elemento+marca+modelo+serial+placa+parte+zone+estados+fotos+finalizado+id+"</tr>" );
            var selectEstado = document.getElementById("selectFinalizado"+newElementQuantity);
            selectEstado.style.display = 'none';
          }
          newElementQuantity++;
        }
      }
      $("#Elements").val(newElementQuantity);

      $('#todo-list').empty();
      var check = "";
      for (var i = 0; i < checklist.length; i++){
        check = check + "<span class='todo-wrap'><input type='checkbox' id='"+i+"'/><label for='"+i+"' class='todo'><i class='fa fa-check'></i>"+checklist[i].K_IDITEM_CHECKLIST.N_NAME+"</label></span>";
      }
      $('#todo-list').append(check);
      $('#modal-02').modal('show');
    }

    function cambiarSelectMarca(equipo_categoria){
      var equipo = $("#selectElement"+equipo_categoria+" option:selected").attr('value');
      for(var i = 0;i <category.length; i++){
        if(category[i].K_IDSTUFF_CATEGORY == equipo){
          var manufacturersTotal = [];
          for(var j = 0; j< category[i].model.length; j++){
            manufacturersTotal[j] = category[i].model[j].K_IDMANUFACTURER;
          }
          unique = [...new Set(manufacturersTotal.map(a => a.K_IDMANUFACTURER))];
          unique2 = [...new Set(manufacturersTotal.map(a => a.N_NAME))];
          var manufacturers = "";
          for(var j = 0; j< unique2.length; j++){
            manufacturers = manufacturers+"<option value='"+unique[j]+"'>"+unique2[j]+"</option>";
          }

          var models = "";
          for(var j = 0; j < category[i].model.length; j++){
            if(category[i].model[j].K_IDMANUFACTURER.K_IDMANUFACTURER == unique[0]){
              models = models+"<option value='"+category[i].model[j].K_IDMODEL+"'>"+category[i].model[j].N_NAME+"</option>";
            }
          }
        }
        $("#selectMarca"+equipo_categoria).empty();
        $("#selectModelo"+equipo_categoria).empty();
        $("#selectMarca"+equipo_categoria).append(manufacturers);
        $("#selectModelo"+equipo_categoria).append(models);
      }
    }

    function cambiarSelectModelo(equipo_categoria){
      var equipo = $("#selectElement"+equipo_categoria+" option:selected").attr('value');
      var marca = $("#selectMarca"+equipo_categoria+" option:selected").attr('value');
      var models = "";
      for(var i = 0; i<category.length;i++){
        if(category[i].K_IDSTUFF_CATEGORY == equipo){
          for(var j = 0; j<category[i].model.length; j++){
            if(category[i].model[j].K_IDMANUFACTURER.K_IDMANUFACTURER == marca){
              models = models+"<option value='"+category[i].model[j].K_IDMODEL+"'>"+category[i].model[j].N_NAME+"</option>";
            }
          }
        }
      }
      $("#selectModelo"+equipo_categoria).empty();
      $("#selectModelo"+equipo_categoria).append(models);
    }

    function cambioTabla(equipo_categoria){
      var estado = $("#selectEstados"+equipo_categoria+" option:selected").attr('value');
      var linea = document.getElementById("linea"+equipo_categoria);
      var selectEstado = document.getElementById("selectFinalizado"+equipo_categoria);
      if(estado == "Averiado"){
        selectEstado.style.display = 'none';
        $("#tableCorrective").append(linea);
      }
      if(estado == "Funcional"){
        selectEstado.style.display = 'block';
        $("#tableInventory").append(linea);
      }
    }

    function añadirElemento(){
      var options = "<td><select onchange='cambiarSelectMarca("+newElementQuantity+")' style='font-size:10px' name='selectElement"+newElementQuantity+"' id='selectElement"+newElementQuantity+"' aria-describedby='basic-addon1'>";
      for(var i = 0; i < category.length; i++){
        options = options+"<option value='"+category[i].K_IDSTUFF_CATEGORY+"'>"+category[i].N_NAME+"</option>";
      }
      options = options + "</select></td>";

      var manufacturersTotal = [];
      for(var i = 0; i< category[0].model.length; i++){
        manufacturersTotal[i] = category[0].model[i].K_IDMANUFACTURER;
      }
      unique = [...new Set(manufacturersTotal.map(a => a.K_IDMANUFACTURER))];
      unique2 = [...new Set(manufacturersTotal.map(a => a.N_NAME))];
      var manufacturers = "<td><select onchange='cambiarSelectModelo("+newElementQuantity+")' style='font-size:10px' name='selectMarca"+newElementQuantity+"' id='selectMarca"+newElementQuantity+"' aria-describedby='basic-addon1'>";
      for(var i = 0; i< unique2.length; i++){
        manufacturers = manufacturers+"<option value='"+unique[i]+"'>"+unique2[i]+"</option>";
      }
      manufacturers = manufacturers + "</select></td>";

      var models = "<td><select style='font-size:10px' name='selectModelo"+newElementQuantity+"' id='selectModelo"+newElementQuantity+"' aria-describedby='basic-addon1'>";
      for(var i = 0; i < category[0].model.length; i++){
        if(category[0].model[i].K_IDMANUFACTURER.K_IDMANUFACTURER == unique[0]){
          models = models+"<option value='"+category[0].model[i].K_IDMODEL+"'>"+category[0].model[i].N_NAME+"</option>";
        }
      }
      models = models + "</select></td>";

      var fieldName = "<td><input name='fieldName"+newElementQuantity+"' id='fieldName"+newElementQuantity+"' style='font-size:10px' type='text' aria-describedby='basic-addon1'></td>";
      var fieldPlaca = "<td><input name='fieldPlaca"+newElementQuantity+"' id='fieldPlaca"+newElementQuantity+"' style='font-size:10px' type='text' aria-describedby='basic-addon1'></td>";
      var fieldParte = "<td><input name='fieldParte"+newElementQuantity+"' id='fieldParte"+newElementQuantity+"' style='font-size:10px' type='text' aria-describedby='basic-addon1'></td>";
      var fotos = "<td><a class='push_button red' href='https://console.aws.amazon.com/s3/buckets/tt201701260001/Registro%20Fotografico/Camara%20IP/?region=us-west-2&tab=overview' target='_blank'>Ver</a></td>";

      var zonaE = "<td><select onchange='cambioTabla("+newElementQuantity+")' style='font-size:10px' name='selectZones"+newElementQuantity+"' id='selectZones"+newElementQuantity+"' aria-describedby='basic-addon1'>";
      zonaE = zonaE+zones;
      zonaE = zonaE+"</select></td>";

      var estados = "<td><select onchange='cambioTabla("+newElementQuantity+")' style='font-size:10px' name='selectEstados"+newElementQuantity+"' id='selectEstados"+newElementQuantity+"' aria-describedby='basic-addon1'>";
      estados = estados+"<option value='Funcional'>Funcional</option><option value='Averiado'>Averiado</option>";
      estados = estados+"</select></td>";

      var finalizado = "<td><select style='font-size:10px' name='selectFinalizado"+newElementQuantity+"' id='selectFinalizado"+newElementQuantity+"' aria-describedby='basic-addon1'>";
      finalizado = finalizado+"<option value='0'>No</option><option value='1'>Si</option>";
      finalizado = finalizado+"</select></td>";


      $('#inventory').append( "<tr id='linea"+newElementQuantity+"' name='linea"+newElementQuantity+"'>"+options+manufacturers+models+fieldName+fieldPlaca+fieldParte+zonaE+estados+fotos+finalizado+"</tr>" );
      newElementQuantity++;
      $("#Elements").val(newElementQuantity);

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
	<div class="body3">
<!-- content -->
			<article id="content">
        <?php
        echo "<div id='pricing-table' class='clear'>";
          echo "<center>";
                echo "<div class='plan' id='most-popular'>";
                    echo "<h3>PVD<span><img src='/AdminZTE/assets/images/pvd.png'/></span></h3>";
                    echo "<ul>";
                        echo "<li><b>ID: </b>".$PVD->getId()."</li>";
                        echo "<li><b>Región: </b>".$PVD->getRegion()."</li>";
                        echo "<li><b>Departamento: </b>".$PVD->getDepartment()."</li>";
                        echo "<li><b>Ciudad: </b>".$PVD->getCity()."</li>";
                        echo "<li><b>Dirección: </b>".$PVD->getDireccion()."</li>";
                        echo "<li><b>Tipologia: </b>".$PVD->getTipologia()."</li>";
                        echo "<li><b>Fase: </b>".$PVD->getFase()."</li>";
                    echo "</ul>";
                echo "</div>";
              echo "</div>";
          echo "</center>";
         ?>

          <table class="container">
          <?php
            if (isset($inventory)){
              echo "<thead>";
                echo "<tr>";
                  echo "<th><h1>Item</h1></th>";
                  echo "<th><h1>Valor Unitario Incluido IVA</h1></th>";
                  echo "<th><h1>Cantidad Tipologia</h1></th>";
                  echo "<th><h1>Cantidad en Inventario</h1></th>";
                  echo "<th><h1>Cantidad en Correctivo</h1></th>";

                  echo "<th><h1>Valor Total</h1></th>";
                  echo "<th><h1>Expandir</h1></th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
                for ($i = 0; $i < count($inventory); $i++){
                  echo "<tr>";
                    echo "<td>".$inventory[$i]['N_NAME']."</td>";
                    echo "<td>".$inventory[$i]['price']."</td>";
                    echo "<td>".$inventory[$i]['I_QUANTITY']."</td>";
                    echo "<td>".$inventory[$i]['funcional']."</td>";
                    echo "<td>".$inventory[$i]['averiado']."</td>";
                    echo "<td>".$inventory[$i]['valorT']."</td>";
                    echo "<td><button type='button' class='btn btn-success btn-sm' onclick='showModal(".json_encode($inventory[$i]['K_IDEQUIPMENTTYPE']).",".json_encode($inventory[$i]['inventario']).",".json_encode($inventory[$i]['N_NAME']).",".json_encode($generic[$i]['category']).",".json_encode($generic[$i]['rutina']).")'><i class='fa fa-search' aria-hidden='true'></i> Expandir</button></td>";
                  echo "</tr>";
                }
             echo "</tbody>";
            }
           ?>
          </table>
			</article>
	</div>
		<div class="main zerogrid">
<!-- footer -->
<!-- footer end -->
		</div>




    <!--DEMO02-->
    <div id="modal-02" class="modal fade">
      <div class="modal-content">
        <div id="main" class="container">
          <form method='post' name='formActualizar'>
            <div class="linea 200%">
              <div class="12u">
                <!-- Features -->
                <h2 class="major"><span>Elementos funcionales</span></h2>
                <div>
                  <div class="linea">
                  <!-- content -->
                    <?php
                      echo "<center><div class='btn-group'>";
                        echo "<button type='button' class='btn btn-primary btn-sm' onclick='añadirElemento()'><i class='fa fa-plus-square' aria-hidden='true'></i> Añadir Elemento</button>";
                        echo "<button type='submit' class='btn btn-info btn-sm' onclick = \"this.form.action = 'http://localhost/AdminZTE/index.php/Equipment/updateInventory' \"><i class='fa fa-floppy-o' aria-hidden='true'></i> Guardar Cambios</button>";
                        echo "<button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'><i class='fa fa-window-close' aria-hidden='true'></i> Salir</button>";
                      echo "</div></center>";
                      if (isset($inventory)){
                        echo "<article id='content'>";
                          echo "<table class='container' id='tableInventory' name='tableInventory'>";
                            echo "<thead>";
                              echo "<tr>";
                                echo "<th><h1>Elemento </h1></th>";
                                echo "<th><h1>Marca</h1></th>";
                                echo "<th><h1>Modelo</h1></th>";
                                echo "<th><h1>Serial</h1></th>";
                                echo "<th><h1>Placa de inventario</h1></th>";
                                echo "<th><h1>Número de parte</h1></th>";
                                echo "<th><h1>Área</h1></th>";
                                echo "<th><h1>Estado</h1></th>";
                                echo "<th><h1>Galeria</h1></th>";
                                echo "<th><h1>Finalizado</h1></th>";
                              echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='inventory' name='inventory'>";

                           echo "</tbody>";
                         echo "</table>";
                        echo "</article>";
                      }
                     ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="linea 100%">
              <div class="12u">
                <!-- Features -->
                <h2 class="major"><span>Elementos en mantenimiento correctivo</span></h2>
                <div>
                  <div class="linea">
                    <?php
                      if (isset($inventory)){
                        echo "<article id='content'>";
                          echo "<table class='container' id='tableCorrective' name='tableCorrective'>";
                            echo "<thead>";
                              echo "<tr>";
                                echo "<th><h1>Elemento </h1></th>";
                                echo "<th><h1>Marca</h1></th>";
                                echo "<th><h1>Modelo</h1></th>";
                                echo "<th><h1>Serial</h1></th>";
                                echo "<th><h1>Placa de inventario</h1></th>";
                                echo "<th><h1>Número de parte</h1></th>";
                                echo "<th><h1>Área</h1></th>";
                                echo "<th><h1>Galeria</h1></th>";
                                echo "<th><h1>Estado</h1></th>";
                              echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='corrective' name='corrective'>";
                           echo "</tbody>";
                         echo "</table>";
                        echo "</article>";
                      }
                     ?>
                  </div>
                </div>
              </div>
            </div>
            <input name='pvd' id='pvd' style='font-size:10px' type='hidden' aria-describedby='basic-addon1' value=' <?php echo $_GET['k_pvd'] ?> '></td>
            <input name='Elements' id='Elements' style='font-size:10px' type='hidden' aria-describedby='basic-addon1' value=''></td>
          </form>
          <div class="linea 200%">
            <div class="12u">
              <!-- Features -->
              <h2 class="major"><span>Rutina de Mantenimiento</span></h2>
              <div class="linea" id="checklist" name="checklist">
                <form id="todo-list">
                </form>
              </div>
            </div>
          </div>
        </div>
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