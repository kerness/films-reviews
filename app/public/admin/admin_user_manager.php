<?php 

session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location: http://51.38.131.114/index.php');
}


$page_title = "Users list";
include('admin_header_logged.html');
?>

<br>
    <ul class="ul_admin">
        <li class="active"><a href="admin_user_manager.php">Manage users</a></li>
        <li><a href="admin_add_user.php">Add user</a></li>
    </ul>
<br>

<div class="container_admin">

<?php
require_once('../../private/DBconnect.php');

if(isset($_REQUEST['d']) && $_REQUEST['d']==1)
{
    $id = $_GET['id'];
    $q = "DELETE FROM user WHERE user_id = $id";
    $r = mysqli_query($dbc, $q);
    echo "<div class='err'>User has been deleted</div>";
}



$q = "SELECT user_id as id, login, email, user_level, DATE_FORMAT(registration_date, '%d-%m-%Y') AS date FROM user ORDER BY user_id";

$r = mysqli_query($dbc, $q);

$num = mysqli_num_rows($r);

if($num > 0)
{
    echo "<p>Currently there are $num registered users.</p>";

    echo '<table> <tr> <th> ID </th><th> Name </th><th> E-mail address </th><th> Role </th><th> Registration date </th></tr>';
    
    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
    {
        if($row["user_level"] == 0)
        {
            $role = "regular user";
        }
        else{
            $role = "admin";
        }
        echo "<tr> <td>" . $row['id'] . "</td><td>" . $row['login'] . "</td><td>" . $row['email'] . "</td><td>" . $role . "</td><td>"
        . $row['date'] . "</td><td> <a href='admin_edit_user.php?id=" . $row['id'] . "'>Edit</a></td> 
        <td> <a href='admin_user_manager.php?d=1&id=" . $row['id'] . "'>Delete</a></td></tr>";
    }
    
    echo "</table> </div>";
    
    mysqli_free_result($r);
}
else{
    echo "<p> No users are currently registered.</p>";
}

mysqli_close($dbc);

include('../footer.html');

?>

