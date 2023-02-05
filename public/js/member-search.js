


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
                        html_inner+="<li class='search-item listitem' data-id='"+member.id+"' data-name='"+member.first_name+" "+member.member_code+"'><a><div class='title-name'><div class='search-content'><span class='content-title'>Name: "+member.first_name+"</span><br><span>ID: "+member.member_code+"</span><br></div></div></a></li>";
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

$('#member_search1').on('keyup',function (e) {
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
                        html_inner+="<li class='search-item listitem1' data-id='"+member.id+"' data-name='"+member.first_name+" "+member.member_code+"'><a><div class='title-name'><div class='search-content'><span class='content-title'>Name: "+member.first_name+"</span><br><span>ID: "+member.member_code+"</span><br></div></div></a></li>";
                    });
                    $('.suggestion-area1').removeClass('hidden_area');
                    $('.suggestion-area1').html(html_inner);
                }
            })
        },1000);
    }
    if(value=="")
    {
        $('.suggestion-area1').addClass('hidden_area');
        $('.suggestion-area1').html();
    }
});

$('#member_search2').on('keyup',function (e) {
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
                        html_inner+="<li class='search-item listitem2' data-id='"+member.id+"' data-name='"+member.first_name+" "+member.member_code+"'><a><div class='title-name'><div class='search-content'><span class='content-title'>Name: "+member.first_name+"</span><br><span>ID: "+member.member_code+"</span><br></div></div></a></li>";
                    });
                    $('.suggestion-area2').removeClass('hidden_area');
                    $('.suggestion-area2').html(html_inner);
                }
            })
        },1000);
    }
    if(value=="")
    {
        $('.suggestion-area2').addClass('hidden_area');
        $('.suggestion-area2').html();
    }
});



$('#mem1').on('click',function(){
    $('#mem2').prop('checked',false);
    $('#mem3').prop('checked',false);
    $('#mem4').prop('checked',false);
})

$('#mem2').on('click',function(){
    $('#mem1').prop('checked',false);
    $('#mem3').prop('checked',false);
    $('#mem4').prop('checked',false);
})

$('#mem3').on('click',function(){
    $('#mem1').prop('checked',false);
    $('#mem2').prop('checked',false);
    $('#mem4').prop('checked',false);
})