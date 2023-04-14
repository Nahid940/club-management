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

$('#present_addr1').on('click',function(){
    $('#prmnt_addr2').prop('checked',false);
})
$('#prmnt_addr2').on('click',function(){
    $('#present_addr1').prop('checked',false);
})

$('#criminal_ofence1').on('click',function(){
    $('#criminal_ofence2').prop('checked',false);
})
$('#criminal_ofence2').on('click',function(){
    $('#criminal_ofence1').prop('checked',false);
})


$('.criminal_ofence1').on('click',function(){
    $('.criminal_ofence2').prop('checked',false);
})
$('.criminal_ofence2').on('click',function(){
    $('.criminal_ofence1').prop('checked',false);
});

$('.car_owned1').on('click',function(){
    $('.car_owned2').prop('checked',false);
    $('#car_reg_no').removeAttr('readonly')

    $('#car_ownership_type1').attr('disabled',false);
    $('#car_ownership_type2').attr('disabled',false);
    $('#car_ownership_type3').attr('disabled',false);
});
$('.car_owned2').on('click',function(){
    $('.car_owned1').prop('checked',false);

    $('#car_reg_no').attr('readonly','readonly');
    $('#car_ownership_type1').prop('checked',false);
    $('#car_ownership_type2').prop('checked',false);
    $('#car_ownership_type3').prop('checked',false);

    $('#car_ownership_type1').attr('disabled',true);
    $('#car_ownership_type2').attr('disabled',true);
    $('#car_ownership_type3').attr('disabled',true);
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

$('#mem1').on('click',function(){
    $('#mem2').prop('checked',false);
    $('#mem3').prop('checked',false);
    $('#mem4').prop('checked',false);
    $('#mem5').prop('checked',false);
    $('#admission_fee').val($(this).data('admission-fee'))
})

$('#mem2').on('click',function(){
    $('#mem1').prop('checked',false);
    $('#mem3').prop('checked',false);
    $('#mem4').prop('checked',false);
    $('#mem5').prop('checked',false);
    $('#admission_fee').val($(this).data('admission-fee'))
})

$('#mem3').on('click',function(){
    $('#mem1').prop('checked',false);
    $('#mem2').prop('checked',false);
    $('#mem4').prop('checked',false);
    $('#mem5').prop('checked',false);
    $('#admission_fee').val($(this).data('admission-fee'))
})
$('#mem4').on('click',function(){
    $('#mem1').prop('checked',false);
    $('#mem2').prop('checked',false);
    $('#mem3').prop('checked',false);
    $('#mem5').prop('checked',false);
    $('#admission_fee').val($(this).data('admission-fee'))
});

$('#mem5').on('click',function(){
    $('#mem1').prop('checked',false);
    $('#mem2').prop('checked',false);
    $('#mem3').prop('checked',false);
    $('#mem4').prop('checked',false);
    $('#admission_fee').val($(this).data('admission-fee'))
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
    }
    // else if($('#college_roll').val()=="")
    // {
    //     Swal.fire("College roll required!!");
    //     $('.lbl_college_roll').css('color','red');
    // }
    else if($('#date_of_birth').val()=="")
    {
        Swal.fire("Date of Birth required!!");
        $('.lbl_dob').css('color','red');
    }else if($('#nid').val()=="" && $('#passport').val()=="" )
    {
        Swal.fire("NID or Passport is required!!");
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
    }else if($('#occupation').val()=="")
    {
        Swal.fire("Occupation required!!");
        $('.lbl_occupation').css('color','red');
    }
    else if($('#present_address').val()=="")
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
                $('#save').attr('disabled','disabled');
                $('#save_span').html('<i class="fas fa-spinner fa-pulse"></i> Precessing...');
                $('#member_form').submit();
            }
        })
    }
});

$('#update').on('click',function () {

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
    }
    // else if($('#college_roll').val()=="")
    // {
    //     Swal.fire("College roll required!!");
    //     $('.lbl_college_roll').css('color','red');
    // }
    else if($('#date_of_birth').val()=="")
    {
        Swal.fire("Date of Birth required!!");
        $('.lbl_dob').css('color','red');
    }else if($('#nid').val()=="" && $('#passport').val()=="" )
    {
        Swal.fire("NID or Passport is required!!");
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

        Swal.fire({
            title: 'Do you want to update your profile?',
            text: "Your current information will be updated",
            icon: 'info',
            color:'green',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#update').attr('disabled','disabled');
                $('#update_span').html('<i class="fas fa-spinner fa-pulse"></i> Updating...');
                $('#member_form').submit();
            }
        })
    }
})

imgInp.onchange = evt => {
    const [file] = imgInp.files;
    if (file) {
        sample_img.src = URL.createObjectURL(file)
    }
};




let step=0;
var size;


