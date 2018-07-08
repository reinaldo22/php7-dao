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
//$usuarios = new Usuario();
//$usuarios->login("joaozao","qwt");

//Crinado um novo usuario
//$aluno = new Usuario();
//$aluno -> setDeslogin("Neymar");
//$aluno ->setDessenha("cai cai");
//$aluno ->insert();
//echo $aluno;

//alterar usuario 
//$usuario = new Usuario();
//$usuario->carregaPeloId(6);
//$usuario->update("Mario","Atras do armarios");

$usuario = new Usuario();
$usuario->carregaPeloId(1);
$usuario->delete(); 
echo $usuario;

 ?>