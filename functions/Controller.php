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


  public function getAssetsWithName($pathLevel = 1,$filename = NULL ,$extension = NULL){
      $assets = $this->getAssets($pathLevel);
      if($extension == 'css'){
          foreach ($assets[0] as $key => $value) {
            if($value['filename'] == $filename){
              return $assets[0][$key];
            }
          }
          return $assets[0];
      }
      if($extension == 'js'){
        foreach ($assets[1] as $key => $value) {
          if($value['filename'] == $filename){
            return $assets[1][$key];
          }
        }
          return $assets[1];
      }
      return $assets;
  }

  public function getContentsPagination($filename = NULL,$pageNumber = 1,$limit = 0){
    $extensions = 'json';
    $directory =  $this->getFullPathContents('base');
    $files = array_diff(scandir($directory,1), array('..', '.'));
    $array = [];
    if(!empty($filename)){
      foreach ($files as $key => $value) {
        if(!empty(pathinfo($value)['extension']) && pathinfo($value)['filename'] == $filename && pathinfo($value)['extension'] == $extensions )  {
          $json = $this->getJsonFromFile($directory.$value);
          if($limit == 0){
            $limit = count($json);
          }
          if($limit < count($json)){
            $maxPages = round(count($json)/$limit);
            if($pageNumber < $maxPages ){
              for ($i= intval($pageNumber) * intval($limit); $i < intval($pageNumber +1) * intval($limit); $i++) {
                  array_push($array,$json[$i]);
              }
              return $array;
            }
          }
          return $json; // fallback out of bounds retunrn all
        }
      }
    }
    // fallback value if no parameter given
    foreach ($files as $key => $value) {
      if(!empty(pathinfo($value)['extension']) && pathinfo($value)['extension'] == $extensions )  {
        $json = $this->getJsonFromFile($directory.$value);
        array_push($array,$json);
      }
    }
    return $array;
  }


  private function getAssets($pathLevel = 1){
    $extensions = ['css','js'];
    $assets_arr = [];
    $pathLevelIdentifier = './';
    for ($i=1; $i < $pathLevel; $i++) {
      $pathLevelIdentifier = '.'.$pathLevelIdentifier;
    }

    foreach ($extensions as $extensionKey => $extensionValue) {
      $directory = $this->getFullPathAssets($extensionValue);
      //remove non file index
      $files = array_diff(scandir($directory,1), array('..', '.'));
      if(!empty($files)){
        $array = [];
        foreach ($files as $key => $value) {
          if(!empty(pathinfo($value)['extension']) && pathinfo($value)['extension'] == $extensionValue ) {
            $tmp = pathinfo($value);
            // insert properties on each file
            $tmp['relativepath'] = $pathLevelIdentifier.$this->getRelativePathAssets($extensionValue);
            $tmp['path'] = $pathLevelIdentifier.$this->getRelativePathAssets($extensionValue).$tmp['basename'];
            array_push($array,$tmp);
          }
        }
      }
      array_push($assets_arr,$array);
    }
    return $assets_arr;
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

  private function getRelativePathAssets($filename){
    $filename = strtolower($filename);
    if($filename == 'css' || $filename == 'js'){
      return $this->config['path']['asssets'][$filename];
    }
    return $this->config['path']['asssets']['css'];
  }


  public function getJsonFromFile($path){
    $contents = file_get_contents($path);
    return json_decode($contents,TRUE);
  }

  private function save(){
      file_put_contents($this->config['path']['files']['contents']['places'], $contents);
  }

  public function setConfig($config,$dir){
    $this->config = $config;
    $this->file = $dir;
  }

}