$("#next").click(function(){

    let is_edit=$('#edit').val();
    var fileUpload = document.getElementById("imgInp");
    // if(fileUpload.files[0]==undefined &&  is_edit!=1)
    // {
    //     Swal.fire('Member photo required!');
    // }
    // else
    if(fileUpload.files[0]!=undefined)
    {
        if(parseFloat(fileUpload.files[0].size / 1024).toFixed(2)>100)
        {
            Swal.fire('Photo size must be less than 100 kb!');
        }
    }
    else
    if(!$('.member_type').is(":checked"))
    {
        $('.mem_type').css('color','red');
        Swal.fire('Type of membership required!');
    }else if($('#registration_date').val()=="")
    {
        Swal.fire("Registration date required!!");
        $('.lbl_reg_date').css('color','red');
    }else if($('#registration_date').val()=="")
    {
        Swal.fire("Please select membership type!!");
        $('.lbl_reg_date').css('color','red');
    }else if($('#member_code').val()=="")
    {
        Swal.fire("Member ID required!!");
        $('.lbl_member_id').css('color','red');
    }else if($('#name').val()=="")
    {
        Swal.fire("Member name required!!");
        $('.lbl_mmbr_name').css('color','red');
    }


    // else if($('#college_roll').val()=="")
    // {
    //     Swal.fire("College roll required!!");
    //     $('.lbl_college_roll').css('color','red');
    // }
    else if($('#date_of_birth').val()=="")
    {
        Swal.fire("Date of Birth required!!");
        $('.lbl_dob').css('color','red');
    }
    else if($('#nid').val()=="" && $('#passport').val()=="" )
    {
        Swal.fire("NID or Passport is required!!");
        $('.lbl_nid').css('color','red');
        $('.lbl_passport').css('color','red');
    }
    else if($('#fathers_name').val()=="")
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
    }else if(($(".member_type:checked").data('short-name')=='UM' || $(".member_type:checked").data('short-name')=='GM') && $('#amount').val()=='')
    {
        Swal.fire("Payment amount required!!");
        $('.lbl_payment_amount').css('color','red');
    }
    else if(($(".member_type:checked").data('short-name')=='UM' || $(".member_type:checked").data('short-name')=='GM') && $('.payment_method:checked').val()==null)
    {
        Swal.fire("Payment method required!!");
        $('.lbl_payment_method').css('color','red');
    }
    else if($('#present_address').val()=="")
    {
        Swal.fire("Present address required!!")
        $('.lbl_present_address').css('color','red');
    }else
    {
        step++;
        if(step==1)
        {
            $('#step_1').addClass('hidden');
            $('#step_2').removeClass('hidden');

            $('#second_step').css({'color':'rgb(183 19 19)'});
            $('.circle2').css({'background':'rgb(183 19 19)'});
            $('.line1').css('background','rgb(183 19 19)');
        }

        $('#prev').removeClass('hidden');
        if(step==1)
        {
            $('#step_1').addClass('hidden');
            $('#step_2').removeClass('hidden');
            $('#next').addClass('hidden');
            $('#save').removeClass('hidden');
            $('#update').removeClass('hidden');
            $('#last_step').css({'color':'#41ff40'})
        }
        $('#form_step').val(step)
    }
});

$("#prev").click(function(){
    $('#step_1').removeClass('hidden');
    if(step==1)
    {
        $('#prev').addClass('hidden')
        $('#step_2').addClass('hidden')
        $('#second_step').css({'color':'rgb(108, 117, 125)'})
        $('.circle2').css({'background':'rgb(108, 117, 125)'})
        $('.line1').css('background','#6c757d')
        $('#next').removeClass('hidden')
        $('#save').addClass('hidden')
        $('#update').addClass('hidden')
    }
    if(step==0)
    {
        $('#step_1').removeClass('hidden')
        $('#step_2').addClass('hidden')
        $('#next').removeClass('hidden')
        $('#save').addClass('hidden')
        $('#update').addClass('hidden')
        $('.line2').css('background','rgb(108, 117, 125)')
        $('.circle2').css({'background':'rgb(108, 117, 125)'})
    }
    step--;
    $('#form_step').val(step)
});
let i1=0;
$('.add_more').on('click',function () {
    i1++;
    $('#education_tbody').append(
        "<tr id='extra_edu_row"+i1+"'>"+
            "<td><input type='text' name='institution_name[]' class='form-control' placeholder='Name of the Institution'/></td>"+
            "<td><input type='text' name='passing_year[]' class='form-control' placeholder='Passing Year'/></td>"+
            "<td><input type='text' name='degree[]' class='form-control' placeholder='Degree'/></td>"+
            "<td><a class='btn btn-danger btn-xs delete_extra_education' data-sl='"+i1+"'>x</a></td>"+
        "<tr>"
    )
});

$(document).on('click','.delete_current_edu',function () {
    let sl=$(this).data('id');

    Swal.fire({
        title: '<div style="font-size:20px;font-weight:bold;">Do you want to delete this information?</div>',
        html: '<div style="font-size:10px">Your current information will be deleted!!</div>',
        icon: 'warning',
        color:'green',
        showCancelButton: true,
        confirmButtonColor: '#0ba70c',
        cancelButtonColor: '#dd2900',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/member-education/delete',
                data: {
                    id:sl
                },
                cache: false,
                success: function(data){
                    document.getElementById('current_edu_row'+sl).remove();
                }
            });
        }
    })
});

