callAjax = (type,url,data,headers,func) => {
   
    $.ajax({
        type: type,
        url: url,
        headers : headers,
        data : data,
        success: function(response){
             console.log(response);                
        },
        complete: function(response){
            console.log('dsdds',response.responseJSON)
            func(response.responseJSON); 
        },
        error: function(resp){
            alert('something went wrong');
        }
        });
}


var getComment = (comments) => {
    console.log('comments',comments)
    comment='';
    $.each(comments , function(key, cmnt) { 
        comment += `<div class="col-sm-12"><h1>${cmnt.name}</h1>
        <br>${cmnt.comment}</div>`
    });
    $(".comments").html(comment);
}

//add comment
$(document).on('click', '#add-comment', function(event){
    $(".comment-alert").html('')
    event.preventDefault(); 
    
    cmntname = $(".comment-name").val();
    desc = $(".comment-desc").val();
    filmid = $(".comment-filmid").val();

    if( ! cmntname || ! desc){
        $(".comment-alert").html('<div class="alert alert-danger"> Name or Comment are required</div>');
    }
    else{
        headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        console.log('headers',headers);
        callAjax('POST',appUrl+'/add-comment',{'name' : cmntname, 'comment' : desc, 'filmid': filmid}, headers , commentHtml);
    }
})

