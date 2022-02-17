var Drupal = Drupal || {};

(function ($, Drupal) {
  "use strict";

  Drupal.behaviors.manystories = {
    attach: function (context) {

      // Loading gif
      $(document, context).ready(function() {
        $(window).load(function() {
           $(".page-loader").fadeOut('slow');
        });
      });

      // Add lang prefix for links etc
      var lang_prefix = "";
      var lang_xml = "";
      var html_lang = lang_xml = $('html').attr('lang');
      if (typeof html_lang !== 'undefined' && html_lang !=  'en') {
        lang_prefix = "/" + html_lang;
      }

      // Bottom icon functionality
      $(".icon-home, .icon-add-story, .icon-user", context).click(function(){
        var url = $(this).attr("data-url");
        window.location.href = url;
      });

      $(".icon-bookmarklet a", context).click(function(event){
        event.preventDefault();
      });

      // Pager functionality for Views
      var next_page_url = $(".pager .next a", context).attr("href"),
          previous_page_url = $(".pager .previous a", context).attr("href"),
          next_story_url = $(".prev-next-link-next a", context).attr("href"),
          previous_story_url = $(".prev-next-link-prev a", context).attr("href");


      $(".item-list-pager, .block-prev-next").hide();

      $(".icon-next", context).each(function(){
        var el = $(this);
        if (typeof next_page_url !== 'undefined') {
          el.click(function(){
            window.location.href = next_page_url;
          });
        } else if (typeof next_story_url !== 'undefined') {
          el.click(function(){
            window.location.href = next_story_url;
          });
        } else {
          el.hide();
        }
      });

      $(".icon-previous", context).each(function(){
        var el = $(this);
        if (typeof previous_page_url !== 'undefined') {
          el.click(function(){
            window.location.href = previous_page_url;
          });
        } else if (typeof previous_story_url !== 'undefined') {
          el.click(function(){
            window.location.href = previous_story_url;
          });
        } else {
          el.hide();
        }
      });

      // Lettering.js effects
      //$(".region-story-top h1").lettering();

      // SlideToggle the Header
      $("body", context).each(function(){
        var body = $(this),
            story = $(".node-story.view-mode-full"),
            //node_form = $(".node-form"),
            region_three = $(".region-story-three"),
            header = $('.header-region'),
            region_static = $('.region-static'),
            messages = $(".drupal-messages"),
            messages_inner = $("div.messages"),
            close_preview = $(".close-preview"),
            footer_title = $('.block-blockify-blockify-page-title'),
            footer_left = $('.region-footer-left'),
            //random_bg = "image-bg-"+Math.floor(Math.random()*43),
            empty_search_results = $(".view-all-stories .view-empty"),
            search_input = $('#edit-search'),
            search_form = $('#views-exposed-form-all-stories-page .views-exposed-form', context),
            stories_link = $(".block-views-count-stories-block .view-header a"),
            page_links = $(".field-name-body a, .field-name-field-buttons a"),
            random_url = $(".block-views-count-stories-block .views-row a").attr('href');

        var icon_open_story = $(".icon-open-story"),
            icon_close_story = $(".icon-close-story"),
            icon_menu = $(".icon-menu"),
            icon_menu_footer = $(".icon-menu-footer"),
            icon_home = $(".icon-home"),
            icon_random = $(".icon-random"),
            icon_search = $(".icon-search");

        // Header effects, this element closes the Header later
        body.append('<span class="js-close-action" title="' + Drupal.t("Close") + '""></span>');

        // Add current language to /stories link
        stories_link.attr('href', lang_prefix + "/stories");

        // Add language prefix for every link
        page_links.each(function(){
          var $el = $(this),
              $href = $el.attr('href');
          if (!($href.match(/(^http:\/\/)|(^https:)/) != null)) {
            var $new = $href.replace(lang_prefix+lang_prefix, "");
            $el.attr('href', lang_prefix + $new);
          }
        });

        icon_random.click(function(){
          window.location.href = random_url;
        });

        icon_menu.add(".js-close-action")
          .click(function(){
            body.toggleClass("js-opened-header");
          });

        // Story effects
        story.after('<span class="js-story-underlay"></span>');

        $('.js-story-underlay', context)
          //.addClass(random_bg)
          .click(function(){
            body.toggleClass("js-overflow-hidden js-hidden-story");
          });
        icon_close_story.add(close_preview).click(function(){
          body.addClass("js-overflow-hidden js-hidden-story");
        });

        icon_open_story.click(function(){
          body.removeClass("js-overflow-hidden js-hidden-story");
          window.scrollTo('100%', '0');
        });

        // Footer effects
        footer_title
          .on('mouseenter touchstart', function(){
            $(this).addClass("js-absolute-title-active");
          })
          //.delay(3000)
          .on('mouseleave touchend', function(){
            $(this).removeClass('js-absolute-title-active');
          });

        icon_menu_footer.click(function(){
          footer_left.fadeToggle('slow');
          $(this).toggleClass('js-active-footer-menu');
        });

        // Search effects
          // Prepend close button
        search_form.prepend('<span class="helpful-icon icon-close-story js-icon-close-search"></span>');

          // Toggle search using icon on footer
        icon_search.add($('.js-icon-close-search')).click(function(){
          body.toggleClass("js-active-search");
          search_input.focus();
        });

          // Empty results for views exposed filters on stories search
        if (empty_search_results.length != 0) {
          empty_search_results.appendTo(".block-views-exp-all-stories-page");
          body.addClass("js-active-search js-active-search-sticky");
        }

        // Generic function that just trigger click for an element
        function triggerClick(element) {
          return element.trigger('click');
        }

        // Keyboard Navigation using Mousetrap
        Mousetrap.bind('?', function(e){
          body.toggleClass("js-active-help");
        });
        Mousetrap.bind('ctrl+right', function(e){
          $(".icon-next").click();
        });
        Mousetrap.bind('ctrl+left', function(e){
          $(".icon-previous").click();
        });
        Mousetrap.bind('alt+i', function(e){
          triggerClick(icon_open_story);
        });
        Mousetrap.bind('alt+x', function(e){
          triggerClick(icon_close_story);
        });
        Mousetrap.bind('ctrl+alt+k', function(e){
          triggerClick(icon_random);
        });
        Mousetrap.bind('ctrl+alt+f', function(e){
          triggerClick(icon_search);
        });
        Mousetrap.bind(['esc', 'escape'], function(e){
          search_input.blur(e);
          body.removeClass("js-active-search js-active-message js-active-help");
        });

        Mousetrap.bind('ctrl+alt+m', function(e){
          triggerClick(icon_menu);
        });
        Mousetrap.bind('home', function(e){
          triggerClick(icon_home);
        });

        // Messages effects
        messages_inner.prepend('<span class="helpful-icon icon-close-story js-icon-close-messages"></span>');

        if (messages.length != 0) {
          messages.hide();
          body.addClass('js-active-message');
        }
        $(".js-icon-close-messages").click(function(){
          body.removeClass('js-active-message');
        });

        // Shortcuts effects
        $(".js-icon-close-shortcuts").click(function(){
          body.removeClass('js-active-help');
        });

        // Header alter logo href
        //$("#logo", context).attr("href","#");

      }); // end body toggle Header

      // Story better links
      $(".field-name-media-oembed a", context).each(function() {
        var el = $(this),
            text = el.text(),
            src = el.attr("href"),
            new_text = text.replace("https://www.","").replace("http://www.","").replace("https://","").replace("http://","");
          el
            .text(new_text)
            .attr('title', text);
      });

      // Add title on taxonomy term fields
      $(".field-name-field-category .field-item a", context).each(function(){
        var $el = $(this),
            $title = $el.text();
        $el.attr('title', $title);
      });

      // Primary tabs
      $("nav.tabs", context)
        .addClass("js-hidden-tabs")
        .append("<div class='js-close-tabs'>⧎</div>");

      $(".js-close-tabs").click(function(){
        $(this).parent().toggleClass("js-hidden-tabs");
      });

      // Fit text on .call-to-action field
      $('.call-to-action').boxfit({
        'maximum_font_size': '2em',
      });

      // Dynamic iframe and img height
      $(window, context).on('load resize', function() {
        var window_height = $(this).height(),
            header_height = $(".header-region").height(),
            region_two_up = $(".region-story-two-up"),
            iframe = $('.iframe'),
            story_texts_height = $('.field-name-field-story-texts').height();
        // Minimum height of the iframe
        iframe.css('min-height', window_height);

        // For header consider also padding
        $('.header-region', context).css("top", -(header_height + 30));
        // Minimum height to be equal to left sidebar height
        region_two_up.css('min-height', story_texts_height);

      });
        // Consider also the same for resize
      //$(window).once().trigger('resize');

      // CounTo plugin
      $(".count-years", context).countTo({
        from: 0,
        to: 2300,
        speed: 4000,
        refreshInterval: 50,
      });

    }
  };

})(jQuery, Drupal);