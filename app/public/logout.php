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
    header('Location: index.php');

}
?>
