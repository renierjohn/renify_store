<?php
use Functions\renify\Render;
use Functions\renify\Controller;
use League\Plates\Engine;
// include './functions/Render.php';
// include './functions/Controller.php';
include './vendor/autoload.php';

$templates = new Engine('./templates');
// $template = $templates->make('layout', ['name' => 'Jonathan']);
$template = $templates->make('layout');

// specify template
$templates->addData(['title' => 'Renify'],'meta');
$templates->addData(['label' => 'Sign Up Now'],'header');
echo $template;
//
// $controller = new Controller();
// $render = new Render();
