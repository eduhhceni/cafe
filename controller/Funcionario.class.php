<?php

class Funcionario {

  public function novo() {
    return $this->form();
  }

  public function editar() {
    return $this->form();
  }

  public function form() {
    $funcionarioModel = new FuncionarioModel();

    $htmlForm = file_get_contents("view/html/funcionario-form.html");

    if (isset($_GET["chave"])) {
      $funcionarioModel->selecionar($_GET["chave"]);
    }

    $htmlForm = str_replace("#NOME#", $funcionarioModel->getNome(), $htmlForm);
    if($funcionarioModel->getPermissao() == 1){
      $htmlForm = str_replace("#PERMISSAO#", "selected", $htmlForm);
    }
    $htmlForm = str_replace("#CARGO#", $funcionarioModel->getCargo(), $htmlForm);
    $htmlForm = str_replace("#ID#", $funcionarioModel->getId(), $htmlForm);

    return $htmlForm;
  }

  public function listar() {
    $htmlFuncionarios = file_get_contents("view/html/funcionarios.html");

    $funcionarioModel = new FuncionarioModel();
    $arrayDados = $funcionarioModel->consultar();
    $registros = "";
    if (is_array($arrayDados)) {
      $id = null;
      foreach ($arrayDados as $reg) {
        $id = $reg["id"];
        $registros .= "<tr>";
        $registros .= "<td>" . $reg["nome"] . "</td>";
        $registros .= "<td>" . $reg["cargo"] . "</td>";

        $registros .= "</td>";
        $registros .= '<td style="text-align:center"><a href="index.php?modulo=Funcionario&acao=excluir&chave=' . $id . '" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>'
        . ' <a href="index.php?modulo=Funcionario&acao=editar&chave=' . $id . '/" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>';
        $registros .= "</tr>";
      }
    }


    $html = str_replace("#REGISTROS#", $registros, $htmlFuncionarios);
    return $html;
  }

  public function salvar() {
    if (isset($_POST["nome"])) {
      $funcionarioModel = new FuncionarioModel();
      $funcionarioModel->setId($_POST["id"]);
      $funcionarioModel->setNome($_POST["nome"]);
      $funcionarioModel->setCargo($_POST["cargo"]);
      $funcionarioModel->setPermissao($_POST["permissao"]);
      $funcionarioModel->gravar();
      return $this->listar();
    }
  }

  public function excluir() {
    if (isset($_GET["chave"])) {
      $funcionarioModel = new FuncionarioModel();
      $funcionarioModel->deletar($_GET["chave"]);
      return $this->listar();
    }
  }

}
