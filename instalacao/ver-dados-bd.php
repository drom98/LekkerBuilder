<!DOCTYPE html>
<html>
    <head>
        <title>LekkerBuilder - Dados BD</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/png" href="../assets/images/favicon.png"/>
        <link rel="stylesheet" href="/assets/css/animate.css">
        <link rel="stylesheet" href="/assets/css/styles.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    </head>
    <body>
        <!--CAIXA DE TEXTO-->
        <div class="container-caixa">
            <div class="animated fadeInUp caixa-dados-bd">
                <div class="logo"></div>
                <div class="container-info">
                    <?php
                    require_once('../assets/php/dbconfig.php');
                    ?>
                    <div class="info">
                        <h3 class="h3-info">Rever informações de acesso à base de dados.</h3>
                        <?php
                        echo "<p class='p-info'>Nome da base de dados: $bd</p>";
                        echo "<p class='p-info'>Nome de utilizador: $user</p>";
                        echo "<p class='p-info' type='password'>Password: $password</p>";
                        echo "<p class='p-info' >Servidor: $servidor</p>";
                        ?>
                        <a class="btn-seguinte-info" href="../assets/php/script-criar-tabelas.php">Seguinte</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>