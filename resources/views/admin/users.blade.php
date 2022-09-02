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
                    <h1> Users </h1> 
                    <table class="table-dark col-md-12">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count($users) > 0 )
                            @foreach($users as $val)
                           
                                <tr>
                                <th scope="row">{{ $val->id }}</th>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->email }}</td>
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
