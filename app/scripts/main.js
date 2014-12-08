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
});