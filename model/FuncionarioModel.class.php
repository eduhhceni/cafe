<?php

class FuncionarioModel {

  private $conexao;
  private $id;
  private $nome;
  private $cargo;
  private $permissao;

  function getId(){
    return $this->id;
  }

  function setId($id) {
    $this->id = $id;
  }

  function getNome(){
    return $this->nome;
  }

  function setNome($nome) {
    $this->nome = $nome;
  }

  function getCargo(){
    return $this->cargo;
  }

  function setCargo($cargo) {
    $this->cargo = $cargo;
  }

  function getPermissao(){
    return $this->permissao;
  }

  function setPermissao($permissao) {
    $this->permissao = $permissao;
  }

  function __construct() {
    try {
      $this->conexao = new PDO("mysql:host=localhost; port=3306; dbname=cafe", "root", "");
      $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Erro ao conectar com o Banco de Dados";
      echo "<br />";
      echo $e->getMessage();
    }
  }

  public function consultar(){
    try {
      $sql = "SELECT * FROM funcionario ORDER BY nome";
      $query = $this->conexao->prepare($sql);
      $query->execute();

      $arrayDados = $query->fetchAll(PDO::FETCH_ASSOC);

      return $arrayDados;
    } catch (PDOException $e) {
      echo "Erro ao consultar os funcionários";
      echo "<br />";
      echo $e->getMessage();
      return false;
    }
  }


  public function gravar() {
    try {
      $sqlInsert = "INSERT INTO funcionario(nome, cargo, permissao) VALUES(:nome, :cargo, :permissao)";

      $sqlUpdate = "UPDATE funcionario SET nome = :nome, cargo = :cargo, permissao = :permissao WHERE id = :id";

      if ($this->id > 0) {
        $query =
        $this->conexao->prepare($sqlUpdate);
        $query->bindValue(":id", $this->id);
      } else{
        $query =
        $this->conexao->prepare($sqlInsert);
      }

      $query->bindValue(":nome", $this->nome);
      $query->bindValue(":cargo", $this->cargo);
      $query->bindValue(":permissao", $this->permissao);

      $query->execute();
    } catch (PDOException $e) {
      echo "Houve um erro ao gravar o registro";
      echo "<br />";
      echo $e->getMessage();
      return false;
    }
  }


  public function deletar($id) {
    try {
      $sql = "DELETE FROM funcionario WHERE id = :id";
      $query = $this->conexao->prepare($sql);
      $query->bindValue(":id", $id);
      $query->execute();
      return true;
    } catch(PDOException $e) {
      echo "Erro ao excluir o registro";
      echo "<br />";
      echo $e->getMessage();
      return false;
    }
  }

  public function selecionar($id) {
    try {
      $sql = "SELECT * FROM funcionario WHERE id = :id";
      $query = $this->conexao->prepare($sql);
      $query->bindValue(":id", $id);
      $query->execute();

      $arrayDados =
      $query->fetch(PDO::FETCH_ASSOC);
      $this->id = $arrayDados["id"];
      $this->nome = $arrayDados["nome"];
      $this->cargo = $arrayDados["cargo"];
      $this->permissao = $arrayDados["permissao"];

      return true;
    } catch(PDOException $e) {
      echo "Erro ao consultar os funcionários";
      echo "<br />";
      echo $e->getMessage();
      return false;
    }
  }
}
