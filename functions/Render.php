<?php
namespace Functions\renify;
use Functions\renify\Controller;
use Functions\renify\SEO;
use League\Plates\Engine;

include 'C:\xampp\htdocs\vendor\autoload.php';


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
     $title = $this->config['pages'][$pageId]['title'];
   }
   if(empty($pager)){
     $limit = 0;
     $pager = 1;
     $title = $this->config['pages'][$pageId]['title'];
   }else {
     $title = strip_tags($this->getContentsPagination($pageId,$pager,1)[0]['title']);
   }

   $meta = $this->getMetaData($title);

   $array['pageId'] = $pageId;
   $array['limit']  = $limit;
   $array['pager']  = $pager;
   $array['assetsJsSuffix'] = $meta['assetsJsSuffix'];

   $header = $this->getHeaderData($array);
   $contents = $this->getContentData($array);
   $footer = $this->getFooterData($array);

   // $this->engine->addData(['layoutTemplate' => $this->config['pages'][$pageId]['layout']],'layout');
   $this->engine->addData(['layoutTemplate' => 'main'],'layout');
   $this->engine->addData(['meta' => $meta],'meta');
   $this->engine->addData(['header' => $header],'header');
   $this->engine->addData(['contents' => $contents],'node');
   $this->engine->addData(['footer' => $footer],'footer');
   $this->engine->addData(['footer' => $footer],'jsSuffix');
   return  $this->engine->render('layout');
 }

  private function getMetaData($title){
    $pathLevel = 2;
    $jsPrefixArr = ['modernizr','pace.min'];
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

    $meta['assetsJsPrefix'] = $assetsJsPrefix;
    $meta['assetsJsSuffix'] = $assetsJsSuffix;
    $meta['assetsCss']      = $assetsCss;
    $meta['siteName']       = $this->getSeo();
    $meta['title']          = $title;

    return $meta;
  }

  private function getContentData($array){
      // switch ($array['pageId']) {
      //   case 'places':
      //
      //     break;
      //
      //   case 'users':
      //
      //     break;
      // }


      return $this->getContentsPagination($array['pageId'],$array['pager'],$array['limit']);
  }

  private function getHeaderData($array){
    $header['label'] = 'Order Now';
    return $header;
  }

  private function getFooterData($array){
    $footer['content'] = 'footer';
    $footer['assetsJsSuffix'] = $array['assetsJsSuffix'];
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
