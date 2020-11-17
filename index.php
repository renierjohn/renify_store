<?php
use Functions\renify\Render;
use Functions\renify\Controller;

// include './functions/Render.php';
// include './functions/Controller.php';
include './vendor/autoload.php';
$templates = new League\Plates\Engine('./templates');
echo $templates->render('layout', ['name' => 'Jonathan']);

$controller = new Controller();
$render = new Render();
