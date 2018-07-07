<?php 
require_once("config.php");

//Carrega apenas um ususario
//$root = new Usuario();
//$root->carregaPeloId(3);

//Carrega uma lista de ususarios
//$lista = Usuario::getList();

//Carrega uma lista de usuarios bunscando pelo login
//$search = Usuario::search("c");

//Carrega uma lista de usuarios bunscando pelo login
$usuarios = new Usuario();
$usuarios->login("joaozao","qwt");

echo $usuarios;
 ?>