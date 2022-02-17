<?php
/**
 * Implementation of hook_panels_styles().
 */

$plugin =  array(
  'motherstyle' => array(
    'title' => t('motherstyle'),
    'description'   => t('Motherstyle'),

    'render region' => 'motherstyle_render_region',
    'render pane'   => 'motherstyle_render_pane',

    'settings form' => 'motherstyle_region_settings',
    'pane settings form' => 'motherstyle_settings_pane',

    'hook theme'    => array(

      'motherstyle_pane' => array(
        'template' => 'motherstyle-pane',
         'path'    => drupal_get_path('module', 'mothership') .'/panelsstyles/motherstyle',
         'variables' => array(
           'content' => NULL,
           'settings' => NULL,
           'motherstyles' => NULL,
         ),
       ),

      'motherstyle_minipanel' => array(
        'template' => 'motherstyle-minipanel',
         'path'    => drupal_get_path('module', 'mothership') .'/panelsstyles/motherstyle',
         'variables' => array(
           'content' => NULL,
           'settings' => NULL,
         ),
       ),

      'motherstyle_region' => array(
        'template' => 'motherstyle-region',
         'path' => drupal_get_path('module', 'mothership') .'/panelsstyles/motherstyle',
         'variables' => array(
           'content' => NULL,
         ),
       ),

    ),
  ),
);

// render pane
function theme_motherstyle_render_pane(&$vars) {

  //test for pane type.
  $template = '';

  if (isset($vars['pane']->type)) {
    switch ($vars['pane']->type) {
      case 'panels_mini':
        $template = 'motherstyle_minipanel';
      break;
      default:
        $template = 'motherstyle_pane';
    }
  }

  //variables to send
  $settings = $vars['settings'];
  $content = $vars['content'];
  $pane = $vars['pane'];



  if(!empty($vars['pane']->configuration['override_title'])){
    $title = '' . $vars['pane']->configuration['override_title_text'];
  }else{
    // $title = 'display title' . $vars['display']->title; - we use this so were keeping it in case of trouble;)
    $title = !empty($vars['content']->title) ? $vars['content']->title : '';
  }

  $title = ctools_context_keyword_substitute($title, array(), $vars['display']->context);


  return theme($template, array('content' => $content, 'settings' => $settings, 'pane' => $pane, 'title' => $title));
}

// render region
function theme_motherstyle_render_region($vars) {

  $settings = $vars['settings'];
  $title = $vars['display']->title;
  $motherstyles = theme_get_setting('mothership_styles','mothership');
  $content = '';

  foreach ($vars['panes'] as $pane_id => $pane_output) {
   $content .= $pane_output;
  }
  if (empty($content)) {
    return;
  }

  return theme('motherstyle_region', array('content' => $content, 'settings' => $settings, 'title' => $title));
}


/**
 * Panels region form settings.
 */


