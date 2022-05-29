<?php 

session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location: http://51.38.131.114/index.php');
}

$page_title = "My profile";
include('header_logged.html');


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require_once('DBconnect.php');

    $errors = array();
    
    if(empty($_POST['login']))
    {
        $errors[] = "Enter your name.";
    }
    else
    {
        $n = trim($_POST['login']);
    }

    if(empty($_POST['pass']))
    {
        if(($_POST['login'] != $_SESSION["login"]) || !(empty($_POST['new_pass1']) && empty($_POST['new_pass2'])))
        {
            $errors[] = "Enter current password.";
        }
    }
    else
    {
        $p = trim($_POST['pass']);
    }

    $action  = FALSE;
    if(!(empty($_POST['new_pass1']) && empty($_POST['new_pass2'])))
    {
        if($_POST['new_pass1'] != $_POST['new_pass2'])
        {
            $errors[] = "Enter the same new password in both fields.";
        }
        else
        {
            $np = trim($_POST['new_pass1']);
            $action = TRUE;
        }
    }


    if(empty($errors))
    {
        $em = $_SESSION['email'];

        //update NAME
        if($n != $_SESSION["login"])
        {
            $q = "UPDATE user SET login='$n' WHERE email='$em' AND password='$p'";
            $r = mysqli_query($dbc, $q);        

            if(mysqli_affected_rows($dbc) == 1)
            {
                $_SESSION["login"] = $n;
                echo "<p>Name has been changed.<p>";
            }
            else
            {
                echo "<p class='err'>Name has not been changed. Current password might be incorrect.</p>";
            }
        }

        //update PASSWORD

        if($action)
        {
            $q = "UPDATE user SET password='$np' WHERE email='$em' AND password='$p'";
            $r = mysqli_query($dbc, $q);

            if(mysqli_affected_rows($dbc) == 1)
            {
                echo "<p>Password has been changed.<p>";
            }
            else
            {
                echo "<p class='err'>Password has not been changed. Current password might be incorrect.</p>";
            }
            
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


<h1> Edit personal information </h1>
<form action="my_profile.php" method="post">
    <p>E-mail address: <input type="text" name="email" size="20" maxlength="60" value=<?php echo $_SESSION["email"] ?> readonly></p>
    <br>
    <p>Name: <input type="text" name="login" size="20" maxlength="20" value=<?php echo $_SESSION['login']; ?>></p>
    <p>New password: <input type="password" name="new_pass1" size="10" maxlength="20"></p>
    <p>Confirm new password: <input type="password" name="new_pass2" size="20" maxlength="60"></p>
    <br>
    <p>Current password: <input type="password" name="pass" size="10" maxlength="20"></p>
    <p><input type="submit" value="Save"></p>
</form>

<?php include("footer.html");?>