<?php

/* Nukes the css from drupal core */
function mothership_css_alter(&$css) {

  //IE @import -> link fix for theme 
  //enough of this Druapal + HTML5 + IE 8  testing forgetting to turn on css aggregation
  //test if aggregate isnt turned on and were using respondjs to polyfill for all of ie6-8 wonders
  //We only test on files in the theme
  if ( !variable_get('preprocess_css') AND theme_get_setting('mothership_respondjs') ) {

    foreach ($css as $file => $value) {
      // only take the files in the theme that should prevent us from going oveor the 31 files
      if (strpos($file, 'themes') !== FALSE) {
        //ok test if the file exist just to not add css files that we killed of with the FOAD etc
        //its not pretty but we dont have any easy methode to read theme_info from 2 level of basethemes
        //so this is what changes from @import to <link>
        //https://api.drupal.org/api/drupal/includes%21common.inc/function/drupal_add_css/7
        $count ="0";
        if(file_exists($file)){
          $css[$file]['preprocess'] = FALSE;
          $count++;
        }
      }
    }
    //test for the IE limit for 31 linked css files
    if($count > 31){
      drupal_set_message(t('IE 8/9 have a limit of 31 files  why are you adding that many css files in your theme ... use a preprocessor '), 'warning', FALSE);
    }

  }

}

