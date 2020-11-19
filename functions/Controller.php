<?php
namespace Functions\renify;

class Controller
{
  private $file;
  public  function __construct($dir,$filename){
    // get relative path
    $this->file = $dir.'\files\json\\'.$filename;
  }

  public function getJson(){
    return $this->file;
  }

  public function getPlaces(){

    return true; 
  }

}
