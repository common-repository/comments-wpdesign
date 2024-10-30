( function( $ ) {
  $(window).on('load', function() {
      init_main_body_class();
      init_page_name_as_class();
  });
  /**
    * Body Class
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 19.04.2020
    */
  function init_main_body_class(){
      $('body').addClass('cwpd');
      $('body').addClass('cwpd-desktop-device');
      
  }

    /**
    * Page Name
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 19.04.2020
    */
  function init_page_name_as_class() {
      var pageCurrentUrl = window.location.href;
      var removeDomainSegment = pageCurrentUrl.substr(pageCurrentUrl.lastIndexOf('/') + 1);
      var lastSegment = removeDomainSegment.split('.').slice(0, -1).join('.')
      $('.mmwps-wrapper').addClass('mmwps-page-'+lastSegment);
  }
  /**
    * Save Setting Data
    * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
    * Date       : 19.04.2020
    */
 $('#of_save_setting').live('click', function () {
    var nonce = $('#security_setting').val();
    var serialized_data = $('#setting_form :input[name]').serialize();
    var data = {
      type: 'save_cwpd_setting',
      action: 'ajax_setting_action',
      security: nonce,
      data: serialized_data
    };
    $.post(ajaxurl, data, function (response) {
      console.log(ajaxurl);
      if (response == 1) {
       notifyMessage('Option Updated', 'success', 'fa fa-check');
      } else if(response == -1) {
        notifyMessage('Nonce is invalid or Something wrong, try again!', 'danger', 'fa fa-times-circle');
      }else {
        notifyMessage('Something wrong, try again!', 'warning', 'fa fa-warning');
      }
    });
    return false;
  });
} )( jQuery );
  /**
  * Notify Message Show Function
  * Dependencies   : jquery
  * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
  * Date       : 19.04.2020
  */
function notifyMessage(message,messageType,icon) {
  jQuery.notify(
    {
      // options
      title: messageType.charAt(0).toUpperCase() + messageType.slice(1),
      message: "<br>" + message,
      icon: icon,
      target: "_blank",

    },
    {
      // settings
      element: "body",
      type: messageType,
      showProgressbar: false,
      placement: {
        from: "top",
        align: "right"
      },
      offset: {
        x:25,
        y:50
      },
      spacing: 10,
      z_index: 1031,
      delay: 3300,
      timer: 1000,
      allow_dismiss: true,
      newest_on_top: false,
      mouse_over: 'pause',
      url_target: "_blank",
      mouse_over: null,
      animate: {
        enter: "animated fadeInDown",
        exit: "animated lightSpeedOut"
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: "class",
      beforeOpen : function() {
        alert('A notice will be presented.');
      },
    }
  );
};
