(function($) {
  'use strict';

  // remove this body append code, just for initial test
  $('body').append('js file is working');

  /**
   * Ajax-based random post fetching & History API
   */

  var lastPage = '';

$('#new-quote-button').on('click', function(event){
  event.preventDefault();
  

  
  
  //write ajax for get request

  $.ajax({
    method: 'GET',
    url: api_vars.root_url + 'wp/v2/posts?filter[orderby]=rand&filter[posts_per_page]=1',
    cache: false
  }).done(function(data){
    console.log(data);
  
    $('.entry-content').html(data[0].content.rendered);

    if (data[0]._qod_quote_source !== "" && data[0]._qod_quote_source_url !== "" ){
      $('.entry-title').html('&mdash;'+ data[0].title.rendered + ',  '); 
      $('.source').html('<a href="'+ data[0]._qod_quote_source_url + '" alt="Quote Source">' + data[0]._qod_quote_source + '</a>');
    console.log('I have a source and source has link');
    }


    else if (data[0]._qod_quote_source !== "" ){
      $('.entry-title').html('&mdash;'+ data[0].title.rendered + ',  '); 
      $('.source').html(data[0]._qod_quote_source);
      console.log('source with no lnk');
    }else {
      console.log('I HAVE NO SOURCe AND I AM EmPTY');
      $('.entry-title').html('&mdash;'+ data[0].title.rendered);
      $('.source').empty();
      console.log('itsjust me');
    } 

  

    lastPage=document.URL;
    console.log(lastPage);

    history.pushState(null, null, data[0].slug);

  //ajax get request, try looking for the wp slug
    
 
 
  }).fail(function(){
    //some message saying there was an error - recommended append
  });
});

  /**
   * Ajax-based front-end post submissions.  take a look at the javascript slides for post request - also look @ redpsrout
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
        status: 'publish'
      },
      beforeSend: function(xhr) {
        xhr.setRequestHeader( 'X-WP-Nonce', api_vars.nonce );
     }
    })
    .done(function(){
      console.log('great');
      $('#quote-submission-form').slideUp('slow');
      $('.quote-submission-wrapper').append('Thanks for your submission!');
    })

    //form should disappear after submission successful

   });

   
  $(window).on("popstate", function(){
    window.location.replace(lastPage);
    console.log('im going back in tiem');
  });

 

   
  

})(jQuery);
