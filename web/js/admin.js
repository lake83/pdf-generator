// Редактирование и создание настроек
$('body').on('beforeSubmit', '#paramForm, #createSettingForm', function () {
    var form = $(this);
    if (form.find('.has-error').length) {
        return false;
    }
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(data){ 
            if (form.attr('id') == 'paramForm') {
                if (data.name == 'skin') {
                    location.reload();
                } else {
                    $('#modalContent').html(data.message);$('#' + data.name).text(data.value);
                }
            } else {
                $('#modalContent').html(data);
            } 
        }
    });
    return false;
});
function settings(label,field,url){
    $.ajax({
       type: 'POST',
       cache: false,
       url: url,
       data: {field: field},
       success: function(data) {
           $('#modalContent').html(data);
           $('#modal').modal('show').find('#modalTitle').text(label);
       }
    });
}
function createSetting(title,url){
    $.ajax({
       type: 'POST',
       cache: false,
       url: url,
       success: function(data) {
           $('#modalContent').html(data);
           $('#modal').modal('show').find('#modalTitle').text(title);
       }
    });
}

// вывод диалога confirm в стиле bootstrap
yii.confirm = function (message, ok, cancel) {
    krajeeDialog.confirm(message, function (confirmed) {
        if (confirmed) {
            !ok || ok();
        } else {
            !cancel || cancel();
        }
    });
    return false;
}

// Обновление datepicker на поле created_at после окончания pjax
if ($('input[id$="created_at"]').length) {
    $(document).on('pjax:success', function() {
        $('input[id$="created_at"]').datepicker($.extend({}, $.datepicker.regional['ru'], {"dateFormat":"dd.mm.yy"}));
    });
}