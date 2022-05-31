<?php 
    
    session_start();
    
    $page_title = "Main page";
    include('header_logged.html');


    echo "<p class='pageHeader'><h1>Welcome, {$_SESSION['login']}</h1></p>";
//<div class="pageheader"><h1>Welcome to our website!</h1></div>


//<p> Here you can browse films ratings available in our database.</p>
?>

<p> You have logged successfully!</p>

<?php include("Footer.html");?>