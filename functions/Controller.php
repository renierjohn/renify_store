<?php
namespace Functions\renify;

class Controller
{

  private $file;
  private $config;
  private $json;
  private $dir;


  public  function __construct($dir){
    $this->config   = $this->getJsonFromFile($dir.'\\'.'config.json');
    $this->file   = $dir;
  }

  public function getJson(){
    return [$this->file];
  }

  public function getPlaces(){
    return $this->getFullPathContents('places');
    return $this->getJsonFromFile($this->getFullPathContents('places'));
  }

  public function getAssets(){
    $directoryJs = $this->getFullPathAssets('js');
    $directoryCss = $this->getFullPathAssets('css');
    return [array_diff(scandir($directoryJs,1), array('..', '.')),array_diff(scandir($directoryCss,1), array('..', '.'))];
  }


  public function getContents($filename = NULL){
    $directory =  $this->getFullPathContents('base');
    $files = array_diff(scandir($directory,1), array('..', '.'));
    $array = [];
    if(!empty($filename)){
      foreach ($files as $key => $value) {
        if(!is_dir($value) && $value == $filename.'.json'){
          $json = $this->getJsonFromFile($directory.$value);
          return $json;
        }
      }
    }
    // fallback value if no parameter given
    foreach ($files as $key => $value) {
      if(!is_dir($value) ){
        $json = $this->getJsonFromFile($directory.$value);
        array_push($array,$json);
      }
    }
    return $array;
  }

  public function getContentsPagination($filename = NULL,$page = 0,$limit = 0){
    $directory =  $this->getFullPathContents('base');
    $files = array_diff(scandir($directory,1), array('..', '.'));
    $array = [];
    if(!empty($filename)){
      foreach ($files as $key => $value) {
        if(!is_dir($value) && $value == $filename.'.json'){
          $json = $this->getJsonFromFile($directory.$value);
          if($limit < count($json)){
            
          }
          return $json;
        }
      }
    }
    // fallback value if no parameter given
    foreach ($files as $key => $value) {
      if(!is_dir($value) ){
        $json = $this->getJsonFromFile($directory.$value);
        array_push($array,$json);
      }
    }
    return $array;
  }

  private function getFullPathContents($filename){
    $filename = strtolower($filename);
    return $this->file.'\\'.$this->config['path']['files']['contents'][$filename];
  }

  private function getFullPathAssets($filename){
    $filename = strtolower($filename);
    if($filename == 'css' || $filename == 'js'){
      return $this->file.'\\'.$this->config['path']['asssets'][$filename];
    }
    return $this->file.'\\'.$this->config['path']['asssets']['css'];
  }


  private function getJsonFromFile($path){
    $contents = file_get_contents($path);
    return json_decode($contents,TRUE);
  }

  private function save(){
      file_put_contents($this->config['path']['files']['contents']['places'], $contents);
  }

}
