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
        <li class="users"><a href="admin_user_manager.php">Manage users</a></li>
        <li class="users"><a href="admin_add_user.php">Add user</a></li>
    </ul>
</div>
<br>

<?php

    require_once("../../private/DBconnect.php");
    $id = $_REQUEST["id"];

    $q = "SELECT user_id, login, email, password, user_level FROM user WHERE user_id = $id";
    $r = mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    //UPDATE NAME
    if(isset($_REQUEST["u"]) && $_REQUEST["u"] == 1 && $_REQUEST["login"] != $row["login"])
    {
        $q = "UPDATE user SET login = '".$_REQUEST["login"]."' WHERE user_id = $id";
        $r = mysqli_query($dbc, $q);
        $row["login"] = $_REQUEST["login"];

    }


    //UPDATE PASSWORD
    if(isset($_REQUEST["u"]) && $_REQUEST["u"] == 1 && !empty($_REQUEST["pass"]))
    {
        $q = "UPDATE user SET password = SHA1('".$_REQUEST["pass"]."') WHERE user_id = $id";
        $r = mysqli_query($dbc, $q);
    }


    mysqli_close($dbc);

?>


<h1> Edit user's personal information </h1>
<form action="admin_edit_user.php" method="post">
    <p><input type="hidden" name="u" value="1"></p>
    <p>ID: <input type="text" name="id" value="<?php echo $row["user_id"]; ?>" readonly></p>
    <p>Role: <input type="text" name="role" value="<?php if($row["user_level"]==0){ echo "regular user";} else { echo "admin";}; ?>" readonly></p>
    <p>Name: <input type="text" name="login" value="<?php echo $row["login"]; ?>"></p>
    <p>E-mail address: <input type="text" name="email" value="<?php echo $row["email"]; ?>" readonly></p>
    <p>Password: <input type="password" name="pass" ></p>
    <input type="submit" value="Save">
</form>


<?php include("footer.html")?>