function motherstyle_region_settings($style_settings) {

//get it from the default theme
$theme_default = variable_get('theme_default');
$mothership_styles = theme_get_setting('mothership_styles', $theme_default);
//yes its retarded but somehow this works *sigh*
$styles =  explode('
', $mothership_styles);

  //markup
  $form['region_markup_wrapper'] = array(
    '#prefix' => '<h2>Region Markup</h2>',
    '#type' => 'select',
    '#title' => t('wrapper tag:'),
    '#options'  => array(
      ''     => t(' [custom tag] '),
      'div'     => t('<div>'),
      'section' => t('<section>'),
      'aside'   => t('<aside>'),
      'nav'     => t('<nav>'),
      'header'  => t('<header>'),
      'footer'  => t('<footer>'),
      'main'    => t('<main>'),
    ),
    '#default_value' => (isset($style_settings['region_markup_wrapper'])) ? $style_settings['region_markup_wrapper'] : 'div',
  );

  $form['custom_tag'] = array(
    '#type' => 'textfield',
    '#size' => '20',
    '#title' => t('custom wrapper tag:'),
    '#default_value' => (isset($style_settings['custom_tag'])) ? $style_settings['custom_tag'] : '',
  );  

  $form['custom_role'] = array(
    '#type' => 'textfield',
    '#size' => '20',
    '#title' => t('wrapper role:'),
    '#default_value' => (isset($style_settings['custom_role'])) ? $style_settings['custom_role'] : '',
    '#suffix' => '<hr>',
  ); 

   // Theme defined classes
  $form['theme_style'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Theme Styles:'),
    '#options' => $styles,
    '#default_value' => (isset($style_settings['theme_style'])) ? $style_settings['theme_style'] : '',
    '#description' => t('classes defined in theme settings')
  );


  $form['custom_class'] = array(
    '#type' => 'textfield',
    '#title' => t('custom class:'),
    '#default_value' => (isset($style_settings['custom_class'])) ? $style_settings['custom_class'] : '',
  );

  return $form;
}

/**
 * Pane setting form.
 */
function motherstyle_settings_pane($style_settings) {
  $form['markup_wrapper'] = array(
    '#type' => 'select',
    '#title' => t('Markup Wrapper:'),
    '#options'  => array(
      'div'     => t('<div>'),
      'section' => t('<section>'),
      'aside'   => t('<aside>'),
      'header'  => t('<header>'),
      'footer'  => t('<footer>'),
      'span'    => t('<span>'),
    ),
    '#default_value' => (isset($style_settings['markup_wrapper'])) ? $style_settings['markup_wrapper'] : 'div',
  );

  $form['teaser_class'] = array(
    '#type' => 'select',
    '#title' => t('Teaser style:'),
    '#options' => array(
      '' => t(' --------------- '),
      't-normal' => t('Teaser Normal (.t-normal)'),
      't-normal2' => t('Teaser Normal 2 (.t-normal2)'),
      't-feature' => t('Teaser Feature (.t-feature)'),
      't-feature2' => t('Teaser Feature 2 (t-feature2)'),
      't-small' => t('Teaser Small (.t-small)'),
      't-small2' => t('Teaser Small 2 (.t-small2)'),
      't-medium' => t('Teaser Medium (.t-medium)'),
      't-medium2' => t('Teaser Medium 2 (.t-medium2)'),
      't-large' => t('Teaser Large (.t-large)'),
      't-large2' => t('Teaser Large 2 (.t-large2)'),
      't-horizontal' => t('Teaser Horizontal (.t-horizontal)'),
      't-horizontal2' => t('Teaser Horizontal 2 (.t-horizontal2)'),
      't-special' => t('Teaser Special (.t-special)'),
      't-headlines' => t('Teaser List Headlines (.t-headlines)'),
      't-todo' => t('Development Todo (.t-todo)'),
    ),
    '#default_value' => (isset($style_settings['teaser_class'])) ? $style_settings['teaser_class'] : '',
  );

  $form['grid_flow'] = array(
    '#type' => 'select',
    '#title' => t('Layout Flow:'),
    '#options' => array(
      '' => t(' --------------- '),
      'lf-2' => t('.lf-2'),
      'lf-3' => t('.lf-3'),
      'lf-4' => t('.lf-4'),
      'lf-5' => t('.lf-5'),
      'lf-6' => t('.lf-6'),
    ),
    '#default_value' => (isset($style_settings['grid_flow'])) ? $style_settings['grid_flow'] : '',
  );

  $form['grid_fixes'] = array(
    '#type' => 'select',
    '#title' => t('Grid Fixes'),
    '#options' => array(
      '' => t(' --------------- '),
      'lf-fix' => t('remove padding from a Layout flow .lr-x adds a .lf-fix class'),
    ),
    '#default_value' => (isset($style_settings['grid_fixes'])) ? $style_settings['grid_fixes'] : '',
  );


  $form['sneaky_class'] = array(
    '#type' => 'textfield',
    '#title' => t('sneaky class:'),
    '#default_value' => (isset($style_settings['sneaky_class'])) ? $style_settings['sneaky_class'] : '',
  );

  return $form;
}
