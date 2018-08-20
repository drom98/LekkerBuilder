<?php 

$ficheiro_dbconfig = 'assets/php/dbconfig.php';
if(file_exists($ficheiro_dbconfig)) {
    include_once($ficheiro_dbconfig);
    $query = "SELECT option_value FROM options WHERE option_name='pagina_inicial'";
    $result = mysqli_query($dbconfig, $query) or die ($query);
    $row=mysqli_fetch_array($result);
    if (!$row == null) {
        header("Location: $row[0]");
    } 
}

$pasta = basename(__DIR__);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>LekkerBuilder</title>
        <link rel='shortcut icon' type='image/png' href='assets/images/favicon.png'>
        <link rel='stylesheet' href='assets/css/styles.css'>
        <link rel='stylesheet' href='assets/css/animate.css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
    </head>
    <body>
        <!--CAIXA DE TEXTO-->
        <div class="animated fadeInUp container-caixa">
            <div class="caixa">
                <div class="logo"></div>
                <p class="p-inicio">Bem vindo ao LekkerBuilder, a aplicação que lhe permite, de modo rápido e simples
a criação e gestão de websites, blogs, portfolios etc...
Antes de começar, são necessárias algumas informações acerca da base de dados.</p>
                <p class="link-site-inicio"><a href="http://www.lekkerbuilder.drom.pt" target="_blank">Website</a> | <a href="http://www.lekkerbuilder.drom.pt/documentation" target="_blank">Documentação</a></p>
                <a class="btn-seguinte inicio" href="instalacao/dados-bd.php">Seguinte</a>
            </div>
        </div>
    </body>
</html>