<?php
use Functions\renify\Render;
use Functions\renify\Controller;
use Functions\renify\SEO;
use League\Plates\Engine;
use Klein\Klein;


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


$app->with('/products', function () use ($app) {
    $app->respond('GET', '/?', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('products');
      return $template;
    });

    $app->respond('GET', '/[:id]', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('products',$request->id);
      return $template;
    });

});

$app->with('/users', function () use ($app) {
    $app->respond('GET', '/?', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('users');
      return $template;
    });

    $app->respond('GET', '/[:id]', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('users',$request->id);
      return $template;
    });

});

$app->respond('GET','/404', function ($request, $response, $service) {
  $render    = new Render(__DIR__);
  $template = $render->render('users');
  return $template;
});

$app->respond('GET','/debug', function ($request, $response, $service) {
  // $controller = new Controller(__DIR__);
  // $data = $controller->getContentsPagination('products',1,2);
  // $data = $controller->getContentsPaginationExternal('http://dauin.dd:8080/api/article?items_per_page=All');
  $render    = new Render(__DIR__);
  $data = $render->getBlockTemplate(['pageId'=>'products','pager'=>'1','limit'=>'1']);
  // $data = $render->getContentsPagination('products','2','2');
  $response->dump($data);
});

$app->dispatch();
