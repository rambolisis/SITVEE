<?php
class Encabezado{
	public $sitio;
	function __construct($s){
		$this->sitio=$s;
	}
	function generarHTML(){
		$tit=$this->sitio;
		echo "<html lang='es' xmlns='http://www.w3.org/1999/xhtml'>
			<head>
				<title>$tit</title>
				<meta http-equiv='Content-Type' content='text/html; charset='utf-8'/>
				<link rel='shortcut icon' href='imagenes/favicon.png' />
				<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
				<link rel='stylesheet' href='css/bootstrap.min.css'>
				<link rel='stylesheet' href='css/style.css'>
				<script src='js/jquery-3.3.1.min.js' type='text/javascript'></script>
				<script src='js/validar.js' type='text/javascript'></script>
				<script src='js/menu.js' type='text/javascript'></script>
				<script src='js/entradasBeneficios.js' type='text/javascript'></script>
				<script src='js/bootstrap.bundle.min.js' type='text/javascript'></script>
                <script src='js/bootstrap.min.js' type='text/javascript'></script>
				<style type='text/css'>
					body {
						font-family: 'Montserrat', sans-serif;
						background-image: linear-gradient(to top, #d2cdcd, #d9d5d6, #dfdddf, #e6e6e7, #eeeeee);
					}
			
					#header {
						background: #DF5C10;
						position: relative;
						width:100%;
						height:18%;
						border-radius:15px 0px 15px 0px;
						
						-webkit-box-shadow: 0px 0px 17px 3px rgba(0,0,0,0.6);
						-moz-box-shadow: 0px 0px 17px 3px rgba(0,0,0,0.6);
						box-shadow: 0px 0px 17px 3px rgba(0,0,0,0.6);
					}
			
					#footer {
						background: #7F7F7F;
						position: absolute;
						width:100%;
						height:18%;
						border-radius:0px 15px 0px 15px;

						-webkit-box-shadow: 0px 0px 17px 3px rgba(0,0,0,0.6);
						-moz-box-shadow: 0px 0px 17px 3px rgba(0,0,0,0.6);
						box-shadow: 0px 0px 17px 3px rgba(0,0,0,0.6);
					}
			
			
					.error{
						background-color: #E74F4F;
						position: absolute;
						top: 150px;
						left: 0px;
						padding: 10px 0 ;
						border-radius:  0 0 5px 5px;
						color: #fff;
						width: 100%;
						text-align: center;
						display: none;
					}
			
					.mensaje{
						float:left;
						position: absolute;
						top: 150px;
						left: 0px;
						padding: 10px 0 ;
						border-radius:  0 0 5px 5px;
						color: #fff;
						width: 100%;
						text-align: center;
						display: none;
					}
			
					html{
						font-family: 'Open Sans', sans-serif;
						font-size: 16px;
					}
				</style>
			</head>";
		echo "<body>
				<div id='header'>
					<img src='imagenes/Logo.png' style='width:30%; height:90%; padding:1%; float:right;'/>
				</div>
				<div id='loading-screen' style='display:none'>
					<img src='imagenes/spinning-circles.svg'>
				</div>";
	}
}
class Pie{
	function generarHTML(){
		echo "<div id='footer'>
				<img src='imagenes/Footer.jpg' style='width:70%; margin-left:14%; margin-right:14%; height:90%; padding:1%;'/>
			</div>";
	}
}
?>