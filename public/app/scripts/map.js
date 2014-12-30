$(function() {
  _TCAFE_.$contacts_map = $('.contacts-map');
  _TCAFE_.contacts_map_json_url = 'json/map.json'
  _TCAFE_.contacts_map_start_pos = new google.maps.LatLng(50, 50)
  _TCAFE_.contacts_btn=[]
  _TCAFE_.gmap_marker = {
    url: '/dist/images/ico-point-w-shadow.svg',
    //size: new google.maps.Size(34, 48),
    anchor: new google.maps.Point(18, 50)
  };
  _TCAFE_.$contacts_map.gmap({
    styles:[
		{ 
		  featureType: "poi", 
		  elementType: "labels", 
		  stylers: [ { visibility: "off" } ]
		}
	  ]
    }).bind('init', function(event, map) {
	  /*var ecaped_json = _TCAFE_.mapJson.replace(/[\n]/g, '')
									  .replace(/[\r]/g, '')
									  .replace(/[\t]/g, '');
	  var data = $.parseJSON(ecaped_json);*/
	  
      //$.each(data.markers, function(i, marker) {
      $.each(_TCAFE_.mapJsonNative.markers, function(i, marker) {
        var _marker_ = _TCAFE_.$contacts_map.gmap('addMarker', { 
          'position': new google.maps.LatLng(parseFloat(marker.latitude), parseFloat(marker.longitude)), 
          'bounds': true,
          'icon': _TCAFE_.gmap_marker,
          '_id': i
        }).click(function() {
          $('.top-btns a').removeClass('active');
          $('.top-btns a').eq(i).addClass('active');
        })[0];
        
        var boxText = $('<div class="address"> \
                          <div class="wrapper"> \
                            <div class="title-wrapper"> \
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" preserveAspectRatio="none" x="0px" y="0px" width="35px" height="50px" viewBox="0 0 35 50"> \
                                <g id="Layer4_0_FILL"> \
                                  <defs> \
                                    <path fill="" stroke="none" d=" M 234 171.6 Q 235.05 173.95 236.65 176.05 L 256.25 208.95 256.5 209.9 276.95 175.65 Q 278.25 173.85 279.15 171.9 281.35 167.25 281.35 161.65 281.35 151.5 274.1 144.4 266.85 137.25 256.65 137.25 246.4 137.25 239.15 144.4 231.95 151.5 231.95 161.65 231.95 167.05 234 171.6 M 257 176.8 Q 250.9 176.8 246.55 172.5 242.3 168.2 242.3 162.1 242.3 155.95 246.55 151.65 250.9 147.35 257 147.35 263.15 147.35 267.4 151.65 271.75 155.95 271.75 162.1 271.75 168.2 267.4 172.5 263.15 176.8 257 176.8 Z"></path> \
                                </g> \
                                <g id="Layer3_0_FILL"> \
                                  <path fill="" stroke="none" d=" M 24.45 13.9 L 21.35 13.9 21.35 16.15 24.45 16.15 24.45 13.9 Z"></path> \
                                </g> \
                                <g id="Layer2_0_FILL"> \
                                  <path fill="" stroke="none" d=" M 32.5 24.15 Q 34 21.05 34 17.3 34 10.55 29.15 5.8 24.3 1 17.5 1 10.65 1 5.8 5.8 1 10.55 1 17.3 1 20.9 2.35 23.95 3.05 25.55 4.1 26.95 L 17.2 48.9 31.05 26.65 Q 31.9 25.45 32.5 24.15 M 26.6 15.4 L 24.45 15.4 24.45 13.9 19.05 13.9 19.05 24.7 21.05 24.7 21.05 26.55 14.4 26.55 14.4 24.7 16.3 24.7 16.3 13.9 11.15 13.9 11.15 15.4 8.95 15.4 8.95 11.15 26.6 11.15 26.6 15.4 Z"></path> \
                                </g> \
                                </defs> \
                                <g transform="matrix( 1, 0, 0, 1, 0,0) "> \
                                  <use xlink:href="#Layer4_0_FILL"></use> \
                                </g> \
                                <g transform="matrix( 1, 0, 0, 1, 0,0) "> \
                                  <use xlink:href="#Layer3_0_FILL"></use> \
                                </g> \
                                <g transform="matrix( 1, 0, 0, 1, 0,0) "> \
                                  <use xlink:href="#Layer2_0_FILL"></use> \
                                </g> \
                              </svg> \
                              <div class="title">'+marker.address+'</div> \
                            </div> \
                            <div class="text">'+marker.content+'</div> \
                          </div> \
                        </div>')[0]
        var myOptions = {
			 content: boxText
			,disableAutoPan: false
			,maxWidth: 0
			,pixelOffset: new google.maps.Size(-56, -77)
			,zIndex: null
            ,boxClass: 'contacts-info-box'
			,closeBoxURL: "/dist/images/ico-point.svg"
			,infoBoxClearance: new google.maps.Size(20, 20)
			,isHidden: false
			,pane: "floatPane"
			,enableEventPropagation: false
		};
        
        google.maps.event.addListener(_marker_, "click", function (e) {
          $('.contacts-info-box').children('img').trigger('click');
		  ib.open(_TCAFE_.$contacts_map.gmap('get','map'), this);
          $('.top-btns a').eq(_marker_._id).addClass('active');
		});
        
        var ib = new InfoBox(myOptions);
        
        google.maps.event.addListener(ib, "closeclick", function (e) {
          $('.top-btns a').removeClass('active');
          //alert('123')
		});
        
        $('<a href="" class="'+marker.slug+'">'+marker.title+'</a><div class="bar"></div>').appendTo('.top-btns').click(function(e){
          e.preventDefault();
          if (!$(this).is('.active')) {
            $('.top-btns a').removeClass('active');
            google.maps.event.trigger(_marker_,'click');
            $(this).addClass('active');
          }
        }).data('marker', _marker_)
        
      });
	  var hash = window.location.hash || null;
	  if(hash) {
		var cl = hash.split('#')[1];
		$('.top-btns a.'+cl).trigger('click');
	  }
  });
  
});