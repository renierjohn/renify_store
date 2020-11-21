<?php
namespace Functions\renify;

use Functions\renify\Controller;
include '../vendor/autoload.php';

class SEO extends Controller
{

  private $file;
  private $config;
  private $json;
  private $dir;


  public  function __construct($dir){
    $this->config   = $this->getJsonFromFile($dir.'\\'.'config.json');
    $this->file   = $dir;
  }

  public function getSiteName(){
    return $this->config['meta']['sitename'];
    return $this->config;
  }

}
