<?php

class Registro {

  public function listar() {
    $htmlRegistros = file_get_contents("view/html/registros.html");

    $registroModel = new RegistroModel();
    $arrayDados = $registroModel->consultar();
    $registros = "";
    if (is_array($arrayDados)) {
      $id = null;
      foreach ($arrayDados as $reg) {
        $id = $reg["id"];
        $registros .= "<tr>";
        $registros .= "<td>" . $reg["funcionario"] . "</td>";
        $registros .= "<td>" . $reg["cafe"] . "</td>";
        $registros .= "<td>" . date( "d/m/Y H:i", strtotime($reg["data_pedido"])) . "</td>";
        $registros .= "</tr>";
      }
    }

    $html = str_replace("#REGISTROS#", $registros, $htmlRegistros);
    return $html;
  }


    public function salvar() {
      date_default_timezone_set('America/Sao_Paulo');
        $funcionarioModel = new FuncionarioModel();
        $funcionarioModel->selecionar($_GET["chave"]);
        $cafeModel = new CafeModel();
        $cafeModel->selecionar($_GET["chave2"]);
        $registroModel = new RegistroModel();
        $registroModel->setFuncionario($funcionarioModel->getNome());
        $registroModel->setCafe($cafeModel->getTipo());
        $registroModel->setData(date('Y-m-d H:i:s'));
        $registroModel->gravar();

        return $this->listar();
    }
}
