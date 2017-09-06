<?php

namespace Drupal\gtd_jobs\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * @Block(
 *   id = "gtd_jobs_block",
 *   admin_label = @Translation("GTD jobs block"),
 *   category = @Translation("GTD"),
 * )
 */
class MyBlock extends BlockBase {

  public function build() {
    $form = \Drupal::formBuilder()
      ->getForm('Drupal\gtd_jobs\Form\MyForm');
    return $form;
  }

}