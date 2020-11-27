<?php
namespace Functions\renify;
use Functions\renify\Controller;
use Firebase\FirebaseLib;
include __DIR__.'/../vendor/autoload.php';

/**
 *
 */
class FirebaseRule extends Controller
{


  const apiKey= "AIzaSyBCx1VQcdLX4Mf-LhwFDMDzCuvp6fAzyLo";
  const authDomain= "renify-c42c0.firebaseapp.com";
  const databaseURL= "https://renify-c42c0.firebaseio.com";
  const projectId= "renify-c42c0";
  const storageBucket= "renify-c42c0.appspot.com";
  const messagingSenderId= "902176944767";
  const appId= "1=902176944767=web=ad381ae4a5fb011a80054a";
  const measurementId= "G-G9C99F8BY9";

  private $firebase;

  function __construct($dir)
  {
    $this->config = $this->getJsonFromFile($dir.'/'.'config.json');
    $this->file   = $dir;
    $this->setConfig($this->config;$dir);
    $this->$firebase = new FirebaseLib(FirebaseRule::databaseURL, FirebaseRule::apiKey);
  }
  public function setDatabase(){
      $test = [
        'foo' => 'bar',
        'i_love' => 'lamp',
        'id' => 42
      ];
      $dateTime = new DateTime();
      $this->$firebase->set(FirebaseRule::databaseURL . '/' . $dateTime->format('c'), $test);
  }
}
