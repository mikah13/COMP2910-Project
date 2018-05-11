<?php
 session_start();
                        if(!isset($_SESSION['id'])){
                        echo '<li><a href="login.php" class="button">Login</a></li>
					           <li><a href="register.php" class="button">Sign Up</a></li>';
                        }else{
                            echo '<li><a href="logout.php" class="button">Logout</a></li>';
                        }
