<?php
namespace Functions\renify;
use Functions\renify\Controller;
use Functions\renify\SEO;
use League\Plates\Engine;

include __DIR__.'/../vendor/autoload.php';


class Render extends Controller
{

  private $file;
  private $config;
  private $engine;
  private $dir;


  public  function __construct($dir){
    $this->engine = new Engine('./templates');
    $this->config = $this->getJsonFromFile($dir.'/'.'config.json');
    $this->file   = $dir;
    $this->setConfig($this->config,$dir);
  }

  /*
  *
  * @params $pageId : specify the pageId based from config json file
  * @params $pager : specify page details with only 1 content, if NULL return all contents
  * @return renderd content
  *
  */
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

     $header   = $this->getHeaderData($array);
     $footer   = $this->getFooterData($array);

     // array of block pageId with array contents
     $blocks   = $this->getBlockTemplate($array);

     $this->engine->addData(['layoutTemplate' => 'main'],'layout');
     $this->engine->addData(['meta'     => $meta],'meta');
     $this->engine->addData(['header'   => $header],'header');
     $this->engine->addData(['blocks'   => $blocks],'main');
     $this->engine->addData(['footer'   => $footer],'footer');
     $this->engine->addData(['footer'   => $footer],'jsSuffix');
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

  /*
  *
  * @return blockid
  * @return coontent
  */
  public function getBlockTemplate($array){
    $blocks = [];
    // $content = $this->getContentsPagination($array['pageId'],$array['pager'],$array['limit']);
    $blockId = $this->config['pages'][$array['pageId']]['blockId'];
    foreach ($blockId as $key => $value) {
      if($value == 'node'){
        /*
        * retrieve contents products,users,blogs,places
        */
        $content = $this->getContentsPagination($array['pageId'],$array['pager'],$array['limit']);
      }
      else{
        /*
        * retrieve for non contents
        */
        $content = $this->getContentsPagination($value);
      }
      array_push($blocks,['blockid'=>$value,'content'=>$content]);
    }
    return $blocks;
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

  // public function getPagesMetaData(){
  //   return $this->getContentsPagination('places',3,1)[0]['title'];
  // }

}
