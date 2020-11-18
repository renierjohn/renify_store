<?php
use Functions\renify\Render;
use Functions\renify\Controller;
use League\Plates\Engine;
use Klein\Klein;

include './vendor/autoload.php';

$app      = new Klein();
$render   = new Engine('./templates');
$template = $render->render('layout');

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
        return 'All Users';
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


$app->respond('GET','/debug/[:name]', function ($request, $response, $service) {
  return $response->dump($request->name);
});

$app->dispatch();
