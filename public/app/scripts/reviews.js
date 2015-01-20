$(function() {
  
  $('.unit.form-holder .title-wrapper').click(function(){
    $('.unit.form-holder').addClass('open');
    $('.unit.form-holder').find('form').slideDown();
  });
  
  $("form.review-form").validate({
    rules: {
      name: 'required',
      email: {
        required: true,
        email: true
      },
      review: 'required'
    },
    messages: {
      name: 'Обязательное поле',
      email: {
        required: 'Обязательное поле',
        email: 'Неверный формат. Попробуйте еще'
      },
      review: 'Обязательное поле'
    },
    submitHandler: function(form) {
      var _url = $(form).attr('action'),
          _data = $(form).serialize(),
          _method = $(form).attr('method')||'POST';
      $.ajax({
        type: _method,
        url: _url,
        data: _data,
        success: function(data) {
          $('.unit.form-holder .final').fadeIn();
        }
      })
    }
  });
  
  $("form.contacts-form").validate({
    rules: {
      name: 'required',
      email: {
        required: true,
        email: true
      },
      message: 'required'
    },
    messages: {
      name: 'Обязательное поле',
      email: {
        required: 'Обязательное поле',
        email: 'Неверный формат. Попробуйте еще'
      },
      message: 'Обязательное поле'
    },
    submitHandler: function(form) {
      var _url = $(form).attr('action'),
          _data = $(form).serialize(),
          _method = $(form).attr('method')||'POST',
          $form = $(form);
      $.ajax({
        type: _method,
        url: _url,
        data: _data,
        success: function(data) {
          $('.unit.form-holder .final').fadeIn();
          $form.blur();
          $form.find('button').blur();
        }
      })
    }
  });

});