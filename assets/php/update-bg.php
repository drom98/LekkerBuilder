<?php 

include_once('dbconfig');
//UPDATE background
    if(isset($_POST['ficheiro_bg'])) {
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

header('Location: ../../dashboard/opcoes-site.php');

?>