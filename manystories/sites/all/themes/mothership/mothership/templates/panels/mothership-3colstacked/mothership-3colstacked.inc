<?php

// Plugin definition
$plugin = array(
  'title' => t('mothership tree column stacked'),
  'category' => t('Mothership'),
  'icon'  => 'mothership-3colstacked.png',
  'theme' => 'mothership-3colstacked',
  'css'   => 'mothership-3colstacked.admin.css',
  'regions' => array(
    'top'   => t('Top'),
    'left'  => t('Left side'),
    'middle'  => t('Left side'),    
    'right' => t('Right side'),
    'bottom'=> t('Bottom')
  ),
);
