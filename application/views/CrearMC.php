<!DOCTYPE html>
<html lang="en">
<head>
<title>M. Correctivos ZTE-FONADE</title>
<meta charset="utf-8">
<link rel="icon" href="http://cellaron.com/media/wysiwyg/zte-mwc-2015-8-l-124x124.png">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="/AdminZTE/assets/css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="/AdminZTE/assets/css/zerogrid.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/responsive.css">
<link rel="stylesheet" href="/AdminZTE/assets/css/responsiveslides.css" />
<script type="text/javascript" src="/AdminZTE/assets/js/jquery-1.6.js" ></script>
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

<script>
      function cambiarSelect(categorias){
        $('#field7').empty();
        var valorOption = $('#field6 option:selected').attr('value');
        for(var i = 0; i < categorias[valorOption-1].tipo.length; i++){
          $("#field7").append("<option value='"+categorias[valorOption-1].tipo[i].tipoId+"'>"+categorias[valorOption-1].tipo[i].nombre+"</option>");
        }
        $("#field7").append("<option value='-1'>OTRO</option>");
      }

      function mostrarFieldOtro(){
        var valorOption = $('#field7 option:selected').attr('value');
        if (valorOption == "-1"){
          $("#fieldOtros").show();
          $("#fieldOtros").attr('required', true);
        } else {
          $("#fieldOtros").hide();
          $("#fieldOtros").attr('required', false);
        }
      }

      function cambiarSelectPVD(zonas){
        $('#field4').empty();
        var valorOption = $('#field3 option:selected').attr('value');
        var tipo = valorOption.split("/");
        for(var i = 0; i < zonas.length; i++){
          if(zonas[i].idTIPO == tipo[1]){
            $("#field4").append("<option value='"+zonas[i].id.id+"'>"+zonas[i].id.name+"</option>");
          }
        }
      }

    function sel(c, name){
      var fieldName = "field"+name;
      formu=document.forms['formulario'];
      caracteres=c.length;
      if(caracteres!=0){
        for (x=0;x<formu[fieldName].options.length;x++){
          if(formu[fieldName].options[x].value.slice(0,caracteres)==c){
            formu[fieldName].selectedIndex=x;
            formu[fieldName].style.visibility="visible";
            break;
          }else{
            formu[fieldName].style.visibility="hidden";
          }
        }
      }
    }
</script>


<style type="text/css">
.form-style-5{
    max-width: 500px;
    padding: 10px 20px;
    background: #f4f7f8;
    margin: 10px auto;
    padding: 20px;
    background: #f4f7f8;
    border-radius: 8px;
    font-family: Georgia, "Times New Roman", Times, serif;
}
.form-style-5 fieldset{
    border: none;
}
.form-style-5 legend {
    font-size: 1.4em;
    margin-bottom: 10px;
}
.form-style-5 label {
    display: block;
    margin-bottom: 8px;
}
.form-style-5 input[type="text"],
.form-style-5 input[type="date"],
.form-style-5 input[type="datetime"],
.form-style-5 input[type="email"],
.form-style-5 input[type="number"],
.form-style-5 input[type="search"],
.form-style-5 input[type="time"],
.form-style-5 input[type="url"],
.form-style-5 textarea,
.form-style-5 select {
    font-family: Georgia, "Times New Roman", Times, serif;
    background: rgba(255,255,255,.1);
    border: none;
    border-radius: 4px;
    font-size: 16px;
    margin: 0;
    outline: 0;
    padding: 7px;
    width: 100%;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    background-color: #e8eeef;
    color:#8a97a0;
    -webkit-box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
    box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
    margin-bottom: 30px;

}
.form-style-5 input[type="text"]:focus,
.form-style-5 input[type="date"]:focus,
.form-style-5 input[type="datetime"]:focus,
.form-style-5 input[type="email"]:focus,
.form-style-5 input[type="number"]:focus,
.form-style-5 input[type="search"]:focus,
.form-style-5 input[type="time"]:focus,
.form-style-5 input[type="url"]:focus,
.form-style-5 textarea:focus,
.form-style-5 select:focus{
    background: #d2d9dd;
}
.form-style-5 select{
    -webkit-appearance: menulist-button;
    height:35px;
}
.form-style-5 .number {
    background: #1abc9c;
    color: #fff;
    height: 30px;
    width: 30px;
    display: inline-block;
    font-size: 0.8em;
    margin-right: 4px;
    line-height: 30px;
    text-align: center;
    text-shadow: 0 1px 0 rgba(255,255,255,0.2);
    border-radius: 15px 15px 15px 0px;
}

