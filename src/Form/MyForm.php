<?php

namespace Drupal\gtd_jobs\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class MyForm extends FormBase {
  
  public function getFormId() {
    return 'gtd_jobs_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
	$form['company_name'] = array(
    '#type' => 'textfield',
    '#title' =>'Поиск вакансий по слову:',
    '#required' => TRUE,
  );
	
  $form['actions'] = array(
    '#type' => 'actions',
    'submit' => array(
      '#type' => 'submit',
      '#value' =>'Submit',
    ),
  );
  return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $value = $form_state->getValue('company_name');
    $path = Url::fromRoute('gtd_jobs.content', array('text' => $value));
    $form_state->setRedirectUrl($path);
  }

}