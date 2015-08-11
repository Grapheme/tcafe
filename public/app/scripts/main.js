window._TCAFE_ = {};

function _log(msg) {
  console.log(msg);
};

_TCAFE_.setYear = function(){
  var now = new Date();
  var year = now.getFullYear();
  $('#footer .year').text(year);
}

$(function() {
  _TCAFE_.setYear();
  
  var $restNav = $('.rest-nav')
  
  if ($('.rest-nav').size()) {
    $restNav.find('.unit-wrapper').each(function(index){
      var $wrapper = $(this);
      var $units = $(this).find('.unit');
      var count = $units.size();
      var curent = 0;
      var delay = 5 * 1000;
      var _index = index
      
      $units.eq(0).addClass('active');
      if (count>1) {
        setInterval(function(){
          curent += 1
          if (curent > (count-1)) {
            curent = 0
          }
          if ($units.eq(curent).height()>$($wrapper).height()) {
            $($wrapper).height($units.eq(curent).height());
          }
          $units.removeClass('active');
          $units.eq(curent).addClass('active');
        }, delay + (_index * 100));
      } else {
        $(this).addClass('relative');
      }
    });
  }
  
  $('body.about > .content > .holder > .wrapper').each(function(){
    var _h = $(this).height();
    _log(_h)
    $(this).find('.unit').height(_h-100);
  });
  
  var url_arr = document.referrer.split('/');
  var exclude_arr = [
    '',
    'cafe'
  ]
  
  isInArray = function(array, element){
    if (array.indexOf(element)>=0){
      return true
    };
    return false
  }
  
  if (url_arr.length>3) {
    if (url_arr[3]=='cafe' && !isInArray(exclude_arr,location.href.split('/')[3])) {
      $('.back-url-wrapper').show();
    };
  };
  
  $('.back-url-wrapper a').click(function(e){
    e.preventDefault();
    window.history.back();
  });
  
  
  lightbox.start($('.fs-baner'))
  
  /*$('.fs-baner .close').click(function(e){
    e.preventDefault();
    $('.fs-baner').fadeOut();
  });*/
  
  
  
});