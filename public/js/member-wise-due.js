
$('#show-payment-report').on('click',function () {
    var form = $("#report_form");
    let from_year=$('#from_year').val();
    let to_year=$('#to_year').val();

    if($('#member_id').val()=="")
    {
        $('.member_span').text('Select Member!');
    }
    else if(parseInt(from_year)>parseInt(to_year))
    {
        $('.from_year').text('Invalid Year selection!');
    }
    else if(parseInt(to_year)<parseInt(from_year))
    {
        $('.to_year').text('Invalid Year selection!');
    }
    else
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            data: form.serialize(),
            url:"/member-due-report",
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