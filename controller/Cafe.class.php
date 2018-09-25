<?php

class Cafe {

  public function listar() {
    $htmlCafes = file_get_contents("view/html/cafes.html");

    $cafeModel = new CafeModel();
    $arrayDados = $cafeModel->consultar();
    $registros = "";
    if (is_array($arrayDados)) {
      $id = null;
      foreach ($arrayDados as $reg) {
        $id = $reg["id"];
        $registros .= "<tr>";
        $registros .= "<td>" . $reg["tipo"] . "</td>";
        if($reg["permissao"] == 1){
          $registros .= "<td>Premium</td>";
        }else{
          $registros .= "<td>Padrão</td>";
        }
        $registros .= "</td>";
        $registros .= '<td style="text-align:center"><a href="index.php?modulo=Cafe&acao=confirmar&chave=' . $id . '" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-ok"></span></a>';
        $registros .= "</tr>";
        $registros .= "</tr>";
      }
    }

    $html = str_replace("#REGISTROS#", $registros, $htmlCafes);
    return $html;
  }

  public function confirmar(){
    $confirmar = file_get_contents("view/html/confirmacao.html");
    $cafeModel = new CafeModel();
    if (isset($_GET["chave"])) {
      $idCafe = $_GET["chave"];
    }
    $cafeModel->selecionar($idCafe);
    $confirmar = str_replace("#CAFE#", $cafeModel->getTipo(), $confirmar);

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
        $registros .= '<td style="text-align:center"><a href="index.php?modulo=Cafe&acao=pedir&chave=' . $id . '/" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-ok"></span></a>';
        $registros .= "</tr>";
      }
    }
    $html = str_replace("#REGISTROS#", $registros, $confirmar);
    return $html;
  }

  public function pedir(){
    date_default_timezone_set('America/Sao_Paulo');
    $cafeModel = new CafeModel();
    $funcionarioModel = new FuncionarioModel();
    $funcionarioModel->selecionar($_GET["chave"]);
    $pedido = file_get_contents("view/html/pedido.html");
    if (isset($_GET["chave"])) {
      $id = $_GET["chave"];
    }
    $cafeModel->selecionar($id);

    $pedido = str_replace("#NOME#", $funcionarioModel->getNome(), $pedido);
    $pedido = str_replace("#CARGO#", $funcionarioModel->getCargo(), $pedido);
    $pedido = str_replace("#CAFE#", $cafeModel->getTipo(), $pedido);
    $pedido = str_replace("#HORA#", date('H:i') , $pedido);
    $pedido = str_replace("#DATA#", date('d/m') , $pedido);

    $html = str_replace("#REGISTROS#", null, $pedido);
    return $html;
  }
}
