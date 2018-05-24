<?php
    require_once('assets/php/session.php');
    include('assets/php/getUserName.php');
 ?>

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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,300italic,400italic" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="shortcut icon" href="images/logo.png" />
        <title>JustPerfect</title>
    </head>
    <style>
        #navPanel{
            font-weight: 400;
            font-size: 1rem;
        }
        .dropotron li a:hover {
            background-color: #61c200;

        }
        nav{
            font-weight: 400;
        }



        #heading{
          text-align: center;
        }

        p {
          /* background-color: white;
          border-radius: 5px;
          font-size: 20px;
          margin-bottom: 0.5em; */
        }

    </style>

    <body>
        <div id="page-wrapper">

            <!-- Header -->
            <header id="header">
                <h1><a href="index.php" id="jperfect">JustPerfect</a></h1>
                <nav id="nav">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="schedule.php">Schedule</a></li>
                        <li><a href="summary.php">Summary</a></li>
                        <li><a href="list.php">List</a></li>
                        <li><a href="profile.php" id="profile" class="button alt"><?php getName($conn); ?></a></li>
                    </ul>
                </nav>

            </header>
            <!-- Main -->
            <section id="main" class="container">
    					<div id='heading'>
                <h1>Profile Page</h1>
                <h2>My Settings<h2>
              </div>
              <div>
                <div class='info'>
                  <h2>Name</h2>
                  <p><?php getName($conn); ?></p>
                </div>

                <div class='info'>
                  <h2>Age</h2>
                  <p id = "age"></p>
                </div>

                <div class='info'>
                  <h2>Gender</h2>
                  <p id = "gender"></p>
                </div>

                <div class='info'>
                  <h2>Location</h2>
                  <p id = "location"></p>
                </div>

                <div class='info'>
                  <h2>Food Preferences</h2>
                  <p id = "prefer"></p>
                </div>

              </div>
    				</section>

            <!-- Footer -->
            <footer id="footer">
                <ul class="icons">
                    <li><a href="https://twitter.com/JMAN_ORIGINAL" target="_blank" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="https://www.facebook.com/JMAN-1982479225414716/" target="_blank" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="https://www.instagram.com/jman_original/?hl=en" target="_blank" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="https://github.com/mikah13/COMP2910-Project" target="_blank" class="icon fa-github"><span class="label">Github</span></a></li>
                </ul>
                <ul class="copyright">
                    <li>&copy; JMAN - 2018. All rights reserved.</li>
                </ul>
            </footer>


        </div>

        <!-- Scripts -->
        <script src="assets/js/fontawesome.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/jquery.scrollgress.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/profile.js"></script>

    </body>

    </html>
<?php
    db_disconnect($conn);
 ?>
