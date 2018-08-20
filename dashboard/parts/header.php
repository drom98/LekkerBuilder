<?php 

include_once('../assets/php/dbconfig.php');

//Query do titulo
$titulo = "SELECT option_value FROM options WHERE option_name='titulo'";
$result = mysqli_query($dbconfig, $titulo) or die ($titulo);
$row=mysqli_fetch_array($result);
$titulo_row = $row[0];


echo "<head>
        <title>$titulo_row - Dashboard</title>
        <meta charset='utf-8'>
        <link rel='shortcut icon' type='image/png' href='../assets/images/favicon.png'>
        <link rel='stylesheet' href='styles-dashboard.css'>
        <link rel='stylesheet' href='../assets/css/animate.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
    </head>";
?>