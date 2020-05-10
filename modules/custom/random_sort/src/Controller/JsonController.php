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
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Utility\Token;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\Component\Utility\Unicode;
use  Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
/**
 * Class MyWebService.
 */
class JsonController extends ControllerBase {

  const VERIFY_TOKEN = "pahimu_ko_renier" ;
  const ACCESS_TOKEN = "EAADJLbNQ3vwBAEMp7l2McKQdJEtSm7yFkhuoM5BEuplBtGTJUVMlyuxsGEqx76ZApHvmBExQtItjhV9wiYLucjzEEjGiRrbjfMBTNblUVL4Sg0bpxwOJgumqZBVfWMrkKmK7chE6FepSNef1IHulFUpuZA3NhebzLUzzzZB66bhrQ5hx47aD7HVUlOZCje6IZD";
  // EAADJLbNQ3vwBAEMp7l2McKQdJEtSm7yFkhuoM5BEuplBtGTJUVMlyuxsGEqx76ZApHvmBExQtItjhV9wiYLucjzEEjGiRrbjfMBTNblUVL4Sg0bpxwOJgumqZBVfWMrkKmK7chE6FepSNef1IHulFUpuZA3NhebzLUzzzZB66bhrQ5hx47aD7HVUlOZCje6IZD

  public function webhook(){
      $request = \Drupal::request();
      $challenge = $request->get('hub_challenge');
      $fb_token = $request->get('hub_verify_token');
      // $data['query'] = $request->query->all();
      // $data['header'] = $request->headers->all();
      // $data['request'] = $request->request->all();
      $data  = file_get_contents("php://input");
      file_put_contents("sites/default/files/data/".Date("H-i-s").".txt",$data);

      if($fb_token == JsonController::VERIFY_TOKEN){
        $response = new Response($challenge);
        $response->setStatusCode(200);
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
    $fb_id= $request->get('id');
    // 3769505946454041 renier
    $data = array(
      'messaging_type'=> "UPDATE",
      'recipient' => ['id'=>$fb_id],
      'message' => ['text'=>$message],
    );

    $payload = json_encode($data);
    $url = "https://graph.facebook.com/v7.0/me/messages?access_token=".JsonController::ACCESS_TOKEN;


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
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
    else{
      $this->createUser($output['id'],$output['uname'],$output['email'],$output['profile_picture']);
      $uid = \Drupal::service('user.auth')->authenticate($output['uname'], '1234');
      $user = \Drupal\user\Entity\User::load($uid);
      user_login_finalize($user);
      $response->send();
      return $response;
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
  return $res;
 }
}
