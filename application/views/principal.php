<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
<meta charset="utf-8">
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
		$(function () {
		  $("#slider").responsiveSlides({
			auto: true,
			pager: false,
			nav: true,
			speed: 500,
			maxwidth: 960,
			namespace: "centered-btns"
		  });
		});
	</script>

</head>
<body id="page1">
<div class="body1">
	<div class="body2">
		<div class="main zerogrid">
<!-- header -->
			<header>
				<div class="wrapper row">
				<h1><a id="logo"><img src="/AdminZTE/assets/images/logo.png" /></a></h1>
				<nav>
					<ul id="menu">
          	<?php
							if ($_SESSION['permissions'] != NULL){
								echo "<li id='nav1' class='active'><a >Bienvenid@<span>".$_SESSION['name']."</span></a></li>";
								if($_SESSION['permissions'][3] == 1){
									echo "<li id='nav3'><a href='#'>PVD<span>HV</span></a></li>";
								}
								if($_SESSION['permissions'][1] == 1){
									echo "<li id='nav4'><a href='/AdminZTE/index.php/Mantenimientos/loadMPView'>Preventivos<span>Mantenimientos</span></a></li>";
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

				<div class="wrapper row">
					<div class="slider">
					  	<div class="rslides_container">
							<ul class="rslides" id="slider">
								<li><img src="/AdminZTE/assets/images/imagenRotativa1.gif" alt=""></li>
								<li><img src="/AdminZTE/assets/images/imagenRotativa3.png" alt=""></li>
							</ul>
						</div>
					</div>
				</div>
			</header>
<!-- header end-->
		</div>
	</div>
</div>
	<div class="body3">
		<div class="main zerogrid">
<!-- content -->
			<article id="content">
				<div class="wrapper row">
					<section class="col-1-4">
						<div class="wrap-col">
							<h3><span class="dropcap">A</span>Quienes<span>somos</span></h3>
							<p class="pad_bot1">Ingrese su texto aqui</p>
							<a href="#" class="link1">Expandir</a>
						</div>
					</section>
					<section class="col-1-4">
						<div class="wrap-col">
							<h3><span class="dropcap">B</span>Nuestro<span>trabajo</span></h3>
							<p class="pad_bot1">Ingrese su texto aqui</p>
							<a href="#" class="link1">Expandir</a>
						</div>
					</section>
					<section class="col-1-4">
						<div class="wrap-col">
							<h3><span class="dropcap">C</span>Contanos<span>Buscanos</span></h3>
							<p class="pad_bot1">Ingrese su texto aqui</p>
							<a href="#" class="link1">Expandir</a>
						</div>
					</section>
					<section class="col-1-4">
						<div class="wrap-col">
							<h3><span class="dropcap">D</span>Este no <span>se que hacer</span></h3>
							<p class="pad_bot1">Ingrese su texto aqui</p>
							<a href="#" class="link1">Expandir</a>
						</div>
					</section>
				</div>
			</article>
		</div>
	</div>
	<div class="body4">
		<div class="main zerogrid">
			<article id="content2">
				<div class="wrapper row">
					<section class="col-1-4">
					<div class="wrap-col">
						<h4>¿Porque elegirnos?</h4>
						<ul class="list1">
							<li><a href="#">Lorem ipsum dolor sit</a></li>
							<li><a href="#">Dmet, consectetur</a></li>
							<li><a href="#">Adipisicing elit eiusmod </a></li>
							<li><a href="#">Tempor incididunt ut</a></li>
						</ul>
					</div>
					</section>
					<section class="col-1-4">
					<div class="wrap-col">
						<h4>Dirección</h4>
						<ul class="address">
							<li><span>Pais:</span>Colombia</li>
							<li><span>Ciudad:</span>Bogotá</li>
							<li><span>Telefono:</span>Telefono</li>
							<li><span>Email:</span><a href="mailto:">progress@mail.com</a></li>
						</ul>
					</div>
					</section>
					<section class="col-1-4">
					<div class="wrap-col">
						<h4>Síguenos</h4>
						<ul id="icons">
							<li><a href="#"><img src="/AdminZTE/assets/images/icon1.jpg" alt="">Facebook</a></li>
							<li><a href="#"><img src="/AdminZTE/assets/images/icon2.jpg" alt="">Twitter</a></li>
							<li><a href="#"><img src="/AdminZTE/assets/images/icon3.jpg" alt="">LinkedIn</a></li>
							<li><a href="#"><img src="/AdminZTE/assets/images/icon4.jpg" alt="">Delicious</a></li>
						</ul>
					</div>
					</section>
					<section class="col-1-4">
					<div class="wrap-col">
						<h4>Novedades</h4>
						<form id="newsletter" method="post">
							<div>
								<div class="wrapper">
									<input class="input" type="text" value="Digite su correo"  onblur="if(this.value=='') this.value='Digite su correo'" onfocus="if(this.value =='Type Your Email Here' ) this.value=''" >
								</div>
								<a href="#" class="button" onclick="document.getElementById('newsletter').submit()">Subscribirse</a>
							</div>
						</form>
					</div>
					</section>
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
</body>
</html>
