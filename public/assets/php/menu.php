<?php
require_once('../../../private/credential/initialize.php');

                        $stmt = "SELECT * FROM user_recipe WHERE recipe_id = {$_POST['recipe_id']} AND day = '{$_POST['day']}'";
                         $result = mysqli_query($conn, $stmt);

                         if (mysqli_num_rows($result)===0) {
                             $stmt = "INSERT INTO user_recipe(id, recipe_id, recipe_title ,day, quantity) VALUES({$_SESSION['id']}, {$_POST['recipe_id']},'{$_POST['recipe_title']}','{$_POST['day']}',{$_POST['quantity']})";
                             $result = mysqli_query($conn, $stmt);
                         } else {
                             $quantity =  mysqli_fetch_assoc($result)['quantity']  + $_POST['quantity'];
                             $stmt = "UPDATE user_recipe SET quantity = {$quantity} WHERE recipe_id = {$_POST['recipe_id']} AND day = '{$_POST['day']}'";
                             $result = mysqli_query($conn, $stmt);
                         }



 db_disconnect($conn);
