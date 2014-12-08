$(function() {
  
  _TCAFE_.Menu = {};
  _TCAFE_.Menu.menu_is_open = false;
  _TCAFE_.Menu.$menu_wrapper = $('.menu-wrapper');
  _TCAFE_.Menu.$menu_btn = _TCAFE_.Menu.$menu_wrapper.find('.menu-btn');
  
  _TCAFE_.Menu.menuOpener = function() {
    if (_TCAFE_.Menu.menu_is_open) {
      _TCAFE_.Menu.$menu_wrapper.addClass('open');
    } else {
      _TCAFE_.Menu.$menu_wrapper.removeClass('open');
    };
  };
  
  $('html').on('click', _TCAFE_.Menu.$menu_btn, function(){
    _TCAFE_.Menu.menu_is_open = !_TCAFE_.Menu.menu_is_open;
    _TCAFE_.Menu.menuOpener();
  });
  
  $('html').click(function(e){
    if (!$(e.target).closest('.menu-wrapper').size()) {
      _TCAFE_.Menu.menu_is_open = false;
      _TCAFE_.Menu.menuOpener();
    };
  });
  
});