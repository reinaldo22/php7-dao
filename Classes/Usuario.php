<?php 
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;


public function getIdusuario(){
	return $this->idusuario;
}
public function setIdusuario($value){
	$this->idusuario = $value;
}
public function getDeslogin(){
	return $this->deslogin;
}
public function setDeslogin($value){
	$this->deslogin = $value;
}
public function getDessenha(){
	return $this->dessenha;
}
public function setDessenha($value){
	$this->dessenha = $value;
}
public function getDtcadastro(){
	return $this->dtcadastro;
}
public function setDtcadastro($value){
	$this->dtcadastro = $value;
}
//Carrega um usuario pelo ID , apenas um por vez
public function carregaPeloId($id){
	$sql = new Sql();
	$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));
	if (count($result)>0) {
		$linha = $result[0];
		$this->setIdusuario($linha['idusuario']);
		$this->setDeslogin($linha['deslogin']);
		$this->setDessenha($linha['dessenha']);
		$this->setDtcadastro(new DateTime($linha['dtcadastro']));
		
	}

}
//pra carregar todos usuarios
public static  function getList(){
	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
}
//Carrega pelo login
public static function search($login){
	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
		':SEARCH'=>"%".$login."%"
		));
}
public function login($login,$senha){
	$sql = new Sql();
	$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA",array(
	":LOGIN"=>$login,
	":SENHA"=>$senha));

	if (count($results)>0) {
		$linha = $results[0];
		$this->setIdusuario($linha['idusuario']);
		$this->setDeslogin($linha['deslogin']);
		$this->setDessenha($linha['dessenha']);
		$this->setDtcadastro(new DateTime($linha['dtcadastro']));
}else{
	throw new Exception("Login ou senha inválidos");
	
}
}
public function __toString(){
		return json_encode(array("idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

}

 ?>