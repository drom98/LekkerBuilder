<?php 

include_once('../assets/php/dbconfig.php');

//Query do titulo
$titulo = "SELECT option_value FROM options WHERE option_name='titulo'";
$result = mysqli_query($dbconfig, $titulo) or die ($titulo);
$row=mysqli_fetch_array($result);
$titulo_row = $row[0];

//Obter nome da página
$pagina = basename($_SERVER['PHP_SELF'], '.php');

echo "
    <div class='titulo-pagina'>
        <h3 class='h-titulo-pagina animated fadeInUp'>$pagina</h3>
    </div>";

?>