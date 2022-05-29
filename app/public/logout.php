<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location: index.php');
}
else
{
    $_SESSION = [];
    session_destroy();
    setcookie('PHPSESSID', "", time() - 60);
}

//setcookie("user_id", "", time() - 60);
//setcookie("first_name", "", time() - 60);

$page_title = "Log out";
include("header.html")

?>

<p> You have logged out safely!</p>


<ul>
    <li><a href="index.php">Powrót do strony głównej</a></li>
    
</ul>



<?php include("Footer.html");?>