<?php

class App {

  public static $modulo;
  public static $acao;
  public static $chave;

  public function iniciar() {
    self::$modulo = (!empty($_GET["modulo"])) ? $_GET["modulo"] : "Pagina";
    self::$acao = (!empty($_GET["acao"])) ? $_GET["acao"] : "home";
    self::$chave = (!empty($_GET["chave"])) ? $_GET["chave"] : "";

    $template = new Template();
    $html = $template->iniciar();
    return $html;
  }
}
 ?>
