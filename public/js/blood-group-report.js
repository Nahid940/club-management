$('#show-payment-report').on('click',function () {
    if($('#blood_group').val()=='')
    {
        $('.tst_blood_group').text("Select Blood Group!")
    }else
    {
        var form = $("#report_form");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            data: form.serialize(),
            url:"/blood-group-report/",
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