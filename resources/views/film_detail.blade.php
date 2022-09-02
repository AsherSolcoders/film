@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@yield('nav',view('nav'))</div>
                <div class="card-body">
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                    <div class="row films">
                        @if( $film )
                            <input type="hidden" name="film_id" class="form-control comment-filmid" value="{{$film->id}}">
                            <div class="col-sm-4">
                                <img src="{{ asset('img/'.$film->photo) }}" alt="{{ $film->name }}" width="300" height="200">
                            </div>
                            <div class="col-sm-8">
                                <h1>{{ $film->name }}</h1>
                                <br><b>Genres</b> : <span>{{ count($film->genres) > 0 ? $film->genres->implode('name',',') : 'NAN' }}</span>
                                <br><b>Ticket</b> : {{ $film->ticket }}
                                <br><b>Rating</b> : {{ $film->rating }}
                                <br><b>Release Date</b> : {{ $film->release_date }}
                                <br><b>Description</b> : {!! $film->description !!}
                            </div>
                        @endif
                    </div>
                    <div class="row page">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('comments',view('comments'))

@endsection


@push('script')
<script src="{{ asset('js/common.js') }}" defer></script>
@endpush
@push('script')

<script>
    var  appUrl = '{{ url('/') }}'
    var filmid;
    var getComment;
    var commentHtml;
    document.addEventListener('DOMContentLoaded', function () {
        filmid = $(".comment-filmid").val();
        getFilmComment();        
     })
    
     getFilmComment = () => {
        callAjax('GET',appUrl+'/get-comments',{filmid:filmid}, {'Content-Type': 'application/json'}, getComment);
    }
    commentHtml = (res) => {
        getFilmComment();
    }
</script>
@endpush