$(document).on('click','.delete_extra_education',function () {
    let sl=$(this).data('sl');
    document.getElementById('extra_edu_row'+sl).remove();
});

let i2=0;
$('.add_more_club_info').on('click',function () {
    i2++;
    $('#club_info').append(
        "<tr id='extra_club_row"+i2+"'>"+
            "<td><input type='text' name='club_name[]' class='form-control'  class='form-control' placeholder='Club Name'/></td>"+
            "<td><input type='text' name='membership_no[]' class='form-control' placeholder='Membership Number'/></td>"+
            "<td><input type='text' name='membership_type[]' class='form-control' placeholder='Type of Membership/Position'/></td>"+
            "<td><a class='btn btn-danger btn-xs delete_extra_club' data-sl='"+i2+"'>x</a></td>"+
        "<tr>"
    )
})

$(document).on('click','.delete_extra_club',function () {
    let sl=$(this).data('sl');
    document.getElementById('extra_club_row'+sl).remove();
});

$(document).on('click','.current_club_del',function () {
    let sl=$(this).data('id');

    Swal.fire({
        title: '<div style="font-size:20px;font-weight:bold;">Do you want to delete this information?</div>',
        html: '<div style="font-size:10px">Your current information will be deleted!!</div>',
        icon: 'warning',
        color:'green',
        showCancelButton: true,
        confirmButtonColor: '#0ba70c',
        cancelButtonColor: '#dd2900',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/row-delete',
                data: {
                    id:sl
                },
                cache: false,
                success: function(data){
                    document.getElementById('current_club'+sl).remove();
                }
            });
        }
    });
});


let i3=0;
$('.add_more_dep_info').on('click',function () {
    i3++;
    $('#dep_list').append(
        "<tr id='extra_dep_row"+i3+"'>"+
            "<td><input type='text' name='dep_name[]' class='form-control'  class='form-control' placeholder='Name'/></td>"+
            "<td><input type='date' name='dep_dob[]' class='form-control' placeholder='Date of Birth'/></td>"+
            "<td><input type='text' name='dep_blood_group[]' class='form-control' placeholder='Blood Group'/></td>"+
            "<td><input type='text' name='dep_occupation[]' class='form-control' placeholder='Occupation'/></td>"+
            "<td><input type='text' name='dep_nid[]' class='form-control' placeholder='NID'/></td>"+
            "<td><a class='btn btn-danger btn-xs delete_extra_dep' data-sl='"+i3+"'>x</a></td>"+
        "<tr>"
    )
});

$(document).on('click','.delete_extra_dep',function () {
    let sl=$(this).data('sl');
    document.getElementById('extra_dep_row'+sl).remove();
});

$(document).on('click','.current_dep_del',function () {
    let sl=$(this).data('id');


    Swal.fire({
        title: '<div style="font-size:20px;font-weight:bold;">Do you want to delete this information?</div>',
        html: '<div style="font-size:10px">Your current information will be deleted!!</div>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0ba70c',
        cancelButtonColor: '#dd2900',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/row-delete',
                data: {
                    id:sl
                },
                cache: false,
                success: function(data){
                    document.getElementById('current_dep'+sl).remove();
                }
            });
        }
    });
});


$('#nid_doc').change(function(e){
    var file = e.target.files[0].name;
    $('#nid_file_name_tag').text(" | "+file+" Selected");
});

$('#hsc_doc').change(function(e){
    var file = e.target.files[0].name;
    $('#hsc_file_name_tag').text(" | "+file+" Selected");
});

$('#tin_doc').change(function(e){
    var file = e.target.files[0].name;
    $('#tin_file_name_tag').text(" | "+file+" Selected" );
});

$('#other_doc').change(function(e){
    var file = e.target.files[0].name;
    $('#other_file_name_tag').text(" | "+file+" Selected");
});


$('#payment1').on('click',function(){
    $('#payment2').prop('checked',false);
    $('#payment3').prop('checked',false);
});

$('#payment2').on('click',function(){
    $('#payment1').prop('checked',false);
    $('#payment3').prop('checked',false);
});

$('#payment3').on('click',function(){
    $('#payment2').prop('checked',false);
    $('#payment1').prop('checked',false);
});

$('.member_type').on('click',function () {
    if(($(".member_type:checked").data('short-name')=='UM' || $(".member_type:checked").data('short-name')=='GM'))
    {
        $('.required').text('*')
    }else {
        $('.required').text('')
    }
});

$('.membership_decline').on('click',function () {
    if($(this).val()==0)
    {
        $('#details_of_decline').attr('readonly','readonly')
    }else
    {
        $('#details_of_decline').removeAttr('readonly')
    }
})

$('.application_rejected').on('click',function () {
    if($(this).val()==0)
    {
        $('#details_of_reject').attr('readonly','readonly')
    }else
    {
        $('#details_of_reject').removeAttr('readonly')
    }
})

$('.criminal_ofence').on('click',function () {
    if($(this).val()==0)
    {
        $('#details_of_criminal_ofence').attr('readonly','readonly')
    }else
    {
        $('#details_of_criminal_ofence').removeAttr('readonly')
    }
})
