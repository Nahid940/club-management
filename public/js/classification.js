$('#save_classification').on('click',function(){
    let id=$(this).attr('data-id')
    $('#member_id').val(id)
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to add classification for this member!!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#classification_form').submit();
        }
    })
});