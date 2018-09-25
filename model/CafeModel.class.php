<?php

class CafeModel {

  private $conexao;
  private $id;
  private $tipo;
  private $permissao;

  function getId(){
    return $this->id;
  }

  function setId($id) {
    $this->id = $id;
  }

  function getTipo(){
    return $this->tipo;
  }

  function setTipo($tipo) {
    $this->tipo = $tipo;
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
      $sql = "SELECT * FROM cafe";
      $query = $this->conexao->prepare($sql);
      $query->execute();

      $arrayDados = $query->fetchAll(PDO::FETCH_ASSOC);

      return $arrayDados;
    } catch (PDOException $e) {
      echo "Erro ao consultar os cafés";
      echo "<br />";
      echo $e->getMessage();
      return false;
    }
  }

  public function selecionar($id) {
    try {
      $sql = "SELECT * FROM cafe WHERE id = :id";
      $query = $this->conexao->prepare($sql);
      $query->bindValue(":id", $id);
      $query->execute();

      $arrayDados = $query->fetch(PDO::FETCH_ASSOC);
      $this->id = $arrayDados["id"];
      $this->tipo = $arrayDados["tipo"];
      $this->permissao = $arrayDados["permissao"];
      return true;
    } catch(PDOException $e) {
      echo "Erro ao consultar os cafés";
      echo "<br />";
      echo $e->getMessage();
      return false;
    }
  }
}
