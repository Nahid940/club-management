
$('#show-monthly-fee-report').on('click',function () {

    if($('#month_duration').val()=='')
    {
        $('#date_from_error').text("Select date from!")
    }else {

        var form = $("#report_form");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            data: form.serialize(),
            url: "/duration-wsie-due",
            beforeSend: function () {
                $('.loading').html('<i class="fas fa-spinner fa-pulse"></i>')
            },
            success: function (res) {
                $('.loading').html('');
                $('#report_area').html(res.html)
            }
        })
    }
});