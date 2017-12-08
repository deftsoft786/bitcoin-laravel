(function($){
    
    $("#login").click(function(){
    $(".login").fadeIn();
    $('body').css('overflow', 'hidden');
       });
    
    $("#signup").click(function(){
    $(".signup").fadeIn();
    $('body').css('overflow', 'hidden');
  
       });
    
    $(".overlay-click").click(function(e){
    $(".light-box").fadeOut();
    $('body').css('overflow', 'auto');
 
  });
})(jQuery);
