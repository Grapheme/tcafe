$(function() {
  
  function _log(msg) {
    console.log(msg);
  };
  
  $('.menu-wrapper .menu-btn').on('click', function(){
    $(this).closest('.menu-wrapper').toggleClass('open');
  });
  
});