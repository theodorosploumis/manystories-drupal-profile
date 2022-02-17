<?php

// Plugin definition
$plugin = array(
  'title' => t('mothership two column stacked'),
  'category' => t('Mothership'),
  'icon'  => 'mothership-2colstacked.png',
  'theme' => 'mothership-2colstacked',
  'css'   => 'mothership-2colstacked.admin.css',
  'regions' => array(
    'top'   => t('Top'),
    'left'  => t('Left side'),
    'right' => t('Right side'),
    'bottom'=> t('Bottom')
  ),
);
