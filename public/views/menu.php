<?php
    session_start();
    $_SESSION['reg-error'] = '';
    $_SESSION['log-error'] = '';
    require_once('../../private/credential/session.php');
 ?>
 <!DOCTYPE HTML>
 <html>

 <head>
 	<meta charset="utf-8" />
 	<meta http-equiv="Cache-Control" content="max-age=600" />
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
 	<meta name="author" content="JMAN">
 	<meta name="description" content="Food Tracking Application">
 	<meta name="copyright" content="2018 JMAN, Inc. All rights reserved.">
 	<meta name="viewport" content="width=device-width, initial-scale=1" />
 	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
 	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,300italic,400italic" />

 	<link rel="stylesheet" href="assets/css/main.css" />
 	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
 	<link rel="shortcut icon" href="images/logo.png" />
 	<title>JustPerfect</title>
 </head>

 <body>
 	<div id="page-wrapper">

 		<!-- Header -->
 		<header id="header">
 			<h1><a href="index.php">JustPerfect</a></h1>
 			<nav id="nav">
 				<ul>
 					<li><a href="index.php">Home</a></li>
 					<li><a href="dashboard.php">Dashboard</a></li>
 					<li><a href="logout.php" class="button">Sign Out</a></li>
 				</ul>
 			</nav>
 		</header>

 		<!-- Main -->
 		<section id="main" class="container">
 			<header>
 				<h2>Menu</h2>
 			</header>

 			<div class="row">
 				<div class="12u">

 					<!-- Form -->
 					<section class="box">
 						<h2>Search</h2>
 							<div class="row uniform 50%">
 								<div class="9u 12u(mobilep)">
 									<input type="text" name="query" id="query" value="" placeholder="Search..." />
 								</div>
 								<div class="3u 12u(mobilep)">
 									<input type="submit" value="Search" class="fit" />
 								</div>
 							</div>
 					</section>

 				</div>
 			</div>
 			<div class="row">
 				<div class="12u">
 					<!-- Image -->
 					<section class="box">
 						<h2>Result</h2>
 						<span class="image fit"><img src="images/pic04.jpg" alt="" /></span>
 						<div class="box alt">
 							<div class="row no-collapse 50% uniform">
 								<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
 								<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
 								<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
 							</div>
 							<div class="row no-collapse 50% uniform">
 								<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
 								<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
 								<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
 							</div>
 							<div class="row no-collapse 50% uniform">
 								<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
 								<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
 								<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
 							</div>
 						</div>

 						<h4>Left &amp; Right</h4>
 						<p><span class="image left"><img src="images/pic05.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis
 							iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing
 							accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing
 							accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer
 							ac pellentesque praesent.</p>
 						<p><span class="image right"><img src="images/pic05.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis
 							iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing
 							accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing
 							accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer
 							ac pellentesque praesent.</p>
 					</section>

 				</div>
 			</div>
 		</section>

 		<!-- Footer -->
        <footer id="footer">
            <ul class="icons">
                <li><a href="" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
                <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
                <li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
            </ul>
            <ul class="copyright">
                <li>&copy; JMAN - 2018. All rights reserved.</li>
            </ul>
        </footer>

 	</div>

 	<!-- Scripts -->
    <script src="https://use.fontawesome.com/187432b169.js"></script>
 	<script src="assets/js/jquery.min.js"></script>
 	<script src="assets/js/jquery.dropotron.min.js"></script>
 	<script src="assets/js/jquery.scrollgress.min.js"></script>
 	<script src="assets/js/skel.min.js"></script>
 	<script src="assets/js/util.js"></script>
 	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
 	<script src="assets/js/main.js"></script>
    <script src="assets/js/menu.js"></script>
 </body>

 </html>

 <?php
    db_disconnect($conn);
 ?>
