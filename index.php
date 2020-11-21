<?php
use Functions\renify\Render;
use Functions\renify\Controller;
use Functions\renify\SEO;
use League\Plates\Engine;
use Klein\Klein;

include './functions/Controller.php';
include './vendor/autoload.php';

$app      = new Klein();
$render   = new Engine('./templates');
$template = $render->render('layout');

// echo 'renier';//
$app->respond('GET','/', function ($request, $response, $service) {
    $render    = new Render(__DIR__);
    $template = $render->render();
    return $template;
});

$app->respond('GET','/style', function ($request, $response, $service) {
  $render    = new Render(__DIR__);
  $template = $render->render('styles');
  return $template;
});


$app->with('/places', function () use ($app) {
    $app->respond('GET', '/?', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('places');
      return $template;
    });

    $app->respond('GET', '/[:id]', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('places',$request->id);
      return $template;
    });

});


$app->respond('GET','/debug', function ($request, $response, $service) {
  // $controller = new Controller(__DIR__);
  // $data = $controller->getContentsPagination('users',1,0);


  $render    = new Render(__DIR__);
  $data = $render->getPagesMetaData();
  $response->dump($data);
  // return ;
});

$app->dispatch();
