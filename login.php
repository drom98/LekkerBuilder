<?php

include("assets/php/dbconfig.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
 {

$username = mysqli_real_escape_string($dbconfig, $_POST['utilizador']);
$password = md5(mysqli_real_escape_string($dbconfig, $_POST['password']));

$sql_query="SELECT id FROM users WHERE user='$username' and password='$password'";
$result=mysqli_query($dbconfig,$sql_query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$count=mysqli_num_rows($result);

if($count==1)
{
$_SESSION['login_user']=$username;

header("location: dashboard/dashboard.php");
}
else
{
    echo "<div class='erro'>";
    echo "<p class='animated shake'>Dados incorretos. Tente novamente.</p>";
    echo "</div>";
}
}

echo "<head>
        <title>LekkerBuilder - Login</title>
        <meta charset='utf-8'>
        <link rel='shortcut icon' type='image/png' href='assets/images/favicon.png'/>
        <link rel='stylesheet' href='assets/css/styles.css'>
        <link rel='stylesheet' href='assets/css/animate.css''>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
        <script src='https://code.jquery.com/jquery-3.2.1.min.js' integrity='sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4='crossorigin='anonymous'></script>
    </head>";

?>


<!DOCTYPE html>
<html>
    <body>
        <div class="erro loading animated fadeInDown" id="loading">
            <?xml version="1.0" encoding="utf-8"?><svg width='20px' height='20px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-ring"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><circle cx="50" cy="50" r="48.5" stroke-dasharray="182.84069243892594 121.89379495928398" stroke="#009688" fill="none" stroke-width="7"><animateTransform attributeName="transform" type="rotate" values="0 50 50;180 50 50;360 50 50;" keyTimes="0;0.5;1" dur="2s" repeatCount="indefinite" begin="0s"></animateTransform></circle></svg>
            <p class="msg-erro-dados-bd" id="1">A iniciar sessão...</p>
        </div>
        <!--CAIXA DE TEXTO-->
        <div class="container-caixa">
            <div class="animated fadeInUp caixa-dados-bd caixa-login">
                <div class="logo"></div>
                <h3 class="titulo titulo-login">Login</h3>
                <div class="container-form">
                    <form class="form-bd" action="" method="post">
                        <!--Nome da BD-->
                        <label class="label-login">Nome de utilizador</label>
                        <input class="textbox textbox-login"type="text" name="utilizador" required="true">
                        <!--Password-->
                        <label class="label-login">Password</label><br>
                        <input class="textbox textbox-login" type="password" name="password" required="true">
                        <input class="btn-seguinte" type="submit" name="submit" value="Seguinte" id="botao">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>