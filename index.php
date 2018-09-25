<?php

function autoloader($classe) {
	$dirs = Array("core/controller", "core/view", "controller", "model");
	foreach ($dirs as $dir) {
		$arquivo = $dir . "/" . $classe . ".class.php";
		if (file_exists($arquivo)) {
			require_once($arquivo);
		}
	}
}

spl_autoload_register('autoloader');

$app = new App();

$html = $app->iniciar();

echo $html;
