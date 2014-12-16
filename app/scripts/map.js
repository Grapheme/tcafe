$(function() {
  _TCAFE_.$contacts_map = $('.contacts-map');
  _TCAFE_.contacts_map_json_url = 'json/map.json'
  _TCAFE_.contacts_map_start_pos = new google.maps.LatLng(50, 50)
  _TCAFE_.contacts_btn=[]
  
  _TCAFE_.$contacts_map.gmap({
    
    }).bind('init', function(event, map) {
    $.getJSON(_TCAFE_.contacts_map_json_url, function(data) {
      $.each(data.markers, function(i, marker) {
        var _marker_ = _TCAFE_.$contacts_map.gmap('addMarker', { 
          'position': new google.maps.LatLng(marker.latitude, marker.longitude), 
          'bounds': true 
        }).click(function() {
          _TCAFE_.$contacts_map.gmap('openInfoWindow', {
            'content': marker.content,
          }, this);
          $('.top-btns a').removeClass('active');
          $('.top-btns a').eq(i).addClass('active');
        })[0];
        $('<a href="">'+marker.title+'</a><div class="bar"></div>').appendTo('.top-btns').click(function(e){
          e.preventDefault();
          if (!$(this).is('.active')) {
            $('.top-btns a').removeClass('active');
            $(this).addClass('active');
            google.maps.event.trigger(_marker_,'click');
          }
        })
      });
      //_TCAFE_.$contacts_map.gmap('get','map').setOptions({'center':_TCAFE_.contacts_map_start_pos});
    });
  });
  
});