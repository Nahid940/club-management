$('#show-payment-report').on('click',function () {
    if($('#profession').val()=='')
    {
        $('.txt_profession').text("Select Profession!")
    }else
    {
        var form = $("#report_form");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            data: form.serialize(),
            url:"/profession-report-report",
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