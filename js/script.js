
(function($) {
    $(document).ready(function(){
   $("#countDown")
  .countdown($("#countDown").data('dat'), function(event) {
    $(this).text(
      event.strftime('%D Jour(s) %H:%M:%S')
    );
  }); 
 
 var offset = 220;
    var duration = 500;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-top').fadeIn(duration);
        } else {
            $('.back-top').fadeOut(duration);
        }
    });
    $('.back-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

        
        // cart
        $('.box-item').click(function(){
            var box = this;
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                  action : "getProduct",
                  p : $(box).data('id'), 
                  post_type: $(box).data('post_type')
                },
                success: function (data) {
                     data = JSON.parse(data);
                    $('#product-modal .modal-title').html(data.title);
                    $('#product-modal .content p').html(data.content);
                    $('#product-modal .image img').attr('src',data.image);
                    $('#product-modal .value .calendrier img').attr('src',data.calendrier);
                    $('#product-modal .value .varite span').html(data.varite);
                    $('#product-modal .value .origine span').html(data.origine);
                    $('#product-modal .value .calibres span').html(data.calibres);
                    $('#product-modal').modal();   
                },
                error: function (xhr, ajaxOptions, thrownError) {
                      console.log(xhr.status);
                      console.log(xhr.responseText);
                      console.log(thrownError);
                  },
                  beforeSend : function(){
                      //alert('salut');
                  },
                  complete : function(){
                      //alert('fin');
                  }
              });
            
        });
        


});



})(jQuery);
