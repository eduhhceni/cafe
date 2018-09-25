<?php

class RegistroModel {

  private $conexao;
  private $id;
  private $funcionario;
  private $cafe;
  private $data_pedido;

  function getId(){
    return $this->id;
  }

  function setId($id) {
    $this->id = $id;
  }

  function getFuncionario(){
    return $this->funcionario;
  }

  function setFuncionario($funcionario) {
    $this->funcionario = $funcionario;
  }

  function getCafe(){
    return $this->cafe;
  }

  function setCafe($cafe) {
    $this->cafe = $cafe;
  }

  function getData(){
    return $this->data_pedido;
  }

  function setData($data_pedido) {
    $this->data_pedido = $data_pedido;
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

  public function gravar() {
    try {
      $sqlInsert = "INSERT INTO registro(funcionario, cafe, data_pedido) VALUES(:funcionario, :cafe, :data_pedido)";

      $query = $this->conexao->prepare($sqlInsert);

      $query->bindValue(":funcionario", $this->funcionario);
      $query->bindValue(":cafe", $this->cafe);
      $query->bindValue(":data_pedido", $this->data_pedido);

      $query->execute();
    } catch (PDOException $e) {
      echo "Houve um erro ao gravar o registro";
      echo "<br />";
      echo $e->getMessage();
      return false;
    }
  }

  public function consultar(){
    try {
      $sql = "SELECT * FROM registro ORDER BY data_pedido";
      $query = $this->conexao->prepare($sql);
      $query->execute();

      $arrayDados = $query->fetchAll(PDO::FETCH_ASSOC);

      return $arrayDados;
    } catch (PDOException $e) {
      echo "Erro ao consultar os pedidos";
      echo "<br />";
      echo $e->getMessage();
      return false;
    }
  }
}
