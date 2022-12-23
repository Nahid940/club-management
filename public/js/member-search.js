


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
                url:"/member/search",
                success:function (res) {
                    res=JSON.parse(res);
                    $.each(res.members,function (index,member) {
                        html_inner+="<li class='search-item listitem' data-id='"+member.id+"' data-name='"+member.first_name+"'><a><div class='title-name'><div class='search-content'><span class='content-title'>Name: "+member.first_name+"</span><br><span>Email: "+member.email+"</span><br></div></div></a></li>";
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
