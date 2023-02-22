
$('#show-payment-report').on('click',function () {
    var form = $("#report_form");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"post",
        data: form.serialize(),
        url:"/membership-due-report",
        beforeSend: function() {
            $('.loading').html('<i class="fas fa-spinner fa-pulse"></i>')
        },
        success:function (res) {
            $('.loading').html('');
            $('#report_area').html(res.html)
        }
    })
});