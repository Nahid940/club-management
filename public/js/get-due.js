$("body").on("click", ".listitem", function () {
    let id=$(this).data('id');
    if(id!="")
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"post",
            data:{"id":id},
            url:"/payment/get-due",
            success:function (res) {
                res=JSON.parse(res);
                $('#due_amount').text(res.due)
                $('.due_area').removeClass('hidden_area');
            }
        })
    }
});