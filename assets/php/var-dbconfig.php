<?php

$bd = "'".($_POST['nome-bd'])."'";
$user = "'".($_POST['nome-user'])."'";
$password = "'".($_POST['password'])."'";
$servidor = "'".($_POST['servidor'])."'";

/*Conteudo a escrever no ficheiro dbconfig.php*/
$info = 
"<?php\n
$"."bd = $bd;
$"."user = $user;
$"."password = $password;
$"."servidor = $servidor;\n
require_once('db-connect-test.php');\n
$"."dbconfig = mysqli_connect($servidor, $user, $password, $bd);\n
?>";

/*Cria o ficheiro dbconfig.php e escreve a info*/
$ficheiro = fopen("../assets/php/dbconfig.php", "w+");

fwrite($ficheiro, $info);
fclose($ficheiro);

header('Location: ../../instalacao/ver-dados-bd.php');
?>
