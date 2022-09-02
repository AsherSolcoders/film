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
                    <h1> Comments </h1> 
                    <table class="table-dark col-md-12">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Film Name</th>
                        <th scope="col">Name</th>
                        <th scope="col">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count($comments) > 0 )
                            @foreach($comments as $val)
                           
                                <tr>
                                <th scope="row">{{ $val->id }}</th>
                                <td>{{ $val->user->name }}</td>
                                <td>{{ $val->film->name }}</td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->comment }}</td>
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
