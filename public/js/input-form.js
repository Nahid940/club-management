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