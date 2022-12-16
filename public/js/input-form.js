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
            title: 'Do you want to submit this form?',
            text: "You will be notified when application approved.",
            icon: 'warning',
            color:'green',
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

imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        sample_img.src = URL.createObjectURL(file)
    }
}


let step=0;
$("#next").click(function(){
    step++;
    if(step==1)
    {
        $('#step_1').addClass('hidden')
        $('#step_2').removeClass('hidden')

        $('#second_step').css({'color':'#41ff40'})
        $('.circle2').css({'background':'#41ff40'})
        $('.line1').css('background','#41ff40')
    }

    $('#prev').removeClass('hidden')
    if(step==1)
    {
        $('#step_1').addClass('hidden')
        $('#step_2').removeClass('hidden')
        $('#next').addClass('hidden')
        $('#save').removeClass('hidden')
        $('#last_step').css({'color':'#41ff40'})
    }
    $('#form_step').val(step)
});

$("#prev").click(function(){
    $('#step_1').removeClass('hidden')
    if(step==1)
    {
        $('#prev').addClass('hidden')
        $('#step_2').addClass('hidden')
        $('#second_step').css({'color':'#6c757d'})
        $('.circle2').css({'background':'#6c757d'})
        $('.line1').css('background','#6c757d')
        $('#next').removeClass('hidden')
        $('#save').addClass('hidden')
    }
    if(step==0)
    {
        $('#step_1').removeClass('hidden')
        $('#step_2').addClass('hidden')
        $('#next').removeClass('hidden')
        $('#save').addClass('hidden')

        $('#last_step').css({'color':'#6c757d'})
        $('.circle3').css({'background':'#6c757d'})
        $('.line2').css('background','#6c757d')
    }
    step--;
    $('#form_step').val(step)
});