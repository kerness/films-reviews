<?php
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('Location: http://51.38.131.114/index.php');
    }
    
    $page_title = "Users Manager";
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

<?php include("footer.html")?>