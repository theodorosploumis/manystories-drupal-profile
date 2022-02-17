<html>

<head>
  <meta charset="utf-8">
  <title>php API Consumer example - ManyStoriesOneHeart.gr</title>
</head>

<body>

<h1>Stories from ManyStoriesOneHeart.gr</h1>

<?php

// REST API url
$url = 'http://www.manystoriesoneheart.gr/api/stories';

// Get json response
$json = file_get_contents($url);

// Decode json to php array
$stories = json_decode($json, true);

//print_r($stories);

?>

<div class="count-wrapper">
  <label>Stories: </label><span class="count-value"><?php print $stories['meta']['count']; ?></span>
</div>
<div class="stories-wrapper">
  <ul class="story-list">
  <?php
    foreach ($stories['data'] as $story) {
      print "<li><a href='" . $story['attributes']['html_display'] . "'>". $story['attributes']['title'] ."</a></li>";
    }
  ?>
  </ul>
</div>

</body>
</html>
