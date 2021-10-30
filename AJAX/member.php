<?php
session_start();
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
console_log("Logging in !");
console_log($_SESSION);

if(!isset($_SESSION["sess_user"])){
    header("location:/loginWindow/AJAX/login/login.html");
} else {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <title>Facepage | Welcome</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    </head>
    <header class="text-center">
        <p>
            <img src="Logo.png" height="84" width="340"/>
        </p>
<!--        <h1>My Server - Dashboard</h1>-->
        <h2>Welcome <?=$_SESSION['sess_user'];?>! , <a href="/loginWindow/AJAX/logout.php">Logout</a></h2>
        <p> LAB 2 , DONE ! </p>
    </header>
    </html>
    <?php
}
?>