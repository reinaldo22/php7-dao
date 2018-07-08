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
	$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));
	if (count($results)>0) {
		$this->setData($results[0]);	
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
		$this->setData($results[0]);
		
}else{
	throw new Exception("Login ou senha inválidos");	
}

}

public function setData($data){
		
	$this->setIdusuario($data['idusuario']);
	$this->setDeslogin($data['deslogin']);
	$this->setDessenha($data['dessenha']);
	$this->setDtcadastro(new DateTime($data['dtcadastro']));
}

public function insert(){
	$sql  = new Sql();
	$results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:SENHA)",array(
		':LOGIN'=>$this->getDeslogin(),
		':SENHA'=>$this->getDessenha()
		));
	if (count($results)>0) {
		$this->setData($results[0]);
}

}

public function update($login,$senha){
	$this->setDeslogin($login);
	$this->setDessenha($senha);
	
	$sql = new Sql();
	
	$sql->query("UPDATE tb_usuarios SET deslogin=:LOGIN,dessenha=:SENHA WHERE idusuario=:ID",array(
		':LOGIN'=>$this->getDeslogin(),
		':SENHA'=>$this->getDessenha(),
		':ID'=>$this->getIdusuario()

		));
}

public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

}

 ?>