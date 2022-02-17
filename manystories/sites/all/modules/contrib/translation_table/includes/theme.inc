<?php

/**
 * @file
 * The functions.
 */

/**
 * Theme function for the translation table.
 *
 * @ingroup themeable
 */
function theme_translation_table($variables) {
  $vocabulary_machine_names = &drupal_static(__FUNCTION__);

  $form = $variables['form'];
  $rows = array();
  $header = $form['header']['#value'];
  $languages = $form['languages']['#value'];
  $query = drupal_get_destination();

  foreach (element_children($form['strings']) as $key) {
    // Build the table row.
    $row = array();
    $row['data'][] = array('data' => drupal_render($form['strings'][$key]['source']), 'class' => 'translation-source');

    foreach ($languages as $lang_code => $lang_name) {
      $row['data'][] = array('data' => drupal_render($form['strings'][$key][$lang_code]), 'class' => "translation-{$lang_code}");
    };
    $location = explode(':', $form['strings'][$key]['location']['#value']);
    if (count($location) == 4) {
      switch ($location[1]) {
        case 'term':
          $row['data'][] = l(t('Edit source'), "taxonomy/term/{$location[2]}/edit", array('query' => $query, 'attributes' => array('title' => t('Edit term (@property)', array('@property' => $location[3])))));
          break;

        case 'vocabulary':
          $vid = $location[2];
          if (!isset($vocabulary_machine_names)) {
            $vocabulary_machine_names = db_select('taxonomy_vocabulary', 'tv')
              ->fields('tv', array('vid', 'machine_name'))
              ->execute()
              ->fetchAllKeyed();
          }
          if (isset($vocabulary_machine_names[$vid])) {
            $machine_name = $vocabulary_machine_names[$vid];
            $row['data'][] = l(t('Edit source'), "admin/structure/taxonomy/{$machine_name}/edit", array('query' => $query, 'attributes' => array('title' => t('Edit vocabulary (@property)', array('@property' => $location[3])))));
          }
          break;

        case 'item':
          $row['data'][] = l(t('Edit source'), "admin/structure/menu/item/{$location[2]}/edit", array('query' => $query, 'attributes' => array('title' => t('Edit menu item (@property)', array('@property' => $location[3])))));
          break;

        case 'type':
          $node_types = node_type_get_names();
          $node_type = isset($node_types[$location[2]]) ? $node_types[$location[2]] : $location[2];
          $row['data'][] = l(t('Edit source'), "admin/structure/types/manage/{$location[2]}", array('query' => $query, 'attributes' => array('title' => t('Edit @node_type (@property)', array('@node_type' => $node_type, '@property' => $location[3])))));
          break;

        default:
          $row['data'][] = '';
      }
    }
    else {
      $row['data'][] = '';
    }
    $row['data'][] = l(t('Translate'), 'admin/config/regional/translate/edit/' . $key, array('query' => $query));
    $row['data'][] = l(t('Delete string'), 'admin/config/regional/translate/delete/' . $key, array('query' => $query));

    $rows[] = $row;
  }

  $output = theme('table', array(
    'header' => $header,
    'rows'   => $rows,
    'attributes' => array('id' => 'translation-table')
  ));

  if ($form['pager']['#markup']) {
    $output .= drupal_render($form['pager']);
  }
  $output .= drupal_render_children($form);

  drupal_add_css(drupal_get_path('module', 'translation_table') . '/css/translation-table-admin.css');
  return $output;
}

/**
 * Theme function for the basic filter form.
 *
 * @ingroup themeable
 */
function theme_translation_table_filter($variables) {
  $form = $variables['form'];
  $output = '<div id="translation-table-filter">';
  foreach (element_children($form) as $key) {
    $attributes = drupal_attributes(array(
      'id' => drupal_html_id("translation-table-{$key}-filter"),
      'class' => 'translation-table-filter',
    ));
    $output .= "<div $attributes>";
    $output .= drupal_render($form[$key]);
    $output .= '</div>';
  }
  $output .= '</div>';

  return $output;
}