.form-style-5 input[type="submit"],
.form-style-5 input[type="button"]
{
    position: relative;
    display: block;
    padding: 19px 39px 18px 39px;
    color: #FFF;
    margin: 0 auto;
    background: #1abc9c;
    font-size: 18px;
    text-align: center;
    font-style: normal;
    width: 100%;
    border: 1px solid #16a085;
    border-width: 1px 1px 3px;
    margin-bottom: 10px;
}
.form-style-5 input[type="submit"]:hover,
.form-style-5 input[type="button"]:hover
{
    background: #109177;
}
</style>


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
								echo "<li id='nav1' ><a >Bienvenid@<span>".$_SESSION['name']."</span></a></li>";
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
        <div class="wrapper row">
          <section class="col-4-4">
          <div class="wrap-col">
            <h2 class="under">Crear mantenimiento correctivo</h2>
            <img src="/AdminZTE/assets/images/wrench-flat.png" />


            <div class="form-style-5">
              <form  name="formulario" id="formulario" method="post" accept-charset="utf-8">
              <fieldset>
                <?php
                  echo "<legend><span class='number'>1</span> Información General</legend>";
                  echo "<label for='field4'>ID Ticket:</label>";
                  echo  "<input type='text' name='buscar1' onKeyUp='sel(this.value, 1)'  placeholder='Buscar ID Ticket *'>";
                  echo "<select id='field1' name='field1'>";
                    for($i = 0; $i<count($tickets); $i++){
                      echo "<option value='".$tickets[$i]->getId()."'>".$tickets[$i]->getId()."</option>";
                    }
                    echo "<option value='Ticket mesa de ayuda'>Ticket mesa de ayuda</option>";
                  echo "</select>";

                  echo "<label for='job'>Nombre del empleado:</label>";
                  echo  "<input type='text' name='buscar2' onKeyUp='sel(this.value, 2)'  placeholder='Buscar nombre empleado *'>";
                  echo "<select id='field2' name='field2'>";
                    for($i = 0; $i<count($users); $i++){
                      echo "<option value='".$users[$i]->getName()." ".$users[$i]->getLastname()." / ".$users[$i]->getID()."'>".$users[$i]->getName()." ".$users[$i]->getLastname()."</option>";
                    }
                  echo "</select>";
                  echo "<legend><span class='number'>2</span> Información PVD</legend>";

                  echo "<label for='job'>ID PVD:</label>";
                  echo  "<input type='text' name='buscar3' onKeyUp='sel(this.value, 3)'  placeholder='Buscar ID PVD *'>";
                  $json2 = json_encode($places);
                  echo "<select onchange='cambiarSelectPVD(".$json2.")' id='field3' name='field3'>";
                    for($i = 0; $i<count($pvds); $i++){
                      echo "<option value='".$pvds[$i]->getId()."/".$pvds[$i]->getTipologia()."'>".$pvds[$i]->getId()."</option>";
                    }
                  echo "</select>";
                  echo "<label for='job'>Ubicación dentro del PVD:</label>";
                  echo "<select id='field4' name='field4' required>";
                    for($i = 0; $i<count($places); $i++){
                      if($places[$i]['idTIPO'] == $pvds[0]->getTipologia()){
                        echo "<option value='".$places[$i]['id']['id']."'>".$places[$i]['id']['name']."</option>";
                      }
                    }
                  echo "</select>";
                  echo "<legend><span class='number'>3</span> Información sobre el equipo(s)</legend>";
                  echo "<input type='number' name='field5' placeholder='Cantidad de Equipos *' required>";
                  echo "<label for='job'>Categoria:</label>";
                  $json  = json_encode($categoriaE);

                  echo "<select id='field6' name='field6' onchange='cambiarSelect(".$json.")'>";
                    for($i = 0; $i<count($categoriaE); $i++){
                      echo "<option value='".$categoriaE[$i]['id']."'>".$categoriaE[$i]['nombre']."</option>";
                    }
                  echo "</select>";
                  echo "<label for='job'>Tipo de equipo:</label>";
                  echo "<select id='field7' name='field7' onchange='mostrarFieldOtro()'>";
                    for($i = 0; $i<count($categoriaE[0]['tipo']); $i++){
                      echo "<option value='".$categoriaE[0]['tipo'][$i]['tipoId']."'>".$categoriaE[0]['tipo'][$i]['nombre']."</option>";
                    }
                    echo "<option value='-1'>OTRO</option>";
                  echo "</select>";
                  echo  "<input type='text' name='fieldOtros' id='fieldOtros'  placeholder='Cual otro tipo *' hidden>";
                  echo "<input type='text' name='field8' placeholder='Serial *' required>";
                  echo "<input type='text' name='field9' placeholder='Marca *' required>";
                  echo "<input type='text' name='field10' placeholder='Modelo *' required>";
                  echo "<legend><span class='number'>4</span> Información sobre el fallo</legend>";
                  echo "<label for='job'>Tipo:</label>";
                  echo "<select id=job name='field11'>";
                  for($i = 0; $i<count($daños); $i++){
                    echo "<option value='".$daños[$i]['id']."'>".$daños[$i]['nombre']."</option>";
                  }
                  echo "</select>";
                  echo "<textarea name='field12' placeholder='Descripción *' required></textarea>";
                  echo "<textarea name='field13' placeholder='Materiales necesarios para solucionar la falla *' required></textarea>";
                 ?>
                <input type="submit" value="Enviar" onclick = "this.form.action = 'http://localhost/AdminZTE/index.php/MCorrectivos/crearMC'"/>
              </form>
            </div>
          </div>
          </section>
        </div>
			</article>
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
</body>
</html>
