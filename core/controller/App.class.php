<?php

class App {

  public static $modulo;
  public static $acao;
  public static $chave;
  public static $chave2;

  public function iniciar() {
    self::$modulo = (!empty($_GET["modulo"])) ? $_GET["modulo"] : "Cafe";
    self::$acao = (!empty($_GET["acao"])) ? $_GET["acao"] : "listar";
    self::$chave = (!empty($_GET["chave"])) ? $_GET["chave"] : "";
    self::$chave2 = (!empty($_GET["chave2"])) ? $_GET["chave2"] : "";

    $template = new Template();
    $html = $template->iniciar();
    return $html;
  }
}
 ?>
