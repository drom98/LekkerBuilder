<?php

include("../assets/php/dbconfig.php");
session_start();

if(!isset($_SESSION['login_user'])) {
	header("Location: ../login.php");
} 

//Query do titulo
$titulo = "SELECT option_value FROM options WHERE option_name='titulo'";
$result = mysqli_query($dbconfig, $titulo) or die ($titulo);
$row=mysqli_fetch_array($result);
$titulo_row = $row[0];
//Obter o nome de utilizador
$utilizador = $_SESSION['login_user'];

//Query para obter url
$query_url_site = "SELECT option_value FROM options WHERE option_name='url'";
$resultado = mysqli_query($dbconfig, $query_url_site);
$resultado_arr = mysqli_fetch_array($resultado);
$url_site = $resultado_arr[0];

//Upload de ficheiros
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //Caminho para a pasta uploads
    $target = "uploads/";
    $target = $target . basename( $_FILES['ficheiro']['name']);

    //Obter informações do ficheiro
    $ficheiro = basename( $_FILES['ficheiro']['name']);
    $tamanho = basename($_FILES['ficheiro']['size']);
    $url = "http://" . $url_site ."/dashboard/". $target;
    
    //Verificar se o ficheiro existe
    $query_verificar = "SELECT nome_ficheiro FROM uploads WHERE nome_ficheiro = '$ficheiro'";
    $result=mysqli_query($dbconfig, $query_verificar);
    $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count=mysqli_num_rows($result);
    if($count==0) {
        //Guardar o ficheiro no servidor
        if(move_uploaded_file($_FILES['ficheiro']['tmp_name'], $target)) {
        //Mensagem de sucesso
        $mensagem_upload = "O ficheiro ". $ficheiro. " foi carregado com sucesso";
        $query = "INSERT INTO uploads (url, nome_ficheiro, tamanho) VALUES ('$url', '$ficheiro', '$tamanho')";

        //Guarda a informação e o caminho do ficheiro na bd
        mysqli_query($dbconfig, $query) or die ($query);
        } else {
        //Mensagem de erro
        echo "Houve um problema ao carregar o ficheiro.";
        }   
    }
}

?>

<!DOCTYPE html>
<html>
   <!-- HEADER -->
    <?php 
    require_once('parts/header.php');
    ?>
    <body>
        <div class="container">
            <div class="nav">
                <div class="logo"></div>
                <div class="user">
                <?php 
                    echo "<p class='nome'><b>Bem vindo,</b> $utilizador.</p>";
                ?>
                </div>
                <a href="../assets/php/logout.php" class="user logoff">Terminar Sessão.</a>
            </div>
        </div>
        <!-- MENU -->
        <?php 
        require_once('parts/menu.php');
        require_once('parts/titulo-pagina.php');
        ?>
        <div class="container-direita">
            <div class="div-form-upload animated fadeIn">
               <h3 class="titulo-upload">Escolher ficheiro a carregar</h3>
                <form class="form-upload" method="post" action="" enctype="multipart/form-data">
                    <label class="label-upload" for="files">Selecionar...</label>
                    <input class="botao-upload" type="file" name="ficheiro" id="files"><br>
                    <input class="label-upload" type="submit" name="submit" value="Carregar">
                </form>
            </div>
            <div class="ficheiros-recentes">
                <h2 class="titulo-upload">último ficheiro carregado</h2>
                <div class="ficheiros">
                    <div class="imagem">
                        <?php 
                    //Query para obter ficheiros carregados
                    $query = "SELECT url FROM uploads ORDER BY id DESC";
                    $resultado = mysqli_query($dbconfig, $query);
                    $resultado_arr = mysqli_fetch_array($resultado);
                    $imagem = $resultado_arr[0];
                    echo "
                    <style>
                        .imagem {
                            margin: 0 auto;
                            width: 600px;
                            height: 450px;
                            background-image: url($imagem);
                            background-size: contain;
                            background-repeat: no-repeat;
                        }    
                    </style>";
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>








