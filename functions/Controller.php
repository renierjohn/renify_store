<?php
namespace Functions\renify;

class Controller
{

  private $file;
  private $config;
  private $json;
  private $dir;


  public  function __construct($dir){
    $this->config   = $this->getJsonFromFile($dir.'/'.'config.json');
    $this->file   = $dir;
  }

  /*
  *
  * @params pathlevel : ./ or ../
  * @params $filename : specify filename
  * @params $extension : specify extension filename
  * @return list of css , js or image filenames
  *
  */
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
      if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg' ){
        foreach ($assets[2] as $key => $value) {
          if($value['filename'] == $filename && $value['extension'] == $extension){
            return $assets[2][$key];
          }
        }
          return $assets[2];
      }
      return $assets;
  }

  /*
  *
  * @params $filename : specify json filename
  * @params $pageNumber : specify what pagination number
  * @params $limit : specify how many display
  * @return list of json contents listed from config.json
  *
  */
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
    // fallback value if no parameter given, return all json contents
    foreach ($files as $key => $value) {
      if(!empty(pathinfo($value)['extension']) && pathinfo($value)['extension'] == $extensions )  {
        $json = $this->getJsonFromFile($directory.$value);
        array_push($array,$json);
      }
    }
    return $array;
  }

  /*
  *
  * @params $filename : specify json filename
  * @params $pageNumber : specify what pagination number
  * @params $limit : specify how many display
  * @return list of csss or js filenames
  *
  */
  public function getContentsPaginationExternal($url,$pager = 1){
      $query = 'items_per_page=All&offset=0';
      return $this->getJsonFromFile($url);
  }

  /*
  *
  * @params pathlevel : ./ or ../
  * @return list of csss or js filenames
  *
  */
  public function getAssets($pathLevel = 1){
    $extensions = ['css','js','jpg','png','jpeg'];
    $assets_arr = [];
    $pathLevelIdentifier = './';
    for ($i=1; $i < $pathLevel; $i++) {
      $pathLevelIdentifier = '.'.$pathLevelIdentifier;
    }

    foreach ($extensions as $extensionKey => $extensionValue) {
      $directory = $this->getPathAssets($extensionValue,FALSE);
      //remove non file index
      $files = array_diff(scandir($directory,1), array('..', '.'));
      if(!empty($files)){
        $array = [];
        foreach ($files as $key => $value) {
          if(!empty(pathinfo($value)['extension']) && pathinfo($value)['extension'] == $extensionValue ) {
            $tmp = pathinfo($value);
            // insert properties on each file
            $tmp['relativepath'] = $pathLevelIdentifier.$this->getPathAssets($extensionValue);
            $tmp['path'] = $pathLevelIdentifier.$this->getPathAssets($extensionValue).$tmp['basename'];
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


  public function getPathAssets($filename = 'css',$isRelative = TRUE){
    $filename = strtolower($filename);
    $extensions = ['css','js','jpg','png','jpeg'];
    $imageExtensions = ['jpg','png','jpeg'];
    foreach ($extensions as $extensionsKey => $extensionsValue) {
        if($extensionsValue == $filename){
          foreach ($imageExtensions as $key => $value) {
            if($extensionsValue == $value){
              $filename = 'images';
            }
          }
          if($isRelative){
            return $this->config['path']['asssets'][$filename];
          }
          return $this->file.'\\'.$this->config['path']['asssets'][$filename];
      }
    }
  }

  public function getJsonFromFile($path){
    $contents = file_get_contents($path);
    return json_decode($contents,TRUE);
  }
  public function getBlockIdarray(){
    return $this->config['pages']['layout'];
  }

  private function save($filename,$contents){
      file_put_contents($this->config['path']['files']['contents'][$filename], json_encode($contents));
  }

  public function setConfig($config,$dir){
    $this->config = $config;
    $this->file = $dir;
  }

}
