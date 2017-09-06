<?php

namespace Drupal\gtd_jobs\Controller;
use Drupal\Core\Controller\ControllerBase;

class MyController extends ControllerBase {

  public function content($text) {
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($curl, CURLOPT_URL, 'https://api.hh.ru/vacancies?text=' . $text);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curl);
    curl_close($curl);
    $output = json_decode($output);
    $content = '';
    foreach ($output->items as $key => $item) {
      $content .= '<h2>' . $item->name . '</h2>';
      $content .= '<h3>Компания: ' . $item->employer->name . '</h3>';
      $content .= '<h3>Требования:</h3>';
      $content .= $item->snippet->requirement;
      $content .= '<h3>Обязанности:</h3>';
      $content .= $item->snippet->responsibility;
      $content .= "<div><a href=\"$item->alternate_url\">Посмотреть на сайте</a></div>";
    }
    if(empty($content)) {
      $content .= "<p>Вакансий не найдено</p>";
    }
    return array(
      '#type' => 'markup',
      '#markup' => "<h1>Найденные вакансии</h1>$content",
    );
  }
}