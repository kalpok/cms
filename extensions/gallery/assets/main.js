$().ready(function(){
    $(document).on('click', 'a.ajaxcreate, .ajaxupdate', function(event){
        event.preventDefault();
        $('div.image-form').slideUp(300);
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            dataType: 'json',
            success: function(data) {
                $('div.image-form').html(data.content).slideDown(500);
            }
        });
    });
    $(document).on('submit', 'form.gallery-image', function(event){
        event.preventDefault();
        $('.image-form button.submit').attr('disabled','disabled');
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            dataType: 'json',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            async: false
        }).done(function( data ) {
            if (data.status == 'success') {
                $('div.image-form').slideUp(500);
                refreshGrid();
            } else {
                $('div.image-form').html(data.content);
                $('.image-form button.submit').removeAttr('disabled');
            }
        });
    });
    $(document).on('click', 'a.ajaxdelete', function(event){
        event.preventDefault();
        if (confirm($(this).attr('data-confirmmsg'))) {
            $.ajax({
                url: $(this).attr('href'),
                type: 'post',
                dataType: 'json'
            }).done(function( data ) {
                refreshGrid();
            });
        };
    });
    function refreshGrid() {
        idOfPjax = $('a.ajaxcreate').attr('data-gridpjaxid');
        $.pjax.reload({container:'#'+idOfPjax});
    }
});
