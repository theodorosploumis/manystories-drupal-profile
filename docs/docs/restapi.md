## REST API

### About

This is a public available REST API so everyone can consume the data freely.
Here are some basic information about the [api](http://manystoriesoneheart.gr/api) for your interest.

- Only Stories are exposed at the moment.
- The data are read only.
- We do not expose any parsed oEmbed results on the API to avoid legal issues with the oEmbed protocol. Instead, we provide only the url of each media file that is used on each Story.
- Each item (Story) is provided under an open source license that is common for all items. Please read the license before use each item.
- Default format of the API is the [jsonAPI](http://jsonapi.org/) but this could change.
- API is under version control (current version is **1.0**). Future versions may be available.
- Default pager shows 50 items. You can override this through a parameter.
- Datetime fields are displayed using the [UNIX time format](https://www.wikiwand.com/en/Unix_time).
- Most of the times results are cached on the server so new Items may not be available immediately after they get created.
- You can create any websites, web or mobile app or anything else using this API with the only obligation to respect the license.
- Do a fair use and respect the systems behind this API.
- By using this API you also agree with the generic [Terms of Use](http://manystoriesoneheart.gr/node/3).

### REST options

By default this app provides a clean read-only http REST API under the [api](/api) path.

The API is made with the [best practices](http://www.vinaysahni.com/best-practices-for-a-pragmatic-restful-api) in mind.

Here are some basic examples of usage. Notice that you may have some programming experience before using the API.

> We recommend you use a browser REST client to inspect the API such as [Postman](https://www.getpostman.com/), [Advanced Rest Client](https://github.com/jarrodek/ChromeRestClient), [RESTClient](http://restclient.net/) etc.

#### 1. Discover the resource

Using an HTTP GET request, you can return the Discovery of the resource.
The resource will respond with a JSON object that contains useful info for each resource defined by the API.
The data results are stored in the data property of the JSON response, while the self and next objects contain information about the resource.


```
curl GET http://manystoriesoneheart.gr/api/
```

#### 2. Get all the available Versions of the resources

By default the API will return the latest versions for each resource.
If you want to see all the versions available use the parameter ```?all=true``` on the request.

```
curl -X GET -i http://manystoriesoneheart.gr/api/?all=true
```

#### 3. Get the Stories resource

```
curl -X GET -i http://manystoriesoneheart.gr/api/stories
```
which is the same as:

```
curl -X GET -i http://manystoriesoneheart.gr/api/v1.0/stories
```

since v1.0 is the latest for the Stories resource.

This will return a list of Items (Stories) with many fields. These fields do match the html display of each Story.

#### 4. Change the Items per page
By default there are 50 Items per page. You can override this on the query.

```
// This will return 2 items per page
curl -X GET -i  http://manystoriesoneheart.gr/api/stories?range=2
```

#### 5. Filter the results to get back only specific Fields

```
curl -X GET -i http://manystoriesoneheart.gr/api/stories?fields=label,universal_id,story_text,media_url

```

#### 6. Apply a Query filter to search within results

Using this option you can filter results using an operator such as "=", "!=", "<", ">" etc.

Here is a list of available operators (if applicable for the specific field type):

```
=
!=
>
<
>=
<=
<>
IN
AND
BETWEEN
CONTAINS
IN
LIKE
NOT IN
STARTS_WITH
```

```
// Get all Stories that belong to the category "Events". Notice that by default the operator "=" is used.
curl -X GET -i http://manystoriesoneheart.gr/api/stories?filter[categories]=Events

// Get all Stories that belong to the category "Events" AND "Activities". For both filters we provide the operator "=".
// Do not use simple (') or double quotes (") for the values!
// For example, this is wrong: *filter[categories][value][0]="Events"*

curl -X GET -i http://manystoriesoneheart.gr/api/stories?filter[categories][value][0]=Events&filter[categories][value][1]=Culture&filter[categories][operator][0]="="&filter[categories][operator][1]="="

// Get the Stories with publish_date=1449764174 OR publish_date=1449953170.
curl -X GET -i http://manystoriesoneheart.gr/api/stories?filter[publish_date][value][0]=1449764174&filter[publish_date][value][1]=1449953170&filter[publish_date][operator][0]="IN"&filter[publish_date][operator][1]="IN"

// Get all Stories with publish_date > 1449764174.
curl -X GET -i http://manystoriesoneheart.gr/api/stories?filter[publish_date][value][0]=1449764174&filter[publish_date][operator][0]=">"

// Get all Stories that CONTAIN the string "book" on the title.
curl -X GET -i http://manystoriesoneheart.gr/api/stories?filter[label][value]=book&filter[label][operator]=CONTAINS

// Get all Stories with the media_url field from youtube.
curl -X GET -i http://manystoriesoneheart.gr/api/stories?filter[media_url][value]=https://www.youtube.com&filter[media_url][operator]=STARTS_WITH

```

#### 7. Get multiple Stories with one request

```
// Load 2 Stories from their universal unique ids
// id1 = 0876712b-186d-443b-8dd0-00ab3c060f05
// id2 = 0587f5e9-175d-4c17-9e90-dcb1204f084f
curl -X GET -i http://manystoriesoneheart.gr/api/stories/0876712b-186d-443b-8dd0-00ab3c060f05,0587f5e9-175d-4c17-9e90-dcb1204f084f

```

#### 8. Get a Story with an alternative unique id on the path

Notice that this will return the first only result if there are multiple items found.

```
// Get the first Story found with the value "Taste" on field "see_more_text"
curl -X GET -i http://manystoriesoneheart.gr/api/stories/Taste?loadByFieldName=see_more_text

```

#### 9. Sort by another field (default by publish_date ASC)

```
// Sort by Title, ASC
curl -X GET -i http://manystoriesoneheart.gr/api/stories?sort=title

// Sort by publish_date DESC (latest first).
// Notice the minus sign ('-') in front of the field name in the sort parameter.
curl -X GET -i http://manystoriesoneheart.gr/api/stories?sort=-publish_date

```

### REST examples

Here are some very simple examples of how to consume the API. Full examples can be found on [Github](https://github.com/manystories/docs/tree/master/docs/rest-examples).

#### 1. Using jQuery ajax

```javascript
(function($){
  $(document).ready(function () {
    // The main api usr for Stories.
  	var $url = 'http://manystoriesoneheart.gr/api/stories';

  	$.ajax({
      type: 'GET',
      url: $url,
      success: function (results) {
        $.each(results.data, function(index, element) {
          console.log(element);
        });
      }
  	});
  });
})(jQuery);
```

#### 2. Using php

```php
// REST API url.
$url = 'http://manystoriesoneheart.gr/api/stories';

// Get json response.
$json = file_get_contents($url);

// Decode json to php array.
$stories = json_decode($json, true);

// The array is ready to use.
print_r($stories);
```
