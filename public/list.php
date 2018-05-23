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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,300italic,400italic" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="shortcut icon" href="images/logo.png" />
        <title>Menu</title>
        <style>
            #up {
                margin: 0;
                position: fixed;
                bottom: 0;
                right: 0;
                max-width: 70px;
                max-height: 70px;
                width: 12vw;
                height: 12vw;
                z-index: 100;
                font-size: 30px;
                color: black;
            }

            .noselect {
                -webkit-touch-callout: none;
                /* iOS Safari */
                -webkit-user-select: none;
                /* Safari */
                -khtml-user-select: none;
                /* Konqueror HTML */
                -moz-user-select: none;
                /* Firefox */
                -ms-user-select: none;
                /* Internet Explorer/Edge */
                user-select: none;
                /* Non-prefixed version, currently
                                  supported by Chrome and Opera */
            }

            .lineThru {
                text-decoration: line-through !important;
                color: red !important;
            }

            #navPanel {
                font-size: 1rem;
            }

            nav {
                font-weight: 400;
            }

            a:hover {
                text-decoration: none;
            }

            .dropotron li a:hover {
                background-color: #61c200;

            }

            @media screen and (max-width: 480px) {
                h4 {
                    font-size: 13pt;
                    font-weight: bold;
                }
            }

            .week {
                text-align: center;


            }

            .week td {
                cursor: pointer
            }

            .week td:hover {

                color: white;
                background-color: #61c200
            }

            .selected {
                color: white;
                background-color: #61625F
            }
        </style>
    </head>

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
                        <li>
                            <a href="profile.php" id="profile" class="button alt">
                                <?php getName($conn); ?>
                            </a>
                        </li>
                    </ul>

                </nav>
            </header>

            <!-- Main -->
            <section id="main" class="container">
                <header>
                    <h style="font-weight:400;font-size:3rem">List</h2>
                </header>

                <div class="row">
                    <div class="12u">
                        <table class="alt week">
                            <tr>
                                <td class="wk selected" id="week1">
                                    Week 1
                                </td>
                                <td class="wk" id="week2">
                                    Week 2
                                </td>
                                <td class="wk" id="week3">
                                    Week 3
                                </td>
                                <td class="wk" id="week4">
                                    Week 4
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="12u">
                        <section class="box">
                            <div class="noselect table">

                            </div>
                        </section>
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
                    <i id="up" class="fa fa-arrow-up " aria-hidden="true"></i>

                </ul>
                <ul class="copyright">
                    <li>&copy; JMAN - 2018. All rights reserved.</li>
                </ul>
            </footer>


        </div>

        <!-- Scripts -->
        <script src="assets/js/fontawesome.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.js" /></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/jquery.scrollgress.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/list.js"></script>

    </body>

    </html>
    <?php
    db_disconnect($conn);
 ?>
