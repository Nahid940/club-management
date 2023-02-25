

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
        else if($('#restaurant_cash_amount').val()==0 && $('#restaurant_card_amount').val()==0
            && $('#lounge_cash_amount').val()==0
            && $('#lounge_card_amount').val()==0
        )
        {
            Swal.fire('Invalid payment amount!');
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
                    $('.save_btn').attr('disabled','disabled');
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
                    $('.save_btn').attr('disabled','disabled');
                    $('#sv_btn').html('<p><i class="fas fa-spinner fa-pulse"></i> Processing...Please wait...!!</p>');
                    $('#form_submit').submit();
                }
            })
        }
    }
});

let total=0;
$('#lounge_cash_amount').on('keyup',function () {

   if($('#lounge_cash_amount').val().length>10)
   {
       $('#lounge_cash_amount').val('0');
   }
   let lounge_cash_amount=$('#lounge_cash_amount').val()==''?0:parseFloat($('#lounge_cash_amount').val());
   let lounge_card_amount=$('#lounge_card_amount').val()==''?0:parseFloat($('#lounge_card_amount').val());
    $('#lounge_bill_amnt').text(lounge_cash_amount+lounge_card_amount);

   let restaurant_cash_amount=$('#restaurant_cash_amount').val()==''?0:parseFloat($('#restaurant_cash_amount').val());
   let restaurant_card_amount=$('#restaurant_card_amount').val()==''?0:parseFloat($('#restaurant_card_amount').val());
    total=lounge_cash_amount+lounge_card_amount+restaurant_cash_amount+restaurant_card_amount;
    $('#ttl_amnt').text(total);
});

$('#lounge_card_amount').on('keyup',function () {

    if($('#lounge_card_amount').val().length>10)
    {
        $('#lounge_card_amount').val('0');
    }

    let lounge_cash_amount=$('#lounge_cash_amount').val()==''?0:parseFloat($('#lounge_cash_amount').val());
    let lounge_card_amount=$('#lounge_card_amount').val()==''?0:parseFloat($('#lounge_card_amount').val());
    $('#lounge_bill_amnt').text(lounge_cash_amount+lounge_card_amount);

    let restaurant_cash_amount=$('#restaurant_cash_amount').val()==''?0:parseFloat($('#restaurant_cash_amount').val());
    let restaurant_card_amount=$('#restaurant_card_amount').val()==''?0:parseFloat($('#restaurant_card_amount').val());
    total=lounge_cash_amount+lounge_card_amount+restaurant_cash_amount+restaurant_card_amount;
    $('#ttl_amnt').text(total);
});


$('#restaurant_cash_amount').on('keyup',function () {
    if($('#restaurant_cash_amount').val().length>10)
    {
        $('#restaurant_cash_amount').val('0');
    }
    let lounge_cash_amount=$('#lounge_cash_amount').val()==''?0:parseFloat($('#lounge_cash_amount').val());
    let lounge_card_amount=$('#lounge_card_amount').val()==''?0:parseFloat($('#lounge_card_amount').val());

    let restaurant_cash_amount=$('#restaurant_cash_amount').val()==''?0:parseFloat($('#restaurant_cash_amount').val());
    let restaurant_card_amount=$('#restaurant_card_amount').val()==''?0:parseFloat($('#restaurant_card_amount').val());
    $('#restaurant_bill_amnt').text(restaurant_cash_amount+restaurant_card_amount);
    total=lounge_cash_amount+lounge_card_amount+restaurant_cash_amount+restaurant_card_amount;
    $('#ttl_amnt').text(total);
});

$('#restaurant_card_amount').on('keyup',function () {
    if($('#restaurant_card_amount').val().length>10)
    {
        $('#restaurant_card_amount').val('0');
    }
    let lounge_cash_amount=$('#lounge_cash_amount').val()==''?0:parseFloat($('#lounge_cash_amount').val());
    let lounge_card_amount=$('#lounge_card_amount').val()==''?0:parseFloat($('#lounge_card_amount').val());

    let restaurant_cash_amount=$('#restaurant_cash_amount').val()==''?0:parseFloat($('#restaurant_cash_amount').val());
    let restaurant_card_amount=$('#restaurant_card_amount').val()==''?0:parseFloat($('#restaurant_card_amount').val());
    $('#restaurant_bill_amnt').text(restaurant_cash_amount+restaurant_card_amount);
    total=lounge_cash_amount+lounge_card_amount+restaurant_cash_amount+restaurant_card_amount;
    $('#ttl_amnt').text(total);
});
