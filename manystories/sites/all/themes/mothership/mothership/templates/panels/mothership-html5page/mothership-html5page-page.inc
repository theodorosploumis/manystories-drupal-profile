<?php

// Plugin definition
$plugin = array(
  'title' => t('Mothership HTML5 page'),
  'category' => t('Mothership'),
  'icon' =>  'mothership-html5page.png',
  'theme' => 'mothership-html5page',
  'css' =>   'mothership-html5page.admin.css',
  'regions' => array(
    'top' => t('Header (<header>)'),
    'main' => t('Main (<main>'),
    'bottom' => t('Bottom (<footer>)'),
  ),
);
