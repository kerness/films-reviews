<?php 
$page_title = "Sign up";
include('header.html');


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require_once('../private/DBconnect.php');
    $errors = array();

    if(empty($_POST['login']))
    {
        $errors[] = "Enter your name.";
    }
    else
    {
        $log = trim($_POST['login']);
    }

    if(empty($_POST['email']))
    {
        $errors[] = "Enter your e-mail address.";
    }
    else
    {
        $e = trim($_POST['email']);

        $q = "SELECT user_id FROM user WHERE email = '$e'";
        $r = mysqli_query($dbc, $q);

        if(mysqli_num_rows($r) != 0)
        {
            $errors[] = "E-mail address already exists.";
        }
    }

    if(empty($_POST['pass1']) || empty($_POST['pass2']))
    {
        $errors[] = "Enter your password in both fields.";
    }
    else if($_POST['pass1'] != $_POST['pass2'])
    {
        $errors[] = "Passwords are not the same.";
    }
    else
    {
        $p = trim($_POST['pass1']);
    }

    if(empty($errors))
    {
        $q = "INSERT INTO `user` (`user_id`, `login`, `password`, `email`, `user_level`, `registration_date`) VALUES (NULL, '$log', SHA1('$p'), '$e', DEFAULT, NOW())";
        $r = mysqli_query($dbc, $q);
        

        if(mysqli_affected_rows($dbc) == 1)
        {
            echo "<p>Account created successfully!<p>";
            echo "<ul>
            <li><a href='login_inc.php'>Sign in</a></li>
            </ul>";
        }
        else
        {
            echo "<p class='err'>Account not created due to system error.</p>";
        }
        
    }
    else 
    {
        echo "<h1>Warning!</h1><p class='err'>Following errors have occured: <br>";
        foreach($errors as $msg)
        {
            echo "- $msg <br>";
        }
        echo "<br>Try again.</p>";
    }

    mysqli_close($dbc);

}
?>


<h1> Create Account </h1>
<form action="registration.php" method="post">
    <p>Name: <input type="text" name="login" size="20" maxlength="20" value=<?php if(isset($_POST['login'])) echo $_POST['login'];?>></p>
    <p>E-mail address: <input type="text" name="email" size="20" maxlength="60" value=<?php if(isset($_POST['email'])) echo $_POST['email'];?>></p>
    <p>Password: <input type="password" name="pass1" size="10" maxlength="20" ></p>
    <p>Confirm password: <input type="password" name="pass2" size="10" maxlength="20"></p>
    <p><input type="submit" value="Sign up"></p>
</form>

<?php include("footer.html");?>