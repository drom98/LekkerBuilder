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

//UPDATE nomes menus
if(isset($_POST['form_nome_1'])) {
    $nome_1_query = "UPDATE options SET option_value = '$nome_1' WHERE option_name = '$nome_1'";
    $result_nome = mysqli_query($dbconfig, $nome_1_query) or die ($nome_1_query);
}



?>


<!DOCTYPE html>

<html>
    <?php 
    require_once('parts/header.php');
    ?>
    <body>
        <div class="container">
            <div class="nav animated">
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
            <div class="container-form-opcoes animated fadeInUp">
                <?php 
                    echo "
                    <form class='form-opcoes' method='post'>
                        <input class='opcoes input-opcoes opcoes-menus' type='text' name='form_nome_1' value='$nome_1'>
                        <input class='opcoes input-opcoes opcoes-menus' type='text' name='form_nome_2' value='$nome_2'>
                        <input class='opcoes input-opcoes opcoes-menus' type='text' name='form_nome_3' value='$nome_3'>
                        <input class='opcoes input-opcoes opcoes-menus' type='text' name='form_nome_4' value='$nome_4'><br>
                        
                        <input class='opcoes input-opcoes opcoes-menus' type='text' name='form_link_1' value='$link_1'>
                        <input class='opcoes input-opcoes opcoes-menus' type='text' name='form_link_2' value='$link_2'>
                        <input class='opcoes input-opcoes opcoes-menus' type='text' name='form_link_3' value='$link_3'>
                        <input class='opcoes input-opcoes opcoes-menus' type='text' name='form_link_4' value='$link_4'><br>
                        <input class='botao-opcoes enviar' type='submit' name='submit' value='Guardar'>
                    </form>";
                ?>
            </div>
        </div>
    </body>
</html>