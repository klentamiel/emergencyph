@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card" style="width: 95%;">
                <div class="card-header text-center">AMBULANCES</div> 
                <form action="{{ route('hospital.search') }}" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group col-5 mt-4 ml-4">
                        <input type="text" class="form-control" name="q"
                            placeholder="Search users"> <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </span>
                    </div>
                </form>
                @if(session('success'))
                    <div class="alert alert-success mt-2" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(isset($message))                                
                    <p class='ml-5 px-2 mt-2'> {{ $message }} </p>    
                @endif   
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
                        @if(isset($details))
                        @foreach($details as $user)
                            <tr>                           
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->user_type }}</td> 
                                <td>
                                    <a href="{{ route('ambulances.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                    <form action="{{ route('ambulances.destroy', $user) }}" method="POST" class="float-left px-3">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>                                       
                                    </form>
                                </td>                                                               
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        <!-- </div> -->
    </div>
</div>
@endsection
