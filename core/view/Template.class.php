<?php

class Template {

  public function iniciar() {
  $template = file_get_contents("view/html/template.html");

  if (class_exists(App::$modulo)) {
    $modulo_class = App::$modulo;
    $modulo_obj = new $modulo_class;

    if (method_exists($modulo_obj, App::$acao)) {
      $modulo_acao = App::$acao;
      $conteudo = $modulo_obj->$modulo_acao();
    } else {
      $conteudo = "Ação [" . App::$acao . "] não encontrada";
    }
  } else {
    $conteudo = "Módulo [" . App::$modulo . "] não encontrado";
  }

  $html = str_replace("#CONTEUDO#", $conteudo, $template);

  return $html;
}
}
?>
