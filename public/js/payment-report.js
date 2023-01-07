
$('#show-payment-report').on('click',function () {
    var form = $("#payment_report_form");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"post",
        data: form.serialize(),
        url:"/payments/report",
        success:function (res) {
            $('#report_area').html(res.html)
        }
    })

});