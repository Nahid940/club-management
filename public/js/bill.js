

$("body").on("click", ".listitem", function () {
    let name=$(this).data('name');
    let id=$(this).data('id');
    $('#member_search').val(name);
    $('#member_id').val(id);
    $('.suggestion-area').addClass('hidden_area');
    $('.suggestion-area').html();
});

$('.save_btn').on('click',function(){
    if($('.guest_bill').is(":checked"))
    {
        if($('.member_search').val()=='')
        {
            $('#search_title').css('color','red');
            Swal.fire('Guest name required!');
        }
        else if($('#lounge_amount').val()==0 && $('#restaurant_amount').val()==0)
        {
            Swal.fire('Invalid payment amount!');
        }
        else if(!$('.payment_type').is(":checked"))
        {
            $('.lbl_payment_type').css('color','red');
            Swal.fire('Select payment method!');
        }
        else
        {
            Swal.fire({
                title: 'Do you want to save this data?',
                text: "Click on Yes to proceed",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.save_btn').attr('disabled','disabled')
                    $('#form_submit').submit();
                }
            })
        }

    }else
    {
        if($('#member_id').val()=='' || $('#member_id').val()=='0')
        {
            $('#search_title').css('color','red');
            Swal.fire('Select a Member!');
        }
        else if($('#lounge_amount').val()==0 && $('#restaurant_amount').val()==0)
        {
            Swal.fire('Invalid payment amount!');
        }
        else if(!$('.payment_type').is(":checked"))
        {
            $('.lbl_payment_type').css('color','red');
            Swal.fire('Select payment method!');
        }
        else
        {
            Swal.fire({
                title: 'Do you want to save this data?',
                text: "Click on Yes to proceed",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.save_btn').attr('disabled','disabled')
                    $('#form_submit').submit();
                }
            })
        }
    }
})

$('.add_purpose').on('click',function(){
    $('#purpose_div').removeClass('hidden_area')
    $('.close_purpose').removeClass('hidden_area')
    $('.add_purpose').addClass('hidden_area')
});

$('.close_purpose').on('click',function(){
    $('#purpose_div').addClass('hidden_area')
    $('.close_purpose').addClass('hidden_area')
    $('.add_purpose').removeClass('hidden_area')
});


let total=0;
$('#lounge_amount').on('keyup',function () {
   let amount=$(this).val()==''?0:$(this).val();
   $('#lounge_bill_amnt').text(amount);
   total=parseFloat($('#restaurant_amount').val()==''?0:$('#restaurant_amount').val())+parseFloat($('#lounge_amount').val()==''?0:$('#lounge_amount').val());
    $('#ttl_amnt').text(total);
});

$('#restaurant_amount').on('keyup',function () {
    let amount=$(this).val()==''?0:$(this).val();
    $('#restaurant_bill_amnt').text(amount);
    total=parseFloat($('#restaurant_amount').val()==''?0:$('#restaurant_amount').val())+parseFloat($('#lounge_amount').val()==''?0:$('#lounge_amount').val());
    $('#ttl_amnt').text(total);
});