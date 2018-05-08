<?php
    require_once('../../private/credential/session.php');
 ?>

<?php
echo $user['id']; ?>
<h2><a href = "logout.php">Sign Out</a></h2>
 <?php
    db_disconnect($conn);
 ?>
