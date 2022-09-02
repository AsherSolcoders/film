@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@yield('nav',view('nav'))</div>
                <div class="card-body">
                    <div class="row films filmHtml"></div>
                    <div class="row page"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="film_id" class="form-control comment-filmid">
@yield('comments',view('comments'))

@endsection

@push('script')
<script src="{{ asset('js/common.js') }}" defer></script>
@endpush

@push('script')
<script>
    var page =1;
    var  appUrl = '{{ url('/') }}'
    var filmHtml;
    var commentHtml;
    document.addEventListener('DOMContentLoaded', function () {
        $(".add-comment").hide();
        // rest api film
       callAjax('GET',appUrl+'/films',{page : page}, {'Content-Type': 'application/json'}, filmHtml);

       // pagination
       $(document).on('click', '.page-link', function(event){
            event.preventDefault(); 
            page = $(this).attr('href').split('page=')[1];
            if(  typeof page != 'undefined')
                callAjax('GET',appUrl+'/films',{page : page},{'Content-Type': 'application/json'},filmHtml);
        }); 
    })

 filmHtml = (res) => {
    if( res.data.length > 0){

        var html = 'films not found';
        $(".add-comment").show();
        $(".comments").html('');
        $.each(res.data , function(ind, val) { 
            $(".comment-filmid").val(val.id); // add film id in comment form

            var source = "{!!asset('img') !!}/"+val.photo;
            html = `<div class="col-sm-4"><a href="${appUrl}/films/${val.slug}"><img src="${source}" alt="${val.name}" width="300" height="200"></a></div>
                <div class="col-sm-8">
                <h1><a href="${appUrl}/films/${val.slug}">${val.name}</a></h1>`;

            if( val.genres.length > 0){
                var genreArray = [];
                $.each(val.genres , function(index, value) { 
                    genreArray.push(value.name);
                });
                
                html += `<br><b>Genres</b> : <span>${genreArray.join(", ")}</span>`;
            }
            html += `<br><b>Rating</b> : <span>${val.rating}</span>
                <br><b>Release Date</b> : <span>${val.release_date}</span></div>`

            // pagination 
            if(res.total > 1)
            {
                pagination = `<div class="col-sm-12">
                <nav aria-label="Page navigation example">
                <ul class="pagination">`

                for(i=1; i<=res.total; i++){
                    if( page == i)
                        pagination += `<li class="page-item"><a class="page-link" href="javascript:void(0)">${i}</a></li>`
                    else
                        pagination += `<li class="page-item"><a class="page-link" href="${appUrl}?page=${i}">${i}</a></li>`
                }
                pagination += '</ul></nav></div>'
                
            }
            
            if( val.comments.length > 0){
               getComment(val.comments)
            }
        })

        
        

        $(".films").html(html);
        $(".page").html(pagination);
        ///$(".comments").html(comment);

    }
    else{
        $(".filmHtml").html('films not found');
    }
}

commentHtml = (res) => {
    if(res.data){
        $(".comment-alert").html(`<div class="alert alert-success"> ${res.data}</div>`);
        callAjax('GET',appUrl+'/films',{page : page}, '', filmHtml);
    }
    else{
        $(".comment-alert").html('<div class="alert alert-danger"> Something went wrong</div>');

    }
}
</script>
@endpush
