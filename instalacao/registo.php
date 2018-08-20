<?php 

include_once('../assets/php/dbconfig.php');
session_start();

//Obter ip do utilizador 
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
$user_ip = getUserIP();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $utilizador = mysqli_real_escape_string($dbconfig, $_POST['utilizador']);
    $email = mysqli_real_escape_string($dbconfig, $_POST['email']);
    $pw_normal = mysqli_real_escape_string($dbconfig, $_POST['password']);
    $password = md5(mysqli_real_escape_string($dbconfig, $_POST['password']));
    $password_repeat = md5(mysqli_real_escape_string($dbconfig, $_POST['password-repeat']));

    //Query para inserir o utilizador
    $inserir = "INSERT INTO `users`(`user`, `password`, `email`, `tipo`, `ip`, `reg_date`)
    VALUES ('$utilizador', '$password', '$email', 'admin', '$user_ip', NOW())";

    //Query para verificar se o utilizador já existe
    $verificar = "SELECT user FROM users WHERE user='$utilizador'";

    //Verificar se as password coincidem
    if ($password != $password_repeat) {
        echo "<div class='erro'>";
        echo "<p class='animated shake'>As passwords não coincidem</p>";
        echo "</div>";
    } else {
        //Verificar se a pw é forte
        if (strlen($pw_normal) < 6 ) {
            echo "<div class='erro'>";
            echo "<p class='animated shake'>A password é demasiado pequena</p>";
            echo "</div>";
        } else {
            //Verificar se o user já existe
            if ($result = mysqli_query($dbconfig, $verificar)) {
                $row_count = mysqli_num_rows($result);
                if ($row_count == null) {
                    mysqli_query($dbconfig, $inserir);
                    //Email
                    if (function_exists('mail')) {
                        $mensagem = "Registou com sucesso a sua conta no LekkerBuilder.\nAbaixo estão as suas informações de acesso:
                        Utilizador: $utilizador\nEmail: $email\nPassword: $pw_normal\nEndereço IP: $user_ip";
                        $assunto = "Bem vindo ao LekkerBuilder, $utilizador";
                        mail($email, $assunto, $mensagem);
                    } else {
                        echo "<div class='erro'>";
                        echo "<p class='animated shake'>A função de email está desativada no servidor.</p>";
                        echo "</div>";
                    }
                    //Div de erro
                    echo "<div class='erro'>";
                    echo "<p class='animated shake'>Conta registada com sucesso</p>";
                    echo "</div>";
                    sleep(10);
                    //Redireciona para a página de login
                    header('Location: ../login.php');
                    } else {
                    echo "<div class='erro'>";
                    echo "<p class='animated shake'>O utilizador já existe</p>";
                    echo "</div>";
                    }
                }
                } 
            }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>LekkerBuilder - Registo</title>
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
            <p class="msg-erro-dados-bd" id="1">A registar utilizador e a enviar email...</p>
        </div>
        <!--CAIXA DE TEXTO-->
        <div class="container-caixa">
            <div class="animated fadeInUp caixa-dados-bd">
                <div class="logo"></div>
                <h3 class="titulo">Criar conta de administrador</h3>
                <div class="container-form">
                    <form class="form-bd" action="" method="post">
                        <!--Nome da BD-->
                        <label>Nome de utilizador</label>
                        <input class="textbox"type="text" required="true" name="utilizador">
                        <!--Nome de utilizador-->
                        <label>Email</label>
                        <input class="textbox" type="email" required="true" name="email">
                        <!--Password-->
                        <label>Password</label><br>
                        <input class="textbox" type="password" required="true" name="password">
                        <!--Servidor-->
                        <label>Repetir password</label><br>
                        <input class="textbox" type="password" name="password-repeat">
                        <input class="btn-seguinte" type="submit" name="submit" value="Seguinte" id="botao">
                        <!--Script para mostrar o loading-->
                        <script>
                            $('#botao').on("click", function() {
                                $("#loading").css("display", "block");
                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>