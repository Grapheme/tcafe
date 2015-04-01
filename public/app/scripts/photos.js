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
  //$unit.slice(0 , unit_amount_x*unit_amount_y).removeClass('hidden');
  //$unit.slice((unit_amount_x*unit_amount_y)).addClass('hidden');
}

function photoSlider(data) {
  _log(data)
  var $slider = $('.popup-slider-wrapper'),
      $close = $('.popup-slider-wrapper .close'),
      $thumb_list = $slider.find('.thumbs .holder'),
      $thumb_wrapper = $slider.find('.thumbs-wrapper')
      $visual = $slider.find('.visual'),
      $title = $slider.find('.title'),
      $frame = $slider.find('.frame'),
      $next = $slider.find('.next'),
      $prev = $slider.find('.prev'),
      $video = null;

  function photoSliderLoader(p_list) {
    
    $slider.removeClass('video').fadeIn();
      p_list.forEach(function(element, index) {
        var $_this = $('<div class="img" style="background-image:url('+element.thumb+');">').insertBefore($thumb_list.find('.clrfx'));
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
  
  function videoLoader(data) {
    $slider.addClass('video').fadeIn();
    $('<img src="'+data['poster']+'">').load(function(){
      $('#video').attr('poster', data['poster']);
      $('#video').find('source').attr('src', data['video']);
      $video = $('<video poster="'+data['poster']+'" id="video"><source src="'+data['video']+'"></video>').appendTo($visual)
      $visual.fadeIn(300, function(){
        $video.get(0).play();
      });
      $video.click(function() {
        if (this.paused == false) {
            this.pause();
        } else {
            this.play();
        }
      });
    });
  };
  
  if (data['type']=="photo") {
    var p_list = data['photo-list'];
    photoSliderLoader(p_list);
  };
  if (data['type']=="video") {
    videoLoader(data);
  };
  
  $thumb_list.find('.img').click(function(){
    if (!$(this).is('.active')) {
      var img_pos = $(this).offset(),
          start_pos = $thumb_wrapper.offset(),
          img_path = $(this).data().img,
          title = $(this).data().title;
      $visual.fadeOut(300);
      $title.text(' ')
      $thumb_list.find('.img').removeClass('active');
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
      $thumb_list.find('.img').remove()
    });
    $next.add($prev).add($close).off('click');
    $video.remove();
  }
  
  $next.click(function(){
    $thumb_list.find('.active').next('.img').trigger('click');
  });
  $prev.click(function(){
    $thumb_list.find('.active').prev('.img').trigger('click');
  });
  $close.click(function(){
    photoSliderClose();
  });
  _log($thumb_list.find('.img.first'))
  $thumb_list.find('.img.first').click();
  $thumb_list.find('.img.first').trigger('click');
  
}

$(function() {
  photosResize();
  
  $('body.photos .content .unit').click(function(){
    var json_url = $(this).attr('data-json');
    $.getJSON(json_url, function(data){
      photoSlider(data);
    })
  });
  
  var hash = location.hash.split('#')
  if (hash.length>1) {
    hash = hash[1].split('-')
    if (hash[0]=='gallery') {
      var gal_id = hash[1];
      var json_url="/ajax/json-photoalbum-"+gal_id;
      $.getJSON(json_url, function(data){
        photoSlider(data);
      })
    }
  }
  
});

$(window).resize(function(){
  photosResize();
})