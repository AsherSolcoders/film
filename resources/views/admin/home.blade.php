@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@yield('admin.nav',view('admin.nav'))</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1> Films </h1>
                    <table class="table-dark col-md-12">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Ticket</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Release Date</th>
                        <th scope="col">Genres</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count($films) > 0 )
                            @foreach($films as $val)
                                <tr>
                                <th scope="row">{{ $val->id }}</th>
                                <td> <img src="{{ asset('img/'.$val->photo) }}" alt=" {{ $val->name }}" width="50" height="50"></img></td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->ticket }}</td>
                                <td>{{ $val->rating }}</td>
                                <td>{{ $val->release_date }}</td>
                                <td>{{ count($val->genres) > 0 ? $val->genres->implode('name',',') : 'NAN' }}</td>
                                <td> <a href="{{url('admin/comments/'.$val->id)}}" title="comments"><i class="bi bi-envelope"></i></a></td>
                                </tr>
                            @endforeach
                        @endif    
                    </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
@endpush
