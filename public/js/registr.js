const regBody = $('body');
const regPasswordInput = $('#password');
const regRePasswordInput = $('#password-confirmation');

regBody.on('click', '.password-control', function () {
  if (regPasswordInput.attr('type') === 'password') {
    $(this).addClass('view');
    regPasswordInput.attr('type', 'text');
  } else {
    $(this).removeClass('view');
    regPasswordInput.attr('type', 'password');
  }
});

regBody.on('click', '.repassword-control', function () {
    if (regRePasswordInput.attr('type') === 'password') {
        $(this).addClass('check');
        regRePasswordInput.attr('type', 'text');
    } else {
        $(this).removeClass('check');
        regRePasswordInput.attr('type', 'password');
    }
});
