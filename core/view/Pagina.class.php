<?php

class Pagina {

  public function home() {
    return
    file_get_contents("view/html/home.html");
  }
}
