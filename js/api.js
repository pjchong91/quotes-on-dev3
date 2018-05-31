(function($) {
  'use strict';

  /**
   * Ajax-based random post fetching & History API
   */

  var lastPage = '';

$('#new-quote-button').on('click', function(event){
  event.preventDefault();
  
  $.ajax({
    method: 'GET',
    url: api_vars.root_url + 'wp/v2/posts?filter[orderby]=rand&filter[posts_per_page]=1',
    cache: false
  }).done(function(data){
  
    $('.entry-content').html(data[0].content.rendered);

    if (data[0]._qod_quote_source !== '' && data[0]._qod_quote_source_url !== '' ){
      $('.entry-title').html('&mdash;'+ data[0].title.rendered + ',  '); 
      $('.source').html('<a href="'+ data[0]._qod_quote_source_url + '" alt="Quote Source">' + data[0]._qod_quote_source + '</a>');
    }
    else if (data[0]._qod_quote_source !== '' ){
      $('.entry-title').html('&mdash;'+ data[0].title.rendered + ',  '); 
      $('.source').html(data[0]._qod_quote_source);
    }else {
      $('.entry-title').html('&mdash;'+ data[0].title.rendered);
      $('.source').empty();
    } 

    lastPage=document.URL;

    history.pushState(null, null, data[0].slug);

  }).fail(function(){
    $('.site-main').html('There appears to be an error retrieving quotes.  Please refresh and try again.')
  });
});

  /**
   * Ajax-based front-end post submissions
   */

   $('#quote-submission-form').submit(function(event){
    event.preventDefault();

    $.ajax({
      method: 'POST',
      url: api_vars.root_url + 'wp/v2/posts/',
      data: {
        title: $('#quote-author').val(),
        content: $('#quote-content').val(),
        _qod_quote_source: $('#quote-source').val(),
        _qod_quote_source_url: $('#quote-source-url').val(),
        status: 'pending'
      },
      beforeSend: function(xhr) {
        xhr.setRequestHeader( 'X-WP-Nonce', api_vars.nonce );
     }
    })
    .done(function(){
      $('#quote-submission-form').slideUp('slow');
      $('.quote-submission-wrapper').append('<p>'+api_vars.success+'</p>');
    })
    .fail(function(){
      $('#quote-submission-form').append('<p>'+api_vars.failure+'</p>');
    })
   });

   
  $(window).on('popstate', function(){
    window.location.replace(lastPage);
  });


})(jQuery);
