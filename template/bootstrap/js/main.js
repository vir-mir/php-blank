/**
 * Created by vir-mir on 20.11.13.
 */

var error = {
    fio: 'Заполните поле ФИО!',
    adress: 'Заполните поле Адрес!',
    sex: 'Не выбран пол!',
    email: 'Неправильно заполненно поле E-mail!'
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

var validateForm = function() {
    //валидация формы
    //все поля формы являются обязательными для заполнения
    //...

    var errors = [];

    if ($.trim($('#fio').val())=='') {
        errors.push(error.fio);
    }
    if (!$('input[name=sex]:checked').val()) {
        errors.push(error.sex);
    }
    if ($.trim($('#adress').val())=='') {
        errors.push(error.adress);
    }
    if (!isEmail($.trim($('#email').val()))) {
        errors.push(error.email);
    }

    var valid = !(errors.length > 0);

    if (!valid) {
        $('#insert_result').html('');
        $('#insert_result').removeClass('hidden');
        $('#insert_result').addClass('alert-danger');
        $.each(errors, function (k,v) {
            $('#insert_result').append('<p>'+v+'</p>');
        });
    }

    return valid;
};

var sendForm = function() {
    if (validateForm()) {
        $('#insert_result').addClass('hidden');
        $('#insert_result').removeClass('alert-danger');
        $('#insert_result').html('');
        //отправление данных формы, используя AJAX методом POST
        //...
        var btn = $('input[type=submit]');
        btn.attr('disabled', true);
        $.post('/?q=user,add', $('#user').serialize(), function (data) {
            if (data.errors) {
                $.each(data.errors, function (k,v) {
                    $('#insert_result').removeClass('hidden');
                    $('#insert_result').addClass('alert-danger');
                    $('#insert_result').append('<p>'+v+'</p>');
                });
            } else if (data.mss) {
                $.each(data.mss, function (k,v) {
                    $('#insert_result').removeClass('hidden');
                    $('#insert_result').addClass('alert-success');
                    $('#insert_result').append('<p>'+v+'</p>');
                });
                $('#fio').val('');
                $('#adress').val('');
                $('#email').val('');
                $('input[name=sex]:checked').parent().removeClass('active');
                $('input[name=sex]:checked').attr('checked', false);
            }
            btn.attr('disabled', false);
        }, 'json');
    }

    return false;
};
