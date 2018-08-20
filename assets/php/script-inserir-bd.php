<?php

//Ficheiro chamado após inserir os dados da ligação à bd através do ficheiro db-connect-test.php
include_once('dbconfig.php');

/* Criar tabelas */

$tabela_users = "CREATE TABLE IF NOT EXISTS users (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user VARCHAR(30),
password VARCHAR(65),
email VARCHAR(100),
tipo VARCHAR(20),
display_name VARCHAR(100),
ip VARCHAR(20),
reg_date TIMESTAMP);";

$tabela_posts = "CREATE TABLE IF NOT EXISTS posts (
id INT(50) AUTO_INCREMENT PRIMARY KEY,
autor VARCHAR(100),
data DATETIME,
conteudo LONGTEXT,
titulo TEXT,
data_modif DATETIME);";

$tabela_comments = "CREATE TABLE IF NOT EXISTS comments (
id INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
autor VARCHAR(100),
email_autor VARCHAR(100),
ip VARCHAR(100),
data DATETIME,
conteudo TEXT);";

$tabela_options = "CREATE TABLE IF NOT EXISTS options (
id INT(50) AUTO_INCREMENT PRIMARY KEY,
option_name VARCHAR(64),
option_value LONGTEXT);";

$tabela_uploads = "CREATE TABLE IF NOT EXISTS uploads (
id INT(50) AUTO_INCREMENT PRIMARY KEY,
url VARCHAR(100),
nome_ficheiro VARCHAR(100),
tamanho DOUBLE)";

mysqli_query($dbconfig, $tabela_users);
mysqli_query($dbconfig, $tabela_comments);
mysqli_query($dbconfig, $tabela_posts);
mysqli_query($dbconfig, $tabela_options);
mysqli_query($dbconfig, $tabela_uploads);


//QUERYS PARA INSERIR VALORES NA TABELA OPTIONS

//Obter nome da pasta onde está instalado a aplicação
include_once('../../index.php');
$pasta;

//Obter URL
$url = $_SERVER['SERVER_NAME'];
$inserir_URL = "INSERT INTO options (option_name, option_value) VALUES ('url', '$url/$pasta')";
mysqli_query($dbconfig, $inserir_URL);

//Inserir template default 
$inserir_template = "INSERT INTO options (option_name, option_value) VALUES ('pagina_inicial', '/$pasta/paginas/default.php')";
mysqli_query($dbconfig, $inserir_template);

//Inserir titulo da pagina default
$titulo = "INSERT INTO options (option_name, option_value) VALUE ('titulo', 'LekkerBuilder')";
mysqli_query($dbconfig, $titulo);

//Inserir titulo cabeçalho
$titulo = "INSERT INTO options (option_name, option_value) VALUE ('titulo_cabecalho', 'LekkerBuilder')";
mysqli_query($dbconfig, $titulo);

//Inserir links menus
$link_menu1 = "INSERT INTO options (option_name, option_value) VALUE ('link_menu_1', '#')";
mysqli_query($dbconfig, $link_menu1);

$link_menu2 = "INSERT INTO options (option_name, option_value) VALUE ('link_menu_2', '#')";
mysqli_query($dbconfig, $link_menu2);

$link_menu3 = "INSERT INTO options (option_name, option_value) VALUE ('link_menu_3', '#')";
mysqli_query($dbconfig, $link_menu3);

$link_menu4 = "INSERT INTO options (option_name, option_value) VALUE ('link_menu_4', '#')";
mysqli_query($dbconfig, $link_menu4);

//Inserir nomes menus
$nome_menu1 = "INSERT INTO options (option_name, option_value) VALUE ('nome_menu_1', 'nome1')";
mysqli_query($dbconfig, $nome_menu1);

$nome_menu2 = "INSERT INTO options (option_name, option_value) VALUE ('nome_menu_2', 'nome2')";
mysqli_query($dbconfig, $nome_menu2);

$nome_menu3 = "INSERT INTO options (option_name, option_value) VALUE ('nome_menu_3', 'nome3')";
mysqli_query($dbconfig, $nome_menu3);

$nome_menu4 = "INSERT INTO options (option_name, option_value) VALUE ('nome_menu_4', 'nome4')";
mysqli_query($dbconfig, $nome_menu4);

header('Location: ../../instalacao/registo.php');
?>










