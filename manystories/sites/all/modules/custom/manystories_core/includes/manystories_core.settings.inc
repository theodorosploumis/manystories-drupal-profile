<?php

/**
 * @file
 * The form to build the settings.
 */

/**
 * Create json from jsonp. Thanks to http://stackoverflow.com/a/5081588/1365264.
 * @param  $jsonp string
 *   jsonp format string to be parsed
 * @param  $assoc boolean
 *   if php 5.3- set this to TRUE because adds depth as third parameter to json_decode
 * @return string
 *   json string
 */
function manystories_core_jsonp_decode($jsonp, $assoc = false) {
  if($jsonp[0] !== '[' && $jsonp[0] !== '{') { // we have JSONP
     $jsonp = substr($jsonp, strpos($jsonp, '('));
  }
  return json_decode(trim($jsonp,'();'), $assoc);
}

/**
 * Returns an array of licenses using a json list of licenses.
 * @param  string $url
 *   The url to get the initial licenses.
 * @return array
 *   A valid array ready to be used on Drupal fields etc.
 */
function manystories_core_licenses($url = 'http://licenses.opendefinition.org/licenses/jsonp/ckan.js') {
  if ($url == "") {
    return;
  }
  $options = array(
    'method' => 'GET',
    'timeout' => 15,
    'headers' => array(
     'Content-Type' => 'application/x-javascript'),
  );

  // Get response in array
  $result = drupal_http_request($url, $options);

  // Parse data to get them in json format
  $parsed = manystories_core_jsonp_decode($result->data);

  // Create a new, simpler array of licenses
  $licenses = array();
  foreach ($parsed as $key => $value) {
    $id = $parsed[$key] -> id;
    $url = $parsed[$key] -> url;
    $title = $parsed[$key] -> title;
    if ($url) {
      $licenses[$id] = $title . " (" . $url . ")";
    } else {
      $licenses[$id] = $title;
    }
  }

  return $licenses;
}

/**
 * The admin settings form for Many Stories app.
 *
 * @param array $form
 *   Nested array of form elements that comprise the form.
 * @param array &$form_state
 *   A keyed array containing the current state of the form.
 */
function manystories_core_settings(array $form, array &$form_state) {

  $form['manystories_core'] = array(
    '#type' => 'fieldset',
    '#title' => t('Many Stories settings.'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  $form['manystories_core']['manystories_core_meta_description'] = array(
    '#type' => 'textfield',
    '#size' => 120,
    '#maxlength' => 160,
    '#required' => TRUE,
    '#title' => t('Metatag - Description'),
    '#default_value' => variable_get('manystories_core_meta_description', ""),
    '#description' => t("The content that will appear as <a href='@meta_url' target='_blank'>meta description</a> on every page. It is best to keep meta descriptions between 150 and 160 characters.", array('@meta_url' => 'https://en.wikipedia.org/wiki/Meta_element#The_description_attribute')),
     '#required' => TRUE,
  );

  $form['manystories_core']['manystories_google_verification'] = array(
    '#type' => 'textfield',
    '#title' => t('Metatag - Google Analytics verification'),
    '#default_value' => variable_get('manystories_google_verification', ""),
    '#description' => t('Get your metatag at <a href="@google-verification">google.com/webmasters</a>', array('@google-verification' => 'https://www.google.com/webmasters')),
    '#required' => FALSE,
  );

  $form['manystories_core']['manystories_core_license'] = array(
    '#type' => 'select',
    '#title' => t('Default license for the Stories'),
    '#default_value' => variable_get('manystories_core_license', ''),
    '#options' => manystories_core_licenses(),
    '#description' => t("The license for each story. The licenses below are <a href='@ckan_licenses' target='_blank'>ckan</a> compatible.", array('@ckan_licenses' => 'http://licenses.opendefinition.org/')),
    '#required' => TRUE,
  );

  $form['manystories_core']['manystories_core_rest'] = array(
    '#type' => 'checkbox',
    '#title' => t('Disable REST API for stories'),
    '#default_value' => variable_get('manystories_core_rest', "0"),
    '#description' => t("Disable the REST API for all the Stories. This may break other apps or other consumers of the data."),
  );

  $form['manystories_core']['manystories_terms_of_use'] = array(
    '#type' => 'textfield',
    '#title' => t('The "Terms of Use" page internal path'),
    '#default_value' => variable_get('manystories_terms_of_use', ""),
    '#description' => t('The internal path of the "Terms of Use". The user will have to agree with these terms in order to create an account. Do not use a leading slash! Example "node/3"'),
    '#required' => TRUE,
  );

  return system_settings_form($form);
}
