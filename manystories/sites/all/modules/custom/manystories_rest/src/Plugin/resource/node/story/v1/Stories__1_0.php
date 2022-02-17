<?php

/**
 * @file
 * Contains Drupal\manystories_rest\Plugin\resource\node\story\v1\Stories__1_0
 */

namespace Drupal\manystories_rest\Plugin\resource\node\story\v1;

use Drupal\restful\Plugin\resource\DataInterpreter\DataInterpreterInterface;
use Drupal\restful\Plugin\resource\Field\ResourceFieldBase;
use Drupal\restful\Plugin\resource\Field\ResourceFieldEntity;
use Drupal\restful\Plugin\resource\ResourceInterface;
use Drupal\restful\Plugin\resource\ResourceNode;

/**
 * Class Stories__1_0
 * @package Drupal\manystories_rest\Plugin\resource\node\story\v1
 *
 * @Resource(
 *   name = "stories:1.0",
 *   resource = "stories",
 *   label = "Stories",
 *   description = "Published Stories.",
 *   authenticationOptional = TRUE,
 *   dataProvider = {
 *     "entityType": "node",
 *     "bundles": {
 *       "story"
 *     },
 *     "sort": {
 *       "publish_date": "DESC",
 *       "label": "ASC"
 *     },
 *     "range": 20,
 *     "idField": "universal_id",
 *   },
 *   allowOrigin = "*",
 *   formatter = "json_api",
 *   majorVersion = 1,
 *   minorVersion = 0
 * )
 */
class Stories__1_0 extends ResourceNode implements ResourceInterface  {
  /**
   * Overrides ResourceNode::publicFields().
   */
  protected function publicFields() {
    //dpm($this);

    $public_fields = parent::publicFields();

    //dpm($public_fields);

    // Unset label because we use title
    //unset($public_fields['label']);
    // Unset self wrong url
    unset($public_fields['self']);
    // Unset the id (which is the nid)
    unset($public_fields['id']);

    $public_fields['universal_id'] = array(
      'property' => 'uuid',
    );

    $public_fields['title'] = array(
      'property' => 'title',
    );

    $public_fields['html_display'] = array(
      'property' => 'uuid',
      'process_callbacks' => array(
        array($this, 'getNodeAlias'),
      ),
    );

    $public_fields['item_license'] = array(
      'process_callbacks' => array(
        array($this, 'getDatasetLicense'),
      ),
    );

    //$public_fields['creator'] = array(
    //  'property' => 'uid',
    //  'referencedIdProperty' => 'name',
    //);

    //$public_fields['language'] = array(
    //  'property' => 'language',
    //);

    $public_fields['publish_date'] = array(
      'property' => 'created',
    );

    $public_fields['story_text'] = array(
      'property' => 'field_story_texts',
      'sub_property' => 'value',
      'process_callbacks' => array(
        'strip_tags',
      ),
    );

    $public_fields['media_url'] = array(
      'property' => 'field_media',
      'sub_property' => 'url',
    );

    $public_fields['event_date'] = array(
      'property' => 'field_date',
    );

    $public_fields['postal_address'] = array(
      'property' => 'field_address',
    );

    $public_fields['location'] = array(
      'property' => 'field_location',
      'process_callbacks' => array(
        array($this, 'geofieldArray'),
      ),
    );

    $public_fields['see_more_url'] = array(
      'property' => 'field_see_more_link',
      'sub_property' => 'url',
    );

    $public_fields['see_more_text'] = array(
      'property' => 'field_see_more_text',
    );

    $public_fields['categories'] = array(
      'property' => 'field_category',
      'referencedIdProperty' => 'name',
    );

    // It needs to connect with the db table by overriding the Plugin/resource/ResourceEntity.php
    //$public_fields['rdf_mapping'] = array(
    //  'property' => 'rdf_mapping',
    //);

    return $public_fields;
  }

  /**
   * Display the website path alias of this resource using the uuid.
   *
   * @param  string $value
   * @return string
   */
  public function getNodeAlias($value) {
    global $base_url;
    return $base_url . '/story/' . $value;
  }

  public function getDatasetLicense() {
    $licenses = manystories_core_licenses();
    $license_key = variable_get('manystories_core_license', '');

    return $licenses[$license_key];
  }

  /**
   * Return only lat,lon values from geofield field
   * @param  array  $array
   * @return array
   */
  public function geofieldArray(array $array) {
    $return = array();
    foreach ($array as $key => $value) {
      if ($key == "lat" || $key == "lon") {
        $return[$key] = $value;
      }
    }
    return empty($return) ? NULL : $return;
  }
}
