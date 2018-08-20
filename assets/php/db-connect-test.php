<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/animate.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    </head>
<body>

<?php

require_once('dbconfig.php');

$erro_servidor = "Houve um problema com a conexão ao servidor: $servidor. Volte atrás e verifique se os dados estão corretos.";
$erro_bd = "Não foi possível encontrar a base de dados, $bd, na base de dados. Volte atrás e verifique se introduziu o nome correto.";


$connect = mysqli_connect($servidor, $user, $password) or die("$erro_servidor");
mysqli_select_db($connect, $bd) or die("$erro_bd");

require_once('script-inserir-bd.php');
    
?>

</body>
</html>