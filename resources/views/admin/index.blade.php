@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card" style="width: 95%;">
                <div class="card-header text-center">STATIONS</div>    
                
                <div class="card-body">                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>                           
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->user_type }}</td> 
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}"><button type="button" class="btn btn-primary">Edit</button></a>
                                    <a href="{{ route('users.destroy', $user->id) }}"><button type="button" class="btn btn-warning">Delete</button></a>
                                </td>                                                               
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        <!-- </div> -->
    </div>
</div>
@endsection
