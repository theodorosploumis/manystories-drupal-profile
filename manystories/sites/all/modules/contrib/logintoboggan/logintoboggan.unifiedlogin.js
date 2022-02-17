
(function ($) {

Drupal.behaviors.unifiedLogin = {

  attach: function (context, settings) {
    // Attach behaviors to the links so that they show/hide forms appropriately.
    $('.toboggan-unified #register-link', context).click(function() {
      $(this).addClass('lt-active').blur();
      $('.toboggan-unified #login-link', context).removeClass('lt-active');
      $('.toboggan-unified #register-form', context).show();
      $('.toboggan-unified #login-form', context).hide();
      $.ajax({
        url: "/user/register",
        success: function(data) {
          var title = data.match("<title>(.*?)</title>")[1];
          $('html head').find('title').text(title);
          $('h1.title').text(title.substring(0,title.indexOf('|')));
        }
      });
      return false;
    });
    $('.toboggan-unified #login-link', context).click(function () {
      $(this).addClass('lt-active').blur();
      $('.toboggan-unified #register-link', context).removeClass('lt-active');
      $('.toboggan-unified #login-form', context).show();
      $('.toboggan-unified #register-form', context).hide();
      $.ajax({
        url: "/user/login",
        success: function(data) {
          var title = data.match("<title>(.*?)</title>")[1];
          $('html head').find('title').text(title);
          $('h1.title').text(title.substring(0,title.indexOf('|')));
        }
      });
      return false;
    });

    switch(settings.LoginToboggan.unifiedLoginActiveForm) {
      case 'register':
        $('.toboggan-unified #register-link', context).click();
        break;
      case 'login':
      default:
        $('.toboggan-unified #login-link', context).click();
        break;
    }
  }
};

})(jQuery);