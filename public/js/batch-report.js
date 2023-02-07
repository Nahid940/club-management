
$('#show-payment-report').on('click',function () {
    if($('#passing_year').val()=='')
    {
        $('.lbl_passing_year').css('color','red')
    }else
    {
        var form = $("#report_form");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            data: form.serialize(),
            url:"/batch-wise-report",
            beforeSend: function() {
                $('.loading').html('<i class="fas fa-spinner fa-pulse"></i>')
            },
            success:function (res) {
                $('.loading').html('');
                $('#report_area').html(res.html)
            }
        })
    }
});