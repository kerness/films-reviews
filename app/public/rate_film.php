<?php
    session_start();
    if(!isset($_SESSION['user_id'])) {
        header('Location: http://51.38.131.114/index.php');
    }


    $page_title = "Rate a film";
    include('header_logged.html');
    require_once('../private/DBconnect.php');
    if ($dbc == false) {
        die("ERROR: Could not connect to database: " . mysqli_connect_error());
    }
    $u_id = $_SESSION['user_id'];
    $m_id = $_REQUEST['m_id'];
    $title = $_REQUEST["title"];

    echo "You are rating a film titled $title. ";

    if(isset($_GET['form_submitted']))
    {    
        $rate = $_GET['rate'];
        $m_id = $_GET['m_id'];
        $sql = "INSERT INTO reviews (user_id, movie_id, rating, text) VALUES ($u_id, $m_id, $rate, '');";

        // zrobić tak żeby nie dało się ocenić filmu już ocenionego

        if (mysqli_query($dbc, $sql)) {
            echo "Your rate for a $title film has been saved!";
        } else {
            echo "$title Error: " . $sql . ":-" . mysqli_error($dbc);
        }
        mysqli_close($dbc);
    } 
?>
    <form action="rate_film.php" method="get">
        <select id="rate" name="rate">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="hidden" name="form_submitted" value="1"/>
        <input type="hidden" name="m_id" value="<?php echo $m_id;?>"/> 
        <input type="hidden" name="title" value="<?php echo $title;?>"/> 
        <input type="submit" name="submit" value="Rate!">
    </form>
<?php include("footer.html")?>