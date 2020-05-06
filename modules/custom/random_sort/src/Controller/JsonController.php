<?php
//
namespace Drupal\random_sort\Controller;
//
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\user\Entity\User;
use Drupal\user\UserInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Utility\Token;
use Drupal\Core\Transliteration\PhpTransliteration;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\Component\Utility\Unicode;
use  Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
/**
 * Class MyWebService.
 */
class JsonController extends ControllerBase {

  public function login_fb() {
    // return new Response('',200,new Cookie('SESSc8a29b3530221fefd97ca0f2616a2096', 'ZUVMqiSmHj2LKqNqBxXlIMiVRMxFZLazPZ9lkH_ckKE'));

    $request = \Drupal::request();
    $output['id'] = $request->get('id');
    $output['uname'] = urldecode($request->get('uname'));
    $output['profile_picture'] = response->get('profile_picture');
    if($request->get('email')){
      $output['email'] = $request->get('email');
    }
    else{
      $output['email'] = 'no_email@gmail.com';
    }

    $query = \Drupal::entityQuery('user');
    $query->condition('field_fb_id', $output['id']);
    $id = $query->execute();
    // $this->loggerFactory->info('sample');
    // if($id){
    //     // $session = new \Symfony\Component\HttpFoundation\Session\Session();
    //     // $session->set('uid',94);
    //     // $session->start();
    //     // SESSc8a29b3530221fefd97ca0f2616a2096 ZUVMqiSmHj2LKqNqBxXlIMiVRMxFZLazPZ9lkH_ckKE
        $response = new Response();
        $response->setStatusCode(309);
        $response->sendHeaders();
    //     return $response;
    //     // $response->headers->setCookie(new Cookie('SESSc8a29b3530221fefd97ca0f2616a2096', 'ZUVMqiSmHj2LKqNqBxXlIMiVRMxFZLazPZ9lkH_ckKE'));
    //     // $response->send();
    //     // return new JsonResponse('ok');
    // }
    // else{
    //   $res = $this->createUser($output['id'],$output['uname'],$output['email']);
    //   return new JsonResponse($res);
    // }
    $this->createUser($output['id'],$output['uname'],$output['email'],$output['profile_picture']);
    return $response;
  }

private function createUser($fb_id = "" ,$username = "",$email = "",$profile_picture = ""){
  $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
  $user = \Drupal\user\Entity\User::create();
  $user->setPassword('1234');
  $user->enforceIsNew();
  $user->setEmail($email);
  $user->setUsername($username);
  $user->set("init", $email);
  $user->set("langcode", $language);
  $user->set("preferred_langcode", $language);
  $user->set('field_fb_id',$fb_id);
  $user->set('field_fb_profile_picture');
  $user->addRole('guest');
  $user->activate();
  $res = $user->save();
  $this->loggerFactory->warning($res);
  return $res;
 }
}
