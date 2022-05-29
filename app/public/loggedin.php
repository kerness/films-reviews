<?php 
    
    session_start();
    
    $page_title = "Main page";
    include('header_logged.html');


    //echo "<p class='pageHeader'>Witaj {$_COOKIE['first_name']}</p>";
    echo "<p class='pageHeader'>Welcome, {$_SESSION['login']}</p>";

?>

<p> You have logged successfully!</p>

<?php include("Footer.html");?>