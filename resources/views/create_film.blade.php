@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('films.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="card-header">@yield('nav',view('nav'))</div>
                <div class="card-body">
                    <h1>  Create Film </h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group col-md-12">
                        <label for="name">Name <small>(required)</small></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="release_date">Release Date <small>(required)</small></label>
                        <input type="text" name="release_date" class="form-control" id="datepicker" placeholder="yyyy-mm-dd">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="rating">Rating <small>(required)</small></label>
                        <select name="rating" class="form-control select2">
                            <option value="">Select Rating</option>
                            @for($i=1; $i<=5; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="genres">Genres <small>(required)</small></label>
                        <select name="genres[]" class="form-control select2" multiple="multiple">
                            <option value="">Select Genres</option>
                            @if( count($genres) > 0)
                                @foreach( $genres as $val)    
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="country">Country <small>(required)</small></label>
                        <select name="country" class="form-control select2">
                            <option value="">Select Country</option>
                            @if( count($countries) > 0)
                                @foreach( $countries as $val)    
                                    <option value="{{$val->name}}">{{$val->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="ticket">Ticket <small>(required)</small></label>
                        <input type="number" name="ticket" step="0.01" class="form-control" >
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Description <small>(required)</small></label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="photo">Upload Photo</label>
                        <input type="file" class="form-control-file" name="photo" id="photo">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2" id="add-film">Add Film</button> 
                    
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('head')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#datepicker').datepicker({
            dateFormat: "yy-mm-dd"
        });

        $('.select2').select2();
    })

</script>
@endpush