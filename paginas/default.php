<?php 

include("../assets/php/dbconfig.php");
session_start();

//Query do titulo
$titulo = "SELECT option_value FROM options WHERE option_name='titulo'";
$result = mysqli_query($dbconfig, $titulo) or die ($titulo);
$row=mysqli_fetch_array($result);
$titulo_row = $row[0];

//Query ao bg
$query_bg = "SELECT option_value FROM options WHERE option_name='background_image'";
$result_bg = mysqli_query($dbconfig, $query_bg);
$row_bg = mysqli_fetch_array($result_bg);
$bg = $row_bg[0];

//Query ao cabeçalho
$query_cab = "SELECT option_value FROM options WHERE option_name='titulo_cabecalho'";
$result_cab = mysqli_query($dbconfig, $query_cab);
$row_cab = mysqli_fetch_array($result_cab);
$titulo_cabecalho = $row_cab[0];

//Obter links menus
$link_1_query = "SELECT option_value FROM options WHERE option_name='link_menu_1'";
$result_link = mysqli_query($dbconfig, $link_1_query) or die ($link_1_query);
$row_link_1=mysqli_fetch_array($result_link);
$link_1 = $row_link_1[0];

$link_2_query = "SELECT option_value FROM options WHERE option_name='link_menu_2'";
$result_link = mysqli_query($dbconfig, $link_2_query) or die ($link_2_query);
$row_link_2=mysqli_fetch_array($result_link);
$link_2 = $row_link_2[0];

$link_3_query = "SELECT option_value FROM options WHERE option_name='link_menu_3'";
$result_link = mysqli_query($dbconfig, $link_3_query) or die ($link_3_query);
$row_link_3=mysqli_fetch_array($result_link);
$link_3 = $row_link_3[0];

$link_4_query = "SELECT option_value FROM options WHERE option_name='link_menu_4'";
$result_link = mysqli_query($dbconfig, $link_4_query) or die ($link_4_query);
$row_link_4=mysqli_fetch_array($result_link);
$link_4 = $row_link_4[0];


//Obter nomes menus
$nome_1_query = "SELECT option_value FROM options WHERE option_name='nome_menu_1'";
$result_nome = mysqli_query($dbconfig, $nome_1_query) or die ($nome_1_query);
$row_nome_1=mysqli_fetch_array($result_nome);
$nome_1 = $row_nome_1[0];

$nome_2_query = "SELECT option_value FROM options WHERE option_name='nome_menu_2'";
$result_nome = mysqli_query($dbconfig, $nome_2_query) or die ($link_2_query);
$row_nome_2=mysqli_fetch_array($result_nome);
$nome_2 = $row_nome_2[0];

$nome_3_query = "SELECT option_value FROM options WHERE option_name='nome_menu_3'";
$result_nome = mysqli_query($dbconfig, $nome_3_query) or die ($nome_3_query);
$row_nome_3=mysqli_fetch_array($result_nome);
$nome_3 = $row_nome_3[0];

$nome_4_query = "SELECT option_value FROM options WHERE option_name='nome_menu_4'";
$result_nome = mysqli_query($dbconfig, $nome_4_query) or die ($nome_4_query);
$row_nome_4=mysqli_fetch_array($result_nome);
$nome_4 = $row_nome_4[0];


?>


<!DOCTYPE html>
<html>
    <?php 
    echo "
        <head>
            <title>$titulo_row</title>
            <meta charset='utf-8'>
            <link rel='shortcut icon' type='image/png' href='../assets/images/favicon.png'>
            <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
        </head>";
    
    //Estilos da página
    echo "
        <style>
            
            * {
                padding: 0;
                margin: 0;
            }
            
            body {
                height: 100vh;
                background-image: url('$bg');
                background-size: cover;
                background-repeat: no-repeat;
            }
            
            .container-nav {
                width: 100%;
                height: 60px;
            }
            
            .logo {
                float: left;
                width: $/width_logo;
                background-image: url('$/logo');
                background-size: 60% auto;
                background-repeat: no-repeat;
                background-position: center;
            }
            
            .menu {
                padding: 20px;
                float: right;
                display: inline-block;
            }
            
            .link {
                font-family: 'Raleway';
                color: white;
                color: $/color_text;
                text-decoration: none;
                padding: 10px;
            }
            
            .container-titulo {
                font-family: 'Raleway';
                text-transform: uppercase;
                position: relative;
                padding-top: 120px;
                width: 55%;
                height: auto;
                margin: 0 auto;
                color: white;
            }
            
            .titulo h1 {
                font-family: 'Raleway' !important;
                font-size: 60px;
                text-align: center;
                font-family: '$//font';
            }
            
            .titulo p {
                font-family: 'Raleway';
                font-size: 18px;
                text-align: center;
            }
            
        </style>";
    
    echo "
        <body>
            <div class='container-nav'>
                <div class='nav'>
                    <div class='logo'></div>
                    <div class='menu'>
                        <a href='$link_1' class='link'>$nome_1</a>
                        <a href='$link_2' class='link'>$nome_2</a>
                        <a href='$link_3' class='link'>$nome_3</a>
                        <a href='$link_4' class='link'>$nome_4</a>
                    </div>
                </div>
            </div>
            
            <div class='container-titulo'>
                <div class='titulo'>
                    <h1>$titulo_cabecalho</h1>
                    <p>Site construido com o LekkerBuilder</p>
                </div>
            </div>
        </body>";
    ?>
</html>














