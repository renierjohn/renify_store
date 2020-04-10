<?php

namespace Drupal\random_sort\Plugin\Tamper;

use Drupal\Core\Form\FormStateInterface;
use Drupal\tamper\Exception\TamperException;
use Drupal\tamper\TamperableItemInterface;
use Drupal\tamper\TamperBase;

/**
 * 
 *
 * @Tamper(
 *   id = "custom_tamper",
 *   label = @Translation("Custom Tamper for indicator"),
 *   description = @Translation("Customize by Rendroid"),
 *   category = "Text"
 * )
 */
class CustomTamper extends TamperBase {

  const SETTING_TEXT_FORMAT = 'format';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $config = parent::defaultConfiguration();
    $config[self::SETTING_TEXT_FORMAT] = 'NO FUNCTION';
    return $config;
  }

  /**
   * {@inheritdoc}    NO FUNCTION
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form[self::SETTING_TEXT_FORMAT] = [
      '#type' => 'textfield',
      '#title' => $this->t('Format'),
      '#default_value' => $this->getSetting(self::SETTING_TEXT_FORMAT),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
      '#description' => $this->t('See the <a href="@url">sprintf</a> documentation for more details.', ['@url' => 'http://www.php.net/manual/en/function.sprintf.php']),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->setConfiguration([
      self::SETTING_TEXT_FORMAT => $form_state->getValue(self::SETTING_TEXT_FORMAT),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function tamper($data, TamperableItemInterface $item = NULL) {
    $jsn = [];
    foreach ($data as $key => $value) {
      $jsn[$key] = $value;
    }

    return  $jsn['main'];
  }

}
