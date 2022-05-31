<?php 
$page_title = "Sign in";
include('header.html');

if(isset($errors) && !empty($errors))
{
    echo "<h1>Warning!</h1><p class='err'>Following errors have occured: <br>";
    foreach($errors as $msg)
    {
        echo "- $msg <br>";
    }
    echo "<br>Try again.</p>";
}
?>


<form action="login.php" method="post">
    <h1>Sign in</h1>
    <p>E-mail address: <input type='text' name='email'></p> 
    <p>Password: <input type='password' name='pass'></p>
    <p><input type='submit' value='Sign in'></p>
</form>

<?php include('footer.html');?>