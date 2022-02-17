<?php
/*
Nukes the js
*/
function mothership_js_alter(&$js) {

  //mothership removes classes all over so a tiny fix to contextual links is needed ... ups
  if(module_exists('contextual')){
    $contextual_path = drupal_get_path('module', 'contextual');
    if (isset($js[$contextual_path . '/contextual.js'])) {
      $js[$contextual_path . '/contextual.js']['data'] = drupal_get_path('theme', 'mothership') . '/js/contextual.js';
    }
  }

  if(theme_get_setting('mothership_js_jquery_latest')){
    if (isset($js['misc/jquery.js'])) {
      $js['misc/jquery.js']['data'] = drupal_get_path('theme', 'mothership') . '/js/jquery-1.8.2.min.js';
      $js['misc/jquery.js']['weight'] = -100;
    }
  }

  //http://www.metaltoad.com/blog/mobile-drupal-optimization-results
  if(theme_get_setting('mothership_js_jquerycdn')){
    $version = theme_get_setting('mothership_js_jquerycdn_version');
    if (isset($js['misc/jquery.js'])) {
      $js['misc/jquery.js']['data'] ='http://ajax.googleapis.com/ajax/libs/jquery/' . $version . '/jquery.min.js';
      $js['misc/jquery.js']['type'] = 'external';
      $js['misc/jquery.js']['weight'] = -100;
    }
  }


  if(theme_get_setting('mothership_js_onefile')){
    uasort($js, 'drupal_sort_css_js');
    $i = 0;
    foreach ($js as $name => $script) {
      $js[$name]['weight'] = $i++;
      $js[$name]['group'] = JS_DEFAULT;
      $js[$name]['every_page'] = FALSE;
    }
  }

}

