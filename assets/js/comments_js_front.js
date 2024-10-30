( function( $ ) {

$(window).on('load', function() {
    init_body_class();
});
$(window).on('load resize', function() {
      set_body_small();
  });
function is_mobile() {
     if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
         return true;
     }
     return false;
}

function init_body_class(){
    $('#comments').addClass('cwpd-comment-area');
    $('.comment-list').addClass('cwpd-load-comment');
    if(is_mobile() == true){
        $('#comments').addClass('cwpd-small-comment-area');
    }
}
/**
* Mobile Class
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
function set_body_small() {
  if ($(this).width() < 769) {
      $("#comments").addClass('cwpd-mobile-small-page');
  } else {
      $("#comments").removeClass('cwpd-mobile-small-page');
  }
}
/**
* Load Commenta
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
$('.comment_loadmore').click( function(){
    var button = $(this);
    cwpd_cpage--;
    $.ajax({
      url : ajaxurl,
      data : {
        'action': 'cwpd_ajax_comments_load',
        'post_id': cwpd_post_id,
        'cpage ' : cwpd_cpage ,
      },
      type : 'POST',
      beforeSend : function () {
        button.text(cwpd_loading_text); 
      },
      success : function( data ){
        if( data ) {
          $('.comment-list').append( data );
          button.text(cwpd_load_more_text); 
          if ( cwpd_cpage  == 1 )
            button.remove();
        } else {
          button.remove();
        }
      }
    });
    return false;
  });
if(cwpd_scroll_enable == 1){
  jQuery(document).on('scroll', function() {
    var button = jQuery('.comment_loadmore');
    if( (jQuery(this).scrollTop() + jQuery(window).height() ) >= button.offset().top){

      if( button.text() == cwpd_load_more_text ) {
        button.trigger('click'); 
      }
   
    }
  });
}
/**
* Comments Validation
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
jQuery.extend(jQuery.fn, {
  validate: function () {
    if (jQuery(this).val().length < 3) {jQuery(this).addClass('error');return false} else {jQuery(this).removeClass('error');return true}
  },
  validateEmail: function () {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
        emailToValidate = jQuery(this).val();
    if (!emailReg.test( emailToValidate ) || emailToValidate == "") {
      jQuery(this).addClass('error');return false
    } else {
      jQuery(this).removeClass('error');return true
    }
  },
});
/**
* Submit Comments
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
$( '#commentform' ).submit(function(){
    var button = $('#submit'),
        respond = $('#respond'),
        commentlist = $('.comment-list'),
        cancelreplylink = $('#cancel-comment-reply-link');

    if( $( '#author' ).length )
      $( '#author' ).validate();
 
    if( $( '#email' ).length )
      $( '#email' ).validateEmail();

    $( '#comment' ).validate();

    if ( !button.hasClass( 'loadingform' ) && !$( '#author' ).hasClass( 'error' ) && !$( '#email' ).hasClass( 'error' ) && !$( '#comment' ).hasClass( 'error' ) ){
 
      // ajax request
      $.ajax({
        type : 'POST',
        url : cwpd_ajax_comment_params.ajaxurl,
        data: $(this).serialize() + '&action=cwdp_ajax_action',
        beforeSend: function(xhr){
          button.addClass('loadingform').val('Processing...');
        },
        error: function (request, status, error) {
          if( status == 500 ){
             $("#erroreesult").html('Error while adding comment'); 
          } else if( status == 'timeout' ){
            $("#erroreesult").html('Error: Server doesn\'t respond.');
          } else {
            var wpErrorHtml = request.responseText.split("<p>"),
              wpErrorStr = wpErrorHtml[1].split("</p>");
 
            $("#erroreesult").html(wpErrorStr[0]);
          }
        },
        success: function ( addedCommentHTML ) {
 
          if( commentlist.length > 0 ){
 
            if( respond.parent().hasClass( 'comment' ) ){
 
              if( respond.parent().children( '.children' ).length ){  
                respond.parent().children( '.children' ).append( addedCommentHTML );
              } else {
                addedCommentHTML = '<ul class="children">' + addedCommentHTML + '</ul>';
                respond.parent().append( addedCommentHTML );
              }
              cancelreplylink.trigger("click");
            } else {
              commentlist.append( addedCommentHTML );
            }
          }else{
            addedCommentHTML = '<ul class="comment-list">' + addedCommentHTML + '</ul>';
            respond.before( $(addedCommentHTML) );
          }
          $('#comment').val('');
        },
        complete: function(){
          button.removeClass( 'loadingform' ).val( 'Post Comment' );
        }
      });
    }
    return false;
  });
} )( jQuery );
