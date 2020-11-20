<?php
use Functions\renify\Render;
use Functions\renify\Controller;
use League\Plates\Engine;
use Klein\Klein;

include './functions/Controller.php';
include './vendor/autoload.php';

$app      = new Klein();
$render   = new Engine('./templates');
$template = $render->render('layout');

// echo 'renier';//
$app->respond('GET','/', function ($request, $response, $service) {
    $render   = new Engine('./templates');
    $render->addData(['title' => 'Renify'],'meta');
    $render->addData(['label' => 'Sign Up Now'],'header');
    $template = $render->render('layout');
    return $template;
});

$app->respond('GET','/style', function ($request, $response, $service) {
    $render   = new Engine('./templates');
    $template = $render->render('styles');
    return $template;
});



$app->with('/products', function () use ($app) {
    $app->respond('GET', '/?', function ($request, $response,$service) {
      $render   = new Engine('./templates');
      $render->addData(['title' => 'Renify'],'meta');
      $render->addData(['label' => 'Sign Up Now'],'header');
      $template = $render->render('products');
      return $template;

    });
    $app->respond('GET', '/[:id]', function ($request, $response,$service) {
        return 'User id : '.$request->id;
    });

});

$app->with('/blogs', function () use ($app) {
    $app->respond('GET', '/?', function ($request, $response,$service) {
        return 'All Blogs';
    });
    $app->respond('GET', '/[:id]', function ($request, $response,$service) {
        return 'Blog id : '.$request->id;
    });

});


$app->respond('GET','/debug', function ($request, $response, $service) {
  $controller = new Controller(__DIR__);
  // $path = $controller->getPlaces();
  $path = $controller->getContentsPagination('places',1,1);
  // $contents = file_get_contents($path);
  // $url = 'https://live-deped-dauin.pantheonsite.io/api/places';
  // $contents = file_get_contents($json);
  // $decoded = json_decode($contents,TRUE);
  // file_put_contents("./files/json/places.json", $contents);

  $response->dump($path);
  // return ;
});

$app->dispatch();
