


let typingTimer;

$('#member_search').on('keyup',function (e) {
    let html_inner="";
    let value;
    value=$(this).val();
    clearTimeout(typingTimer);
    if(value!="")
    {
        typingTimer=setTimeout(function () {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"post",
                data:{"value":value},
                url:"/donor/search",
                success:function (res) {
                    res=JSON.parse(res);
                    $.each(res.members,function (index,member) {
                        html_inner+="<li class='search-item listitem' data-id='"+member.id+"' data-name='"+member.name+"'><a><div class='title-name'><div class='search-content'><span class='content-title'>Name: "+member.name+"</span><br><span>Email: "+member.email+"</span><br></div></div></a></li>";
                    });
                    $('.suggestion-area').removeClass('hidden_area');
                    $('.suggestion-area').html(html_inner);
                }
            })
        },1000);
    }


    if(value=="")
    {
        $('.suggestion-area').addClass('hidden_area');
        $('.suggestion-area').html();
    }
});


$('#mem1').on('click',function(){
    $('#mem2').prop('checked',false);
    $('#mem3').prop('checked',false);
    $('#mem4').prop('checked',false);
});

$('#mem2').on('click',function(){
    $('#mem1').prop('checked',false);
    $('#mem3').prop('checked',false);
    $('#mem4').prop('checked',false);
});

$('#mem3').on('click',function(){
    $('#mem1').prop('checked',false);
    $('#mem2').prop('checked',false);
    $('#mem4').prop('checked',false);
});


$('#save_donor').on('click',function (event) {
    if($('#name').val()=="")
    {
        alert("Name is required!")
    }
    else if($('#email').val()=="")
    {
        alert("Email is required!")
    }
    else if($('#phone').val()=="")
    {
        alert("Phone is required!")
    }else
    {
        event.preventDefault();
        var form = $("#donor_data_form");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/donor/add",
            data: form.serialize(),
            success: function(data)
            {
                let id=JSON.parse(data);
                $('#member_search').val($('#name').val());
                $('#member_id').val(id.id);
                $('#modal-default').modal('hide');

            },
            error:function (data) {
                console.log(data)
            }
        });
    }

});