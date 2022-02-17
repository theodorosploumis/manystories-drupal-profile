If you are a (web) developer this page is for you.

It contains some useful information about the building of this web app.

There is also a [FAQs](faqs) session you can read before coming here.

### Technology used

#### 1. Drupal
[Drupal](https://www.drupal.org)

The whole web portal is made with Drupal 7.x. There is an HTML5 responsive design built as a subtheme of [Mothership](https://www.drupal.org/project/mothership).

#### 2. oEmbed
[oEmbed](http://oembed.com/)

We use the oEmbed format to "embed" third party media on it. This allows for "fair use" of that media.

#### 3. Embed.ly
[Embed.ly](http://embed.ly/)

This is a paid service with free plan available that provides better oEmbed integration.

#### 4. RDF and RSS

We use [RDF](http://www.w3.org/RDF/) to provide linked and structured data for the [Stories HTML](http://manystoriesoneheart.gr/stories), for the [SPARQL Endpoint](sparql) as also as an [RSS feed](http://manystoriesoneheart.gr/rss).

We mainly use namespaces such as [schema.org](http://lov.okfn.org/dataset/lov/vocabs/schema) and [Dublin Core](http://dublincore.org/) for the [RSS](https://www.wikiwand.com/en/RSS). Here is the complete list of the namespaces that are used:

- [content](http://purl.org/rss/1.0/modules/content/)
- [dc](http://purl.org/dc/terms/)
- [foaf](http://xmlns.com/foaf/0.1/)
- [og](http://ogp.me/ns#)
- [rdfs](http://www.w3.org/2000/01/rdf-schema#)
- [sioc](http://rdfs.org/sioc/ns#)
- [sioct](http://rdfs.org/sioc/types#)
- [skos](http://www.w3.org/2004/02/skos/core#)
- [xsd](http://www.w3.org/2001/XMLSchema#)
- [owl](http://www.w3.org/2002/07/owl#)
- [rdf](http://www.w3.org/1999/02/22-rdf-syntax-ns#)
- [rss](http://purl.org/rss/1.0/)
- [site](http://manystoriesoneheart.gr/ns#)
- [schema](https://schema.org/)


#### 5. HybridAuth
[HybridAuth](https://github.com/hybridauth/hybridauth)

We use HybridAuth for easy social sign-in on the portal using accounts from various social apis and identities providers such as Facebook, Twitter and Google.

#### 6. jsonAPI
[jsonAPI](http://jsonapi.org/)

We use this special json specification to create our [RESTful API responses](restapi). JsonAPI is designed to minimize both the number of requests and the amount of data transmitted between clients and servers. This efficiency is achieved without compromising readability, flexibility, or discoverability.

#### 7. Mousetrap
[Mousetrap](https://craig.is/killing/mice)

We use this tiny standalone javascript library to create some useful navigation shortcuts.

#### 8. Wikiwand.com
[Wikiwand.com](https://www.wikiwand.com)

Wikiwand is probably the best reader for [Wikipedia](https://www.wikipedia.org/). We don't use it as a service but we like it a lot and most of our external links are going to Wikiwand instead of the 'ugly' Wikipedia.

#### 9. Markdown
[Markdown](https://daringfireball.net/projects/markdown/)

Markdown is a text-to-HTML conversion tool for web writers. We use this tool to create the content for the basic website pages as also as for the Github documentation.

#### 10. jQuery countTo

[jQuery countTo](https://github.com/mhuggins/jquery-countTo)

jQuery countTo is a jQuery plugin that will count up (or down) to a target number at a specified speed, rendered within an HTML DOM element.

#### 11. SPARQL

[SPARQL Query Language](https://www.w3.org/TR/sparql11-query/)

There is a whole [page about SPARQL](sparql).


### Accessibility

This project was made with accessibility in mind.
Currently it is valid under [WCAG 2.0 (Level AA)](https://www.w3.org/WAI/WCAG20/quickref/) specification except from the external data that are embeded to the web pages using the oEmbed protocol. For these external date there is no option (technically) to fix any accessibility issues if exist.

### Tools used

Sharing here some online tools that helped us create this project.

- [HTML Character entity reference Chart](http://dev.w3.org/html5/html-author/charref)
- [Bookmarkleter](http://chriszarate.github.io/bookmarkleter/) (Create bookmarklet from js)
- [Patterncooler.com/](http://patterncooler.com/) (Free seamless pattern backgrounds)
- [ezgif.com](http://ezgif.com/) (Animated gif editor and gif maker)
- [realfavicongenerator.net](http://realfavicongenerator.net/) (A tool to generate favicons, Windows 8 Tiles, Apple Touch icons, Android and iOS icons.)


### Icons and other resources

We are using some icons or other media from these providers, creators.

- An old postcard from [Flickr](https://www.flickr.com/photos/ptg1975/5343849352/in/album-72157625668274553/) by [Petros Andronakis](https://www.flickr.com/photos/ptg1975/).
- [Slim Square Icons - Basics](https://www.iconfinder.com/iconsets/slim-square-icons-basics) by [icons.design](http://icons.design/)
- [Social Media icons](https://www.iconfinder.com/iconsets/social-media-2026) by [roundicons.com](http://www.roundicons.com/)
- [licenses.opendefinition.org](http://licenses.opendefinition.org/) (json lists of all available open licenses perfect for our open data)
- [Accessible - Fat finger form controls](http://codepen.io/ipetepete/pen/ulqGe) (css code)
- [Creative commons music by Josh Woodward](http://www.joshwoodward.com/) (music used on the the promo video)

### Documentation

A short documentation for this Drupal web project is available on [manystories.readthedocs.org](http://manystories.readthedocs.org)

### Issues

You can send us issues or things you believe that need improvement here:

- [github.com/manystories/drupal/issues](https://github.com/manystories/drupal/issues)

### Contribute

You can create pull requests or explore the project. It is hosted on Github and most of its parts are open to everyone.

- [github.com/manystories](https://github.com/manystories/)

### RESTful API

Information for how to use the API can be found on the related page: [Restful API](restfulapi)

### SPARQL Endpoint

Information for how to use the SPARQL Endpoint can be found on the related page: [SPARQL Endpoint](sparql)

### Examples of Apps using the APIs

There are examples and demos available at [manystories.github.io/apps/](http://manystories.github.io/apps/)
