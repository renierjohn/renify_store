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


/**
 * Class MyWebService.
 */
class JsonController extends ControllerBase {

  public function login_fb() {
    $request = \Drupal::request();
    $output['id'] = $request->get('id');
    $output['uname'] = urldecode($request->get('uname'));
    if($request->get('email')){
      $output['email'] = $request->get('email');
    }
    else{
      $output['email'] = 'no_email@gmail.com';
    }

    $query = \Drupal::entityQuery('user');
    $query->condition('field_fb_id', $output['id']);
    $id = $query->execute();
    if($id){
        return new JsonResponse('already login');
    }
    // $output['result'] = $output['a'] * $output['b'];
    // return "hello";
    $res = $this->createUser($output['id'],$output['uname'],$output['email']);
    return new JsonResponse($res);
  }

private function createUser($fb_id = "" ,$username = "",$email = ""){
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
  $user->addRole('guest');
  $user->activate();
  $res = $user->save();
  $this->loggerFactory->warning($res);
  return $res;
 }
}
