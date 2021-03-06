<?php
use Functions\renify\Render;
use Functions\renify\Controller;
use Functions\renify\SEO;
use Functions\renify\FirebaseRule;

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


$app->with('/products', function () use ($app) {
    $app->respond('GET', '/?', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('products');
      return $template;
    });

    $app->respond('GET', '/[:id]', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('places',$request->id);
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

$app->with('/places', function () use ($app) {
    $app->respond('GET', '/?', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('places');
      return $template;
    });

    $app->respond('GET', '/[:id]', function ($request, $response,$service) {
      $render    = new Render(__DIR__);
      $template = $render->render('products',$request->id);
      return $template;
    });

});

$app->respond('GET','/404', function ($request, $response, $service) {
  $render    = new Render(__DIR__);
  $template = $render->render('users');
  return $template;
});

$app->respond('GET','/debug', function ($request, $response, $service) {
  $firebase = new FirebaseRule(__DIR__);
  $firebase->setDatabase();

  $data = [];
  // $controller = new Controller(__DIR__);
  // $data = $controller->getContentsPaginationExternal('http://dauin.dd:8080/api/article?items_per_page=All');
  // $render    = new Render(__DIR__);
  // $data = $controller->getContentsPagination('footer');
  // $data = $render->getBlockTemplate(['pageId'=>'places']);
  // $data = $render->getBlockTemplate(['pageId'=>'products','pager'=>'1','limit'=>'0']);
  // $data = $controller->getFullPathContents('blocks','base');
  // $data = array_diff(scandir($data,1), array('..', '.'));
  $response->dump($data);
});

$app->dispatch();
