<?php 
   
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('Location: http://51.38.131.114/index.php');
    }
    
    $page_title = "Main page";
    include('admin_header_logged.html');


    echo "<p class='pageHeader'><h1>Welcome, {$_SESSION['login']}</h1></p>";

echo "<p> You have logged in successfully!</p>";

    include('../footer.html');

?>