<?php
 require_once('../private/credential/initialize.php');
require_once('assets/php/recipe.php');
 ?>


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

        <style>
            nav{
                font-weight: 400;
            }
            .toggle {
                margin-left: 0px !important;
            }

            img {
                max-width: 600px;
                margin: 40px auto;
            }

            div h4 {
                margin-bottom: 10px;
            }

            th {
                font-weight: 400 !important;
                font-size: 1.1em !important;

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
                        <li><a href="logout.php" class="button">Sign Out</a></li>
                    </ul>
                </nav>
            </header>

            <!-- Main -->
            <section id="main" class="container">
                <header>
                    <h2 id="recipe_title"></h2>
                </header>
                <div class="box">
                    <span class="image featured"><img id="recipe_img"  alt="" /></span>
                    <div class="row">
                        <div class="3u 6u(mobilep)" style="text-align:center">

                            <i class="fa fa-usd icon major accent1 " style="font-size:0.7rem !important;"></i>
                            <h4 id="cost">
                            </h4>
                        </div>
                        <div class="3u 6u(mobilep)" style="text-align:center">

                            <i class="fa fa-pie-chart icon major accent2 " style="font-size:0.7rem !important"></i>
                            <h4 id="calorie">
                            </h4>
                        </div>
                        <div class="3u 6u(mobilep)" style="text-align:center">

                            <i class="fa fa-clock-o icon major accent3 " style="font-size:0.7rem !important"></i>
                            <h4 id="duration">
                            </h4>
                        </div>
                        <div class="3u 6u(mobilep)" style="text-align:center">

                            <i class="fa fa-users icon major accent4 " style="font-size:0.7rem !important"></i>
                            <h4 id="serving">
                            </h4>
                        </div>



                    </div>
                    <hr />
                    <div class="row">
                        <header>

                            <h3>Summary</h3>

                        </header>
                        <p id="summary">
                        </p>

                    </div>
            </section>


            </div>
            <section class="container">
                <div class="box">

                    <header>

                        <h3>Ingredients</h3>
                    </header>

                    <div class="table-wrapper">

                        <label for="people" style="display:inline-block"> Serving for: </label>
                        <input type="number" name="people" min="1" id="people" style="margin-bottom:10px;width:60px;height:40px;border:2px #1FE861 solid;border-radius:10px;display:inline-block;text-align:center" />

                        <table>
                            <thead>
                                <tr>
                                    <th>Ingredient</th>
                                    <th>Amount</th>
                                    <th>Calories</th>
                                </tr>
                            </thead>
                            <tbody id="ingredients">

                            </tbody>
                        </table>
                    </div>


                    <div class="row">
                        <header>


                            <h3>Instructions</h3>
                        </header>
                        <div>
                            <ol id="instruction">

                            </ol>
                        </div>


                    </div>
                </div>
            </section>
            <section class="container">
                <div class="box">
                    <header>
                        <h3>Cost Calculation</h3>


                    </header>
                    <div class="table-wrapper">

                        <table class="alt">
                            <thead>
                                <tr>
                                    <th>Ingredient</th>
                                    <th>Amount</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr style="font-size:1.2rem;">
                                    <td colspan="2" style="font-weight:400" id="total-desc"></td>
                                    <td style="font-weight:400" id="total"></td>
                                </tr>
                            </tfoot>
                            <tbody id="cost-calculation">

                            </tbody>

                        </table>
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
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/jquery.scrollgress.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/recipe.js"></script>

    </body>

    <?php
    db_disconnect($conn);
 ?>
