<?php 
require_once("config.php");

$root = new Usuario();

$root->carregaPeloId(3);

echo $root;
 ?>