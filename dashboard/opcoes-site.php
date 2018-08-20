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

//Query do titulo cabecalho
$titulo_cab = "SELECT option_value FROM options WHERE option_name='titulo_cabecalho'";
$result_cab = mysqli_query($dbconfig, $titulo_cab) or die ($titulo_cab);
$row_cab=mysqli_fetch_array($result_cab);
$cab_row = $row_cab[0];

//UPDATE das informações do site
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //UPDATE do titulo
    $titulo_site = $_POST['titulo_site'];
    $query_titulo = "UPDATE options SET option_value = '$titulo_site' WHERE option_name = 'titulo'";
    mysqli_query($dbconfig, $query_titulo);
    
    //UPDATE titulo cabeçalho
    $titulo_cabecalho = $_POST['titulo_cab'];
    $query_cab = "UPDATE options SET option_value = '$titulo_cabecalho' WHERE option_name = 'titulo_cabecalho'";
    mysqli_query($dbconfig, $query_cab);
    
    //UPDATE background
    if(!isset($_POST['ficheiro_bg'])) {
        //Query para obter url
        $query_url_site = "SELECT option_value FROM options WHERE option_name='url'";
        $resultado = mysqli_query($dbconfig, $query_url_site);
        $resultado_arr = mysqli_fetch_array($resultado);
        $url_site = $resultado_arr[0];
        
        //Caminho para a pasta uploads
        $target = "uploads/";
        $target = $target . basename($_FILES['ficheiro_bg']['name']);

        //Obter informações do ficheiro
        $ficheiro = basename( $_FILES['ficheiro_bg']['name']);
        $tamanho = basename($_FILES['ficheiro_bg']['size']);
        $url = "http://" . $url_site ."/dashboard/". $target;

        //Verificar se o ficheiro existe
        $query_verificar = "SELECT nome_ficheiro FROM uploads WHERE nome_ficheiro = '$ficheiro'";
        $result=mysqli_query($dbconfig, $query_verificar);
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count=mysqli_num_rows($result);
        if($count==0) {
            //Guardar o ficheiro no servidor
            if(move_uploaded_file($_FILES['ficheiro_bg']['tmp_name'], $target)) {
            //Mensagem de sucesso
            $mensagem_upload = "O ficheiro ". $ficheiro. " foi carregado com sucesso";
            $query = "INSERT INTO uploads (url, nome_ficheiro, tamanho) VALUES ('$url', '$ficheiro', '$tamanho')";
            //Guarda a informação e o caminho do ficheiro na bd
            mysqli_query($dbconfig, $query) or die ($query);
            } else {
            //Mensagem de erro
            echo "Houve um problema ao carregar o ficheiro.";
            }
    
            $query = "SELECT url FROM uploads ORDER BY id DESC";
            $resultado = mysqli_query($dbconfig, $query);
            $resultado_arr = mysqli_fetch_array($resultado);
            $imagem = $resultado_arr[0];
    
            $background = "INSERT INTO options (option_name, option_value) VALUE ('background_image', '$imagem')";
            mysqli_query($dbconfig, $background);
            } else {
            echo "O ficheiro já existe na base de dados";
            }   
    }
    
    //UPDATE logotipo
    /*if(!isset($_POST['logotipo'])) {
        //Query para obter url
        $query_url_site = "SELECT option_value FROM options WHERE option_name='url'";
        $resultado = mysqli_query($dbconfig, $query_url_site);
        $resultado_arr = mysqli_fetch_array($resultado);
        $url_site = $resultado_arr[0];
        
        //Caminho para a pasta uploads
        $target = "uploads/";
        $target = $target . basename($_FILES['logotipo']['name']);

        //Obter informações do ficheiro
        $ficheiro = basename( $_FILES['logotipo']['name']);
        $tamanho = basename($_FILES['logotipo']['size']);
        $url = "http://" . $url_site ."/dashboard/". $target;

        //Verificar se o ficheiro existe
        $query_verificar = "SELECT nome_ficheiro FROM uploads WHERE nome_ficheiro = '$ficheiro'";
        $result=mysqli_query($dbconfig, $query_verificar);
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count=mysqli_num_rows($result);
        if($count==0) {
            //Guardar o ficheiro no servidor
            if(move_uploaded_file($_FILES['logotipo']['tmp_name'], $target)) {
                //Mensagem de sucesso
                $mensagem_upload = "O ficheiro ". $ficheiro. " foi carregado com sucesso";
                $query = "INSERT INTO uploads (url, nome_ficheiro, tamanho) VALUES ('$url', '$ficheiro', '$tamanho')";
                //Guarda a informação e o caminho do ficheiro na bd
                mysqli_query($dbconfig, $query);
                } else {
                    //Mensagem de erro
                    echo "Houve um problema ao carregar o ficheiro.";
                }
    
                $query = "SELECT url FROM uploads ORDER BY id DESC";
                $resultado = mysqli_query($dbconfig, $query);
                $resultado_arr = mysqli_fetch_array($resultado);
                $imagem = $resultado_arr[0];
    
                $background = "INSERT INTO options (option_name, option_value) VALUE ('logotipo', '$imagem')";
                mysqli_query($dbconfig, $background);
                } else {
                echo "O ficheiro já existe na base de dados";
                }   
        }*/
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
                    <form class='form-opcoes' method='post' enctype='multipart/form-data'>
                        <label class='opcoes label-opcoes'>Título do site</label>
                        <input class='opcoes input-opcoes' type='text' value='$titulo_row' name='titulo_site'><br>
                        <label class='opcoes label-opcoes'>Título cabeçalho</label>
                        <input class='opcoes input-opcoes' type='text' value='$cab_row' name='titulo_cab'><br>
                        <label class='opcoes label-opcoes'>Subtitulo</label>
                        <input class='opcoes input-opcoes' type='text' value='' name='subtitulo'><br>
                        <label class='opcoes label-opcoes'>Background</label>
                        <label class='botao-opcoes' for='files'>Selecionar...</label>
                        <input class='label-opcoes' type='file' name='ficheiro_bg' id='files'><br>
                        <label class='opcoes label-opcoes'>Logotipo</label>
                        <label class='botao-opcoes' for='files'>Selecionar...</label>
                        <input class='label-opcoes' type='file' name='logotipo' id='files'><br>
                        <input class='botao-opcoes enviar' type='submit' name='submit' value='Guardar'>
                    </form>";
                ?>
            </div>
        </div>
    </body>
</html>








