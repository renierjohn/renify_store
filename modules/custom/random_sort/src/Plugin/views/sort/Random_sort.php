<?php

namespace Drupal\random_sort\Plugin\views\sort;

use Drupal\Core\Cache\CacheableDependencyInterface;
use Drupal\Core\Cache\UncacheableDependencyTrait;
use Drupal\Core\Form\FormStateInterface;

/**
 * Handle a random sort.
 *
 * @ViewsSort("random_sort_loading")
 */
class Random_sort extends SortPluginBase implements CacheableDependencyInterface {

  use UncacheableDependencyTrait;

  /**
   * {@inheritdoc}
   */
  public function usesGroupBy() {
    return FALSE;
  }

  public function query() {
    $this->query->addOrderBy('rand');
  }

  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
    $form['order']['#access'] = TRUE;
  }

}
