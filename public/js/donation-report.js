
$('#show-payment-report').on('click',function () {

    if($('#date_from').val()=='')
    {
        $('#date_from_error').text("Select date from!")
    }else if($('#date_to').val()=='')
    {
        $('#date_to_error').text("Select date to!")
    }else {

        var form = $("#payment_report_form");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            data: form.serialize(),
            url: "/donation/report",
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