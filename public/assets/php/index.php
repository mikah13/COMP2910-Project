<?php
 session_start();
                        if (!isset($_SESSION['id'])) {
                            echo '<li style="white-space: nowrap;"><a href="login.php" class="button">Login</a></li>
					           <li style="white-space: nowrap;"><a href="register.php" class="button">Sign Up</a></li>';
                        } else {
                            echo '<li style="white-space: nowrap;"><a href="logout.php" class="button">Logout</a></li>';
                        }
