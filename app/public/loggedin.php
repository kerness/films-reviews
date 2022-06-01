<?php 
    
    session_start();
    
    $page_title = "Main page";
    include('header_logged.html');


    echo "<p class='pageHeader'><h1>Welcome, {$_SESSION['login']}</h1></p>";

?>

<p> You have logged in successfully!</p>

<?php include("Footer.html");?>