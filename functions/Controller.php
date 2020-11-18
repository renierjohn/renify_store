<?php
namespace Functions\renify;

class Controller
{
  private $file;
  public  function __construct($dir){
    // get relative path
    $this->file = $dir.'\files\json\products.json';
  }

  public function getJson(){
    return $this->file;
  }
}
