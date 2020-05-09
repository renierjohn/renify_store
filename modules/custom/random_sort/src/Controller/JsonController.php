<?php
//
namespace Drupal\random_sort\Controller;
//
use Drupal\Core\DrupalKernel;
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
use Symfony\Component\Serializer\Serializer;
use Drupal\Core\Access\CsrfTokenGenerator;
/**
 * Class MyWebService.
 */
class JsonController extends ControllerBase {

  const VERIFY_TOKEN = "pahimu_ko_renier" ;
  const ACCESS_TOKEN = "EAADJLbNQ3vwBAHvbLAHqxt9mx5wXz7ZAPL15Y7jHPYUw40kuN3qFfxjrz7n69lSvWLQHLkvqvrzkabGMc9MBLAyJXKriftdcWaUcfNVx3EcR2NJaKOn3UnzgGyaBYK7YRPMynzlL2CD2NijCYwJUIXAhXdNUXIsRI0cm0FyB4TZBWzWyZCuWKVIVrmvZBCUZD";



    // $reply_message  = [
    //     "messaging_type"=>"UPDATE",
    //     "recipient"=>{
    //       "id": "3769505946454041"
    //     },
    //     "message": {
    //       "text": "hello, renier ,Thanks for visit mywebsite!"
    //     }
    //   ];

  public function webhook(){
      $request = \Drupal::request();
      $challenge = $request->get('hub_challenge');
      $fb_token = $request->get('hub_verify_token');

      $data['query'] = $request->query->all();
      $data['header'] = $request->headers->all();
      $data['request'] = $request->request->all();


      $data['input'] = file_get_contents("php://input");
      // $text = json_decode($data,true);
      // $text[]
      // $data = $request->getContent();
      // file_put_contents("sites/default/files/data.txt",$data);
      file_put_contents("sites/default/files/data/".Date("H-i-s").".txt",json_encode($data));

      if($fb_token == JsonController::VERIFY_TOKEN){
        $response = new Response($challenge);
        $response->setStatusCode(200);
        // $response->sendBody($challenge);
        return $response;
      }

      $response = new Response();
      $response->setStatusCode(200);
      return $response;
  }

  public function send_message(){

        $request = \Drupal::request();
        $message = $request->get('message');
        $text_message = [
      			'messaging_type'=>'UPDATE',
      			'recipient' => '3769505946454041',
      			'message' => ['text'=>$message],
				];
        $url = "https://graph.facebook.com/v7.0/me/messages?access_token=".JsonController::ACCESS_TOKEN;
        $client = \Drupal::httpClient();
        $request = $client->request('POST',$url,$text_message);
        $status = $request->getStatusCode();
        // $data = file_get_contents("php://input");
        // $data['query'] = $request->query->all();
        // $data['header'] = $request->headers->all();
        // $data['request'] = $request->request->all();

        file_put_contents("sites/default/files/data/".Date("H-i-s").".txt",$status);
        return $status;
  }

  /**
   * Edit route title callback.
   *
   * @return string
   *   The title of the contact form.
   */
  public function send_message_curl(){

    $request = \Drupal::request();
    $message = $request->get('message');
    $data = array(
      'messaging_type'=> "UPDATE",
      'recipient' => '3769505946454041',
      'message' => ['text'=>$message],
    );

    $payload = json_encode($data);
    $url = "https://graph.facebook.com/v7.0/me/messages?access_token=".JsonController::ACCESS_TOKEN;


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

      // Set HTTP Header for POST request
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload))
      );

      $result = curl_exec($ch);
      curl_close($ch);
      return $result;
  }




  /**
   * Logs in a user.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   A response which contains the ID and CSRF token.
   */
  public function login_fb() {
    // return new Response('',200,new Cookie('SESSc8a29b3530221fefd97ca0f2616a2096', 'ZUVMqiSmHj2LKqNqBxXlIMiVRMxFZLazPZ9lkH_ckKE'));

    $request = \Drupal::request();
    $output['id'] = $request->get('id');
    $output['uname'] = urldecode($request->get('uname'));
    $output['profile_picture'] = $request->get('profile_picture');
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
    if($id){
      $response = new Response();
      $response->setStatusCode(309);
      $response->sendHeaders();
    }
    //     // $session = new \Symfony\Component\HttpFoundation\Session\Session();
    //     // $session->set('uid',94);
    //     // $session->start();
    //     // SESSc8a29b3530221fefd97ca0f2616a2096 ZUVMqiSmHj2LKqNqBxXlIMiVRMxFZLazPZ9lkH_ckKE
    //     return $response;
    //     // $response->headers->setCookie(new Cookie('SESSc8a29b3530221fefd97ca0f2616a2096', 'ZUVMqiSmHj2LKqNqBxXlIMiVRMxFZLazPZ9lkH_ckKE'));
    //     // $response->send();
    //     // return new JsonResponse('ok');

    else{
      $user = $this->createUser($output['id'],$output['uname'],$output['email'],$output['profile_picture']);
      // $this->userLoginFinalize($user);

      // $autoloader = require_once 'autoload.php';
      // $kernel = new DrupalKernel('prod', $autoloader);


      // $query->condition('field_fb_id', $output['id']);
      // $uid = $query->execute();
      $uid = \Drupal::service('user.auth')->authenticate($output['uname'], '1234');
      $user = \Drupal\user\Entity\User::load($uid);
      user_login_finalize($user);
      $response->send();
      return $response;
      // $format = $this->getRequestFormat($request);
      // $content = $request->getContent();
      //
      // $response_data = [];
      // $response_data['current_user']['uid'] = $id;
      // $response_data['current_user']['roles'] = 'guest';
      // $response_data['current_user']['name'] = $output['uname'];
      // $response_data['csrf_token'] = $this->csrfToken->get('rest');
      // $encoded_response_data = $this->serializer->encode($response_data, 'json');
      // return new Response($encoded_response_data);

      // return $response;
      }

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
  $user->set('field_fb_profile_picture',$profile_picture);
  $user->addRole('guest');
  $user->activate();
  $res = $user->save();
  // $this->loggerFactory->warning($res);
  return $res;
 }
}
