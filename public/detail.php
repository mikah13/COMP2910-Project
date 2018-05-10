<?php
if(isset($_POST['data'])){
    echo '<p>'.json_encode($_POST['data']).
    '
    </p>';
}
else{
    header('Location: summary.php');
}
?>
<h1>Hello world</h1>
 <script>$.getScript('/assets/js/detail.js')</script>
