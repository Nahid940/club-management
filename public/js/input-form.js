$('.ever_declined1').on('click',function(){
    $('.ever_declined2').prop('checked',false);
})
$('.ever_declined2').on('click',function(){
    $('.ever_declined1').prop('checked',false);
})

$('.application_rejected1').on('click',function(){
    $('.application_rejected2').prop('checked',false);
})
$('.application_rejected2').on('click',function(){
    $('.application_rejected1').prop('checked',false);
})


$('.criminal_ofence1').on('click',function(){
    $('.criminal_ofence2').prop('checked',false);
})
$('.criminal_ofence2').on('click',function(){
    $('.criminal_ofence1').prop('checked',false);
})

$('.car_owned1').on('click',function(){
    $('.car_owned2').prop('checked',false);
})
$('.car_owned2').on('click',function(){
    $('.car_owned1').prop('checked',false);
})


$('#car_ownership_type1').on('click',function(){
    $('#car_ownership_type2').prop('checked',false);
    $('#car_ownership_type3').prop('checked',false);
})

$('#car_ownership_type2').on('click',function(){
    $('#car_ownership_type1').prop('checked',false);
    $('#car_ownership_type3').prop('checked',false);
})

$('#car_ownership_type3').on('click',function(){
    $('#car_ownership_type2').prop('checked',false);
    $('#car_ownership_type1').prop('checked',false);
})


$('#save').on('click',function () {



    if(!$('.member_type').is(":checked"))
    {
        $('.mem_type').css('color','red');
        Swal.fire('Type of membership required!',);
    }else if($('#registration_date').val()=="")
    {
        Swal.fire("Registration date required!!");
        $('.lbl_reg_date').css('color','red');
    }else if($('#registration_date').val()=="")
    {
        Swal.fire("Please select membership type!!");
        $('.lbl_reg_date').css('color','red');
    }else if($('#name').val()=="")
    {
        Swal.fire("Member name required!!");
        $('.lbl_mmbr_name').css('color','red');
    }else if($('#college_roll').val()=="")
    {
        Swal.fire("College roll required!!");
        $('.lbl_college_roll').css('color','red');
    }else if($('#date_of_birth').val()=="")
    {
        Swal.fire("Date of Birth required!!");
        $('.lbl_dob').css('color','red');
    }else if($('#nid').val()=="")
    {
        Swal.fire("NID required!!");
        $('.lbl_nid').css('color','red');
    }else if($('#fathers_name').val()=="")
    {
        Swal.fire("Father's name required!!");
        $('.lbl_fathers_name').css('color','red');
    }else if($('#mothers_name').val()=="")
    {
        Swal.fire("Mothers's name required!!");
        $('.lbl_mothers_name').css('color','red');
    }else if($('#mobile_number').val()=="")
    {
        Swal.fire("Mobile no. required!!");
        $('.lbl_mobile_no').css('color','red');
    }else if($('#email').val()=="")
    {
        Swal.fire("Email required!!")
        $('.lbl_email').css('color','red');
    }else if($('#present_address').val()=="")
    {
        Swal.fire("Present address required!!")
        $('.lbl_present_address').css('color','red');
    }else if($('#spouse_name').val()=="")
    {
        Swal.fire("Spouse name required!!")
        $('.lbl_spouse_name').css('color','red');
    }else if(!$('#accept').is(":checked"))
    {
        Swal.fire("Please read the terms & conditions and accept!!")
        $('.lbl_accept').css('color','red');
    }
    else
    {
        $('.mem_type').css('color','#4f4d50');
        $('.lbl_reg_date').css('color','#4f4d50');
        $('.lbl_mmbr_name').css('color','#4f4d50');
        $('.lbl_college_roll').css('color','#4f4d50');
        $('.lbl_dob').css('color','#4f4d50');
        $('.lbl_nid').css('color','#4f4d50');
        $('.lbl_fathers_name').css('color','#4f4d50');
        $('.lbl_mothers_name').css('color','#4f4d50');
        $('.lbl_mobile_no').css('color','#4f4d50');
        $('.lbl_email').css('color','#4f4d50');
        $('.lbl_present_address').css('color','#4f4d50');
        $('.lbl_spouse_name').css('color','#4f4d50');
        $('.lbl_accept').css('color','#4f4d50');


        Swal.fire({
            title: 'Are all the information correct?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#member_form').submit();
            }
        })
    }
})