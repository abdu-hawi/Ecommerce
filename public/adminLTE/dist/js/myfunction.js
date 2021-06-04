function check_all() {
    //item_checkbox
    $('input[class="item_checkbox"]:checkbox').each(function(){
        if( $('input[class="check-all"]:checkbox:checked').length === 0 ){
            $('input[class="item_checkbox"]:checkbox').prop('checked',false)
        }else{
            $('input[class="item_checkbox"]:checkbox').prop('checked',true)
        }
    });
}

function deleteAll() {
    $(document).on('click','.delete-all',function () {
        $('#form_delete').append($('input[class="item_checkbox"]:checkbox').filter(':checked'));
        $('#form_delete').submit();
    });

    $(document).on('click','.del-btn',function () {
        let item_checked = $('input[class="item_checkbox"]:checkbox').filter(':checked').length;
        $('.records').text('');
        if(item_checked > 0){
            $('.records').text(' '+item_checked+" ");
            $('.not_empty_records').removeClass('d-none');
            $('.empty_records').addClass('d-none');
        }else{
            $('.not_empty_records').addClass('d-none');
            $('.empty_records').removeClass('d-none');
        }

        $('#multi_delete').modal('show');
    });
}

function delete_admin() {

}
