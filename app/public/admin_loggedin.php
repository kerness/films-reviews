<?php 
   
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('Location: http://51.38.131.114/index.php');
    }
    
    $page_title = "Main page";
    include('admin_header_logged.html');


    echo "<p class='pageHeader'>Welcome, {$_SESSION['login']}!</p>";

    include('footer.html');

?>