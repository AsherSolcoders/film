@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@yield('admin.nav',view('admin.nav'))</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1> Genres </h1> 
                    <form action="{{url('admin/add-genres')}}" method="post"  class="form-inline">
                        @csrf
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="name">Name*</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <button class="btn btn-primary mb-2" type="submit">Add Genre</button>
                    </form>
                    <table class="table-dark col-md-12">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( count($genres) > 0 )
                            @foreach($genres as $val)
                           
                                <tr>
                                <th scope="row">{{ $val->id }}</th>
                                <td>{{ $val->name }}</td>
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
