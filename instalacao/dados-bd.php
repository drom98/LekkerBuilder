<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $bd = "'".($_POST['nome-bd'])."'";
    $user = "'".($_POST['nome-user'])."'";
    $password = "'".($_POST['password'])."'";
    $servidor = "'".($_POST['servidor'])."'";
    
/*Conteudo a escrever no ficheiro dbconfig.php*/
$info = "<?php\n
$"."bd = $bd;
$"."user = $user;
$"."password = $password;
$"."servidor = $servidor;\n
$"."dbconfig = mysqli_connect($servidor, $user, $password, $bd);\n
?>";

    /*Cria o ficheiro dbconfig.php e escreve a info*/
    $ficheiro = fopen("../assets/php/dbconfig.php", "w+");
    fwrite($ficheiro, $info);
    fclose($ficheiro);
    header('Location: ../assets/php/db-connect-test.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>LekkerBuilder - Dados BD</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/png" href="../assets/images/favicon.png"/>
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/animate.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="erro loading  animated fadeInDown" id="loading">
            <?php echo "<?xml version='1.0' encoding='utf-8'?>"?><svg width='20px' height='20px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-ring"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><circle cx="50" cy="50" r="48.5" stroke-dasharray="182.84069243892594 121.89379495928398" stroke="#009688" fill="none" stroke-width="7"><animateTransform attributeName="transform" type="rotate" values="0 50 50;180 50 50;360 50 50;" keyTimes="0;0.5;1" dur="2s" repeatCount="indefinite" begin="0s"></animateTransform></circle></svg>
            <p class="msg-erro-dados-bd" id="1">A criar as tabelas na bd...</p>
        </div>
        <!--CAIXA DE TEXTO-->
        <div class="container-caixa">
            <div class="animated fadeInUp caixa-dados-bd">
                <div class="logo"></div>
                <h3 class="titulo">Insira as seguintes informações</h3>
                <div class="container-form">
                    <form class="form-bd" action="" method="post">
                        <!--Nome da BD-->
                        <label>Nome da base de dados</label>
                        <input class="textbox"type="text" name="nome-bd" required="true">
                        <!--Nome de utilizador-->
                        <label>Nome de utilizador</label>
                        <input class="textbox" type="text" name="nome-user" required="true">
                        <!--Password-->
                        <label>Password</label><br>
                        <input class="textbox" type="password" name="password">
                        <!--Servidor-->
                        <label>Servidor</label><br>
                        <input class="textbox" type="text" name="servidor" required="true">
                        <input class="btn-seguinte dados" type="submit" name="submit" value="Seguinte" id="botao">
                        <!--Script para mostrar o loading-->
                        <script>
                            $('#botao').on("click", function() {
                                $("#loading").css("display", "block");
                            });
                        </script>
                    </form>
                </div>
                <p class="info-dados-bd">*Todas estas informações irão ser escritas num ficheiro de configuração que pode ser posteriormente alterado.</p>
            </div>
        </div>
    </body>
</html>