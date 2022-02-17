<?php

/**
 * @file
 * Translation table for the quicktabs module.
 */

/**
 * Implements hook_translation_table_data().
 */
function quicktabs_translation_table_data() {
  $items['quicktabs'] = array(
    'title' => 'Quick Tabs',
    'description' => 'Edit quick tabs translations',
    'form' => 'quicktabs_translation_table_quicktabs_form',
    'file' => 'modules/quicktabs.translation_table.inc',
  );

  return $items;
}

/**
 * Menu callback; Admin form for quicktabs translation.
 */
function quicktabs_translation_table_quicktabs_form($form, &$form_state) {
  $languages_selected = isset($_SESSION['translation_table']['languages_selected']) ? $_SESSION['translation_table']['languages_selected'] : locale_language_list('name', FALSE);
  $machine_name = isset($_SESSION['translation_table']['machine_name']) ? $_SESSION['translation_table']['machine_name'] : 0;

  $form['filter'] = quicktabs_translation_table_quicktabs_filter($languages_selected, $machine_name);
  $form['filtered_form'] = quicktabs_translation_table_quicktabs_filtered_form($languages_selected, $machine_name);
  $form['#submit'][] = 'quicktabs_translation_table_quicktabs_form_submit';
  $form['#submit'][] = 'translation_table_submit_translations';
  return $form;
}

/**
 * Quicktabs filter.
 */
function quicktabs_translation_table_quicktabs_filter($languages_selected, $machine_name) {
  $form['languages_selected'] = array(
    '#type' => 'select',
    '#title' => t('Languages'),
    '#description' => t('Select the languages to display.'),
    '#options' => locale_language_list('name', TRUE),
    '#default_value' => array_keys($languages_selected),
    '#multiple' => TRUE,
  );

  $options['0'] = t('- Display all quicktabs -');
  $result = db_query('SELECT machine_name, title FROM {quicktabs} ORDER BY title');
  while ($row = $result->fetch()) {
    $options[$row->machine_name] = check_plain($row->title);
  }

  $form['machine_name'] = array(
    '#type' => 'select',
    '#title' => t('Quicktabs'),
    '#description' => t('Select a quicktab.'),
    '#options' => $options,
    '#default_value' => $machine_name,
  );

  $form['tt-filter'] = array(
    '#type' => 'submit',
    '#value' => t('Filter'),
  );

  $form['#theme'] = 'translation_table_filter';
  return $form;
}

/**
 * Form for quicktabs translation.
 *
 * @param $languages
 *   languages to translate to
 */
function quicktabs_translation_table_quicktabs_filtered_form($languages, $machine_name) {
  $header = _translation_table_get_header($languages);

  switch ($machine_name) {
    case '0':
      $query = db_select('locales_source', 'ls');
      $query->fields('ls', array('lid', 'source', 'location'))
        ->extend('PagerDefault')
        ->extend('TableSort')
        ->condition('ls.textgroup', 'quicktabs')
        ->orderByHeader($header)
        ->limit(50);
      $result = $query->execute();
      break;

    default:
      $query = db_select('locales_source', 'ls');
      $query->fields('ls', array('lid', 'source', 'location'))
        ->extend('PagerDefault')
        ->extend('TableSort')
        ->condition('ls.textgroup', 'quicktabs')
        ->condition('ls.context', "tab:{$machine_name}-%", 'LIKE')
        ->orderByHeader($header)
        ->limit(50);
      $result = $query->execute();
      break;
  }

  $form['strings']['#tree'] = TRUE;

  $form['header'] = array(
    '#type' => 'value',
    '#value' => $header,
  );

  while ($source = $result->fetch()) {
    if (drupal_strlen(trim($source->source)) > 0) {
      $form['strings'][$source->lid] = _translation_table_row($source, $languages);
    }
  }

  $form['languages'] = array(
    '#type' => 'value',
    '#value' => $languages,
  );
  $form['tt-submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );

  $form['pager'] = array('#markup' => theme('pager'));
  $form['#theme'] = 'translation_table';
  return $form;
}

/**
 * Submit handler for the quicktabs translation form.
 */
function quicktabs_translation_table_quicktabs_form_submit($form, &$form_state) {
  switch ($form_state['triggering_element']['#id']) {
    case 'edit-tt-filter':
    case 'edit-tt-submit':
      $_SESSION['translation_table']['machine_name'] = $form_state['values']['machine_name'];
      $_SESSION['translation_table']['languages_selected'] = array_intersect_key(locale_language_list('name', TRUE), $form_state['values']['languages_selected']);
      break;
  }
}
