function photosResize() {
    var border_size = parseInt($('body.photos').css('border-width'))|10,
      window_width = $(window).width()-(2*border_size),
      window_height = $(window).height()-(2*border_size),
      $unit = $('body.photos .content .unit'),
      unit_min_width = parseInt($unit.css('min-width')),
      unit_min_height = parseInt($unit.css('min-height')),
      unit_amount_x = parseInt(window_width/unit_min_width),
      unit_amount_y = parseInt(window_height/unit_min_height),
      unit_width = window_width/unit_amount_x,
      unit_height = window_height/unit_amount_y;
  if (unit_amount_x==0) {
    unit_amount_x=1
  }
  if (unit_amount_y==0) {
    unit_amount_y=1
  }
  $unit.css({
    width: 100/unit_amount_x+"%"
  });
  $unit.height(unit_height)
  $unit.slice(0 , unit_amount_x*unit_amount_y).removeClass('hidden');
  $unit.slice((unit_amount_x*unit_amount_y)).addClass('hidden');
}

function photoSlider(p_list) {
  var $slider = $('.popup-slider-wrapper'),
      $close = $('.popup-slider-wrapper .close'),
      $thumb_list = $slider.find('.thumbs .holder'),
      $thumb_wrapper = $slider.find('.thumbs-wrapper')
      $visual = $slider.find('.visual'),
      $title = $slider.find('.title'),
      $frame = $slider.find('.frame'),
      $next = $slider.find('.next'),
      $prev = $slider.find('.prev');

  function photoSliderLoader(p_list) {
    $slider.fadeIn();
    p_list.forEach(function(element, index) {
      var $_this = $('<img src="'+element.thumb+'">').insertBefore($thumb_list.find('.clrfx'));
      $_this.data({
        img: element.img,
        title: element.title
      })
      if (index == 0) {
        $_this.addClass('first')
      }
      if (index == p_list.length-1) {
        $_this.addClass('last')
      }
    });
  }
  
  photoSliderLoader(p_list);
  
  $thumb_list.find('img').click(function(){
    if (!$(this).is('.active')) {
      var img_pos = $(this).offset(),
          start_pos = $thumb_wrapper.offset(),
          img_path = $(this).data().img,
          title = $(this).data().title;
      $visual.fadeOut(300);
      $title.text(' ')
      $thumb_list.find('img').removeClass('active');
      $(this).addClass('active');
      $('<img src="'+img_path+'">').load(function(){
        $visual.css({
          'background-image': 'url('+img_path+')',
        });
        $visual.fadeIn(300);
        $title.text(title)
      });
      var new_frame_pos = img_pos.left-start_pos.left
      $frame.css({
        'margin-left': new_frame_pos-3
      })
      if (new_frame_pos == 0 && !$(this).is('.first')) {
        $thumb_list.css({
          'margin-left': '+='+($thumb_wrapper.width()-$(this).width())
        })
        $frame.css({
        'margin-left': ($thumb_wrapper.width()-$(this).width()-3)
        })
      }
      if (new_frame_pos+$frame.width() >= $thumb_wrapper.width() && !$(this).is('.last')) {
        $frame.css({
          'margin-left': -3
        })
        $thumb_list.css({
          'margin-left': '-='+($thumb_wrapper.width()-$(this).width())
        })
      }
      
      if ($(this).is('.last')) {
        $next.fadeOut();
      } else {
        $next.fadeIn();
      }
      
      if ($(this).is('.first')) {
        $prev.fadeOut();
      } else {
        $prev.fadeIn();
      }
      
    };
  });
  
  function photoSliderClose() {
    $slider.fadeOut(300, function(){
      $visual.add($frame).add($thumb_list).attr('style', '');
      $thumb_list.find('img').remove()
    });
    $next.add($prev).add($close).off('click');
  }
  
  $next.click(function(){
    $thumb_list.find('.active').next('img').click();
  });
  $prev.click(function(){
    $thumb_list.find('.active').prev('img').click();
  });
  $close.click(function(){
    photoSliderClose();
  });
  $thumb_list.find('img').eq(0).click();
  
}

$(function() {
  photosResize();
  
  $('body.photos .content .unit').click(function(){
    var json_url = $(this).attr('data-json');
    $.getJSON(json_url, function(data){
      photoSlider(data);
    })
  });
  
});

$(window).resize(function(){
  photosResize();
})