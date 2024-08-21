$(document).on('click', '#btn', function () {
  const num = $(this).attr('data-num');
  $('.info').removeClass('content')
  $('.profile-links button').removeClass('active')
  $('#block' + num).addClass('content')
  $('.btn' + num).addClass('active')
});

$('.password-form-content input').focus(function () {
  $('.password_form .submit_btn').css('display', 'block');
});
