<?php

/**
 * Ctools plugin oembed provider
 * @var array
 */
$plugin = array(
  'title' => 'Story',
  'capture subpatterns' => TRUE,
  'scheme' => url('', array('absolute' => TRUE)) . 'story/*',
  'callback' => 'oembedprovider_story_provider',
  'provider' => TRUE,
);

/**
 * The default provider to handle Stories.
 *
 * @param string $url
 * @param array $matches
 */
function oembedprovider_story_provider($plugin, $url, $matches, $parameters) {
  $result = FALSE;

  // Get uuid from path alias
  $uuid = array($matches[1]);

  // Returns an array of nodes
  $nodes = entity_uuid_load('node', $uuid);

  // oEmbed parameters
  $defaults = array(
    'view_mode' => 'teaser',
    'langcode' => 'en',
    'width' => NULL,
    'height' => NULL,
  );
  $parameters = array_merge($defaults, $parameters);

  if (isset($nodes)) {
    // Get the single node
    $node = array_values($nodes)[0];

    // Base url
    global $base_url;

    if ($node && node_access('view', $node, drupal_anonymous_user())) {
     // $author = user_load($node->uid);
      $build = node_view($node, $parameters['view_mode'], $parameters['langcode']);
      $html = strip_tags(render($build), '<p><a><h3>');
      $html = str_replace("/story/", $base_url . '/story/', $html);

      $result = array(
        'type' => 'rich',
        'html' => $html,
        'title' => $node->title,
        //'author_name' => $author->name,
        //'author_url' => url('user/' . $author->uid, array('absolute' => TRUE)),
        '#entity_type' => 'node',
      );
      list($result['#id'], $result['#vid'], $result['#bundle']) = entity_extract_ids('node', $node);
      $result = _manystories_oembed_result($result['type'], $result);
    }
  }

  return $result;
}


