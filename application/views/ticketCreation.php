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
<script type="text/javascript" src="/AdminZTE/assets/js/required/raphael.min.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/required/raphael.icons.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/dist/wheelnav.js"></script>
<script type="text/javascript" src="/AdminZTE/assets/js/tabs.js"></script>
<link href="/AdminZTE/assets/css/index.css" rel="stylesheet">
<link rel="stylesheet" href="/AdminZTE/assets/css/sweetalert/dist/sweetalert.css" />
<script src="/AdminZTE/assets/css/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

    window.onload = function () {
        new wheelnav("divWheelnav");
    };

</script>

<script>

    function showMessage(){

        var a = "<?php echo $msj[0]; ?>";
        var b = "<?php echo $msj[1]; ?>";
        var c = "<?php echo $msj[2]; ?>";
        sweetAlert(a, b, c);
    }

    function fillInputs(){
      var e = document.getElementById("pvd");
      var valorOption = e.options[e.selectedIndex].value;
      var res = valorOption.split("/");
      document.getElementById("dep-cit").value = res[1]+" / "+res[2];
      document.getElementById("direccion").value = res[3];
      document.getElementById("tipologia").value = res[4];
      document.getElementById("Administrador").value = res[5];
      document.getElementById("CAdministrador").value = res[6];

      console.log(valorOption);
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
          <?php
            if($_SESSION['permissions'][5] == 1){
              echo "<div id='divWheelnav' class='wheelNav' data-wheelnav data-wheelnav-slicepath='PieArrowSlice' data-wheelnav-colors='#F5D908,#00A3EE,#9C1A5B' data-wheelnav-navangle='90'>";
                echo "<div data-wheelnav-navitemtext='Tickets'><a href='/AdminZTE/index.php/Ticket/TicketPrincial'>href</a></div>";
                echo "<div data-wheelnav-navitemtext='KPIs'><a href='/AdminZTE/index.php/KPI/KPIPrincial'>href</a></div>";
                echo "<label data-wheelnav-navitemtext='Procedimientos'>Elemento 2</label><br />";
              echo "</div>";

              if ($msj != ""){
                echo "<script type='text/javascript'>showMessage();</script>";
              }
            }
           ?>
          <section class="col-4-4">
          <div class="wrap-col">
            <h2 class="under">Creación de Tickets</h2>
            <img src="/AdminZTE/assets/images/ticketIcon.png" /><br><br>

            <div class="wrapper tabs">
              <ul class='nav'>
                <center>
                  <li><a href='#tabPreventivos'><center>+ Prev.</center></a></li>
                  <li><a href='#tabCorrectivos'><center>+ Corr.</center></a></li>
                  <li><a href='#tabOtros'><center>+ Otros</center></a></li>
                </center>
              </ul><br><br>
              <div class='tab-content' id='tabPreventivos'>
                <div class="form-style-5">
                  <form  name="formulario" id="formulario" method="post" accept-charset="utf-8">
                  <fieldset>
                    <?php
                      echo "<legend><span class='number'>1</span> Información PVD</legend>";
                      echo "<label for='job'>ID PVD:</label>";
                      echo "<select id='pvd' name='pvd' onchange='fillInputs()'>";
                        for($i = 0; $i<count($pvds); $i++){
                          echo "<option value='".$pvds[$i]->getId()."/".$pvds[$i]->getCity()."/".$pvds[$i]->getDepartment()."/".$pvds[$i]->getDireccion()."/".$pvds[$i]->getTipologia()."/".$pvds[$i]->getAdmin()['N_NAME']."/".$pvds[$i]->getAdmin()['I_PHONE']."'>".$pvds[$i]->getId()."</option>";
                        }
                      echo "</select>";
                      echo "<label for='job'>Departament / Ciudad:</label>";
                      echo "<input type='text' name='dep-cit'  id='dep-cit' value='".$pvds[0]->getCity()." / ".$pvds[0]->getDepartment()."' disabled='disabled'>";
                      echo "<label for='job'>Dirección:</label>";
                      echo "<input type='text' name='direccion'  id='direccion' value='".$pvds[0]->getDireccion()."' disabled='disabled'>";
                      echo "<label for='job'>Tipologia:</label>";
                      echo "<input type='text' name='tipologia'  id='tipologia' value='".$pvds[0]->getTipologia()."' disabled='disabled'>";
                      echo "<label for='job'>Nombre administrador:</label>";
                      echo "<input type='text' name='Administrador'  id='Administrador' value='".$pvds[0]->getAdmin()['N_NAME']."' disabled='disabled'>";
                      echo "<label for='job'>Contacto administrador:</label>";
                      echo "<input type='text' name='CAdministrador'  id='CAdministrador' value='".$pvds[0]->getAdmin()['I_PHONE']."' disabled='disabled'>";

                      echo "<legend><span class='number'>2</span> Información Mantenimiento</legend>";
                      echo "<label for='job'>Fecha:</label>";
                      echo "<input type='date' name='date' placeholder='Fecha *' required>";
                      echo "<label for='job'>Nombre del técnico IT:</label>";
                      echo "<select id='TIT' name='TIT'>";
                        echo "<option value='-1'></option>";
                        for($i = 0; $i<count($users); $i++){
                          echo "<option value='".$users[$i]->getName()." ".$users[$i]->getLastname()." / ".$users[$i]->getID()."'>".$users[$i]->getName()." ".$users[$i]->getLastname()."</option>";
                        }
                      echo "</select>";
                      echo "<label for='job'>Nombre del aux IT:</label>";
                      echo "<select id='AIT' name='AIT'>";
                        echo "<option value='-1'></option>";
                        for($i = 0; $i<count($users); $i++){
                          echo "<option value='".$users[$i]->getName()." ".$users[$i]->getLastname()." / ".$users[$i]->getID()."'>".$users[$i]->getName()." ".$users[$i]->getLastname()."</option>";
                        }
                      echo "</select>";
                      echo "<label for='job'>Nombre del técnico AA:</label>";
                      echo "<select id='TAA' name='TAA'>";
                        echo "<option value='-1'></option>";
                        for($i = 0; $i<count($users); $i++){
                          echo "<option value='".$users[$i]->getName()." ".$users[$i]->getLastname()." / ".$users[$i]->getID()."'>".$users[$i]->getName()." ".$users[$i]->getLastname()."</option>";
                        }
                      echo "</select>";
                      echo "<label for='job'>Nombre del aux AA:</label>";
                      echo "<select id='AAA' name='AAA'>";
                        echo "<option value='-1'></option>";
                        for($i = 0; $i<count($users); $i++){
                          echo "<option value='".$users[$i]->getName()." ".$users[$i]->getLastname()." / ".$users[$i]->getID()."'>".$users[$i]->getName()." ".$users[$i]->getLastname()."</option>";
                        }
                      echo "</select>";
                    ?>
                    <input type="submit" value="Enviar" onclick = "this.form.action = 'http://localhost/AdminZTE/index.php/Ticket/createTicketMP'"/>
                  </form>
                </div>
              </div>
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
  <script>
    $(document).ready(function() {
      tabs.init();
    })
  </script>
</body>
</html>
