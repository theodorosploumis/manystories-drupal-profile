<?php
function ds_story_2col() {
  return array(
    'label' => t('Story: 2 column, top, bottom and a region out of wrapper'),
    'regions' => array(
      'top' => t('top'),
      'region_1' => t('region 1'),
      'region_2' => t('region 2'),
      'region_2_plus' => t('region 2 plus'),
      'region_3' => t('region 3'),
      'bottom' => t('bottom'),
    ),
//  'css' => TRUE,
    'image' => TRUE,
  );
}
