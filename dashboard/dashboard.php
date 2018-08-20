<?php

include("../assets/php/dbconfig.php");
session_start();
if(!isset($_SESSION['login_user']))
	{
	header("Location: ../login.php");
	} 

//Query do titulo
$titulo = "SELECT option_value FROM options WHERE option_name='titulo'";
$result = mysqli_query($dbconfig, $titulo) or die ($titulo);
$row=mysqli_fetch_array($result);
$titulo_row = $row[0];

//Obter o nome de utilizador
$utilizador = $_SESSION['login_user'];

//Query para obter URL da tabela options
$query_url = "SELECT option_value FROM options WHERE option_name='url'";
$resultado_url = mysqli_query($dbconfig, $query_url);
$row_url = mysqli_fetch_array($resultado_url);
$url = $row_url[0];

//Query para obter email do utilizador
$query_email = "SELECT email FROM users";
$resultado_email = mysqli_query($dbconfig, $query_email);
$row_email = mysqli_fetch_array($resultado_email);
$email = $row_email[0];

//Query para obter tipo de conta do utilizador
$query_tipo = "SELECT tipo FROM users";
$resultado_tipo = mysqli_query($dbconfig, $query_tipo);
$row_tipo = mysqli_fetch_array($resultado_tipo);
$tipo = $row_tipo[0];

?>

<!DOCTYPE html>
<html>
    <?php 
    require_once('parts/header.php');
    ?>
    <body>
        <div class="container">
            <div class="nav animated fadeInUp">
                <div class="logo"></div>
                <div class="user">
                <?php 
                    echo "<p class='nome'><b>Bem vindo,</b> $utilizador.</p>";
                ?>
                </div>
                <a href="../assets/php/logout.php" class="user logoff">Terminar Sessão.</a>
            </div>
        </div>
        <?php 
        require_once('parts/menu.php');
        require_once('parts/titulo-pagina.php');
        ?>
        <div class="container-direita">
            <div class="container-dir animated fadeInUp">
                <h3>Nome do template</h3>
                <p>LekkerDefault</p><br>
                <h3>Título da página:</h3>
                <p><?php echo $titulo_row ?></p><br>
                <h3>Index</h3>
                <p><?php echo $url ?></p><br>
                <h3>Utilizador</h3>
                <p><?php echo $utilizador ?></p><br>
                <h3>Tipo de conta</h3>
                <p><?php echo $tipo ?></p><br>
                <h3>Email</h3>
                <p><?php echo $email ?></p><br>
                <h3>LekkerBuilder</h3>
                <p>v.0.3.1</p><br>
            </div>
        </div>
    </body>
</html>










