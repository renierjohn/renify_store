<?php
namespace Functions\renify;
use Functions\renify\Controller;
use Functions\renify\SEO;
use League\Plates\Engine;

include '../vendor/autoload.php';


class Render extends Controller
{

  private $file;
  private $config;
  private $engine;
  private $dir;


  public  function __construct($dir){
    $this->engine = new Engine('./templates');
    $this->config = $this->getJsonFromFile($dir.'\\'.'config.json');
    $this->file   = $dir;
    $this->setConfig($this->config,$dir);
  }

 public function render($pageId = NULL,$pager = NULL){
   $limit = 1;
   if(empty($pageId)){
     $pageId = 'layout';
     $title = $this->config['pages'][$pageId];
   }
   if(empty($pager)){
     $limit = 0;
     $pager = 1;
     $title = $this->config['pages'][$pageId];
   }else {
     $title = strip_tags($this->getContentsPagination($pageId,$pager,1)[0]['title']);
   }

   $meta = $this->getMetaData($title);
   $header = $this->getHeaderData();
   $contents = $this->getContentsPagination($pageId,$pager,$limit);
   $footer = $this->getFooterData();
   $footer['assetsJsSuffix'] = $meta['assetsJsSuffix'];

   $this->engine->addData(['meta' => $meta],'meta');
   $this->engine->addData(['header' => $header],'header');
   $this->engine->addData(['contents' => $contents],'main');
   $this->engine->addData(['footer' => $footer],'footer');
   return  $this->engine->render($pageId);
 }

  public function getMetaData($title){
    $pathLevel = 2;
    $jsPrefixArr = ['modernizr','pace'];
    $jsSuffixArr = ['jquery-3.2.1.min','plugins','main'];
    $assetsJsPrefix = [];
    $assetsJsSuffix = [];

    $data = $this->getContentsPagination('places');
    $assetsCss = $this->getAssetsWithName($pathLevel,'','css');
    foreach ($jsPrefixArr as $key => $value) {
       array_push($assetsJsPrefix,$this->getAssetsWithName($pathLevel,$value,'js'));
    }
    foreach ($jsSuffixArr as $key => $value) {
       array_push($assetsJsSuffix,$this->getAssetsWithName($pathLevel,$value,'js'));
    }

    $meta['assetsJsSuffix'] = $assetsJsSuffix;
    $meta['assetsCss'] = $assetsCss;
    $meta['assetsJsPrefix'] = $assetsJsPrefix;
    $meta['siteName'] = $this->getSeo();
    $meta['title'] = $title;

    return $meta;
  }

  public function getHeaderData(){
    $header['label'] = 'Order Now';
    return $header;
  }

  public function getFooterData(){
    $footer['content'] = 'footer';
    return $footer;
  }

  public function getSeo(){
    $seo      = new SEO($this->file);
    return $seo->getSiteName();
  }

  public function getPagesMetaData(){
    return $this->getContentsPagination('places',3,1)[0]['title'];
  }

}
