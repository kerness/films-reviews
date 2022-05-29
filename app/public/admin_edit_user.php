<?php
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('Location: http://51.38.131.114/index.php');
    }
    
    $page_title = "Edit user data";
    include('admin_header_logged.html');
?>

<br>
<div class="b" >
    <ul >
        <li class="users"><a href="admin_user_manager.php">Zarządzanie użytkownikami</a></li>
        <li class="users"><a href="admin_add_user.php">Dodawanie użytkowników</a></li>
    </ul>
</div>
<br>

<?php

    require_once("DBconnect.php");
    $id = $_REQUEST["id"];


    if(isset($_REQUEST["u"]) && $_REQUEST["u"] == 1)
    {
        $q = "UPDATE user SET login = '".$_REQUEST["login"]."', email = '".$_REQUEST["email"]."', password = '".$_REQUEST["pass"]."' WHERE user_id = $id";
        $r = mysqli_query($dbc, $q);
        mysqli_close($dbc);
        header('Location: http://localhost/project/film-reviews/admin_user_manager.php');

    }


    $q = "SELECT user_id, login, email, password, user_level FROM user WHERE user_id = $id";
    $r = mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

?>


<h1> Edit user's personal information </h1>
<form action="admin_edit_user.php" method="post">
    <p><input type="hidden" name="u" value="1"></p>
    <p>ID: <input type="text" name="id" value="<?php echo $row["user_id"]; ?>" readonly></p>
    <p>Role: <input type="text" name="role" value="<?php if($row["user_level"]==0){ echo "regular user";} else { echo "admin";}; ?>" readonly></p>
    <p>Name: <input type="text" name="login" value="<?php echo $row["login"]; ?>"></p>
    <p>E-mail address: <input type="text" name="email" value="<?php echo $row["email"]; ?>"></p>
    <p>Password: <input type="text" name="pass" value="<?php echo $row["password"]; ?>"></p>
    <input type="submit" value="Save">
</form>


<?php include("footer.html")?>