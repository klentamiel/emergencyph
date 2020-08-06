@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card" style="width: 95%;">
                <div class="card-header text-center">USERS</div> 
                @if(isset($message))                                
                    <p class='ml-5 px-2 mt-2'> {{ $message }} </p>    
                @endif   
                <div class="card-body">                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>                            
                        @if(isset($details))
                        @foreach($details as $user)
                            <tr id="{{ $user->id }}">                           
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->user_type }}</td> 
                                <td>
                                    <a href="{{ route('admin.profile', $user) }}"><button onClick='{{ $user->username }}()' type="button" class="btn btn-primary float-left">View Profile</button></a>
                                </td>                                                               
                            </tr>
                            <script>
                                function {{ $user->username }}() {
                                    firebase.database().ref('View/' + '{{ $user->id }}').update({
                                        viewing:1,                                            
                                    });
                                }                                               
                                firebase.database().ref('View/' + '{{ $user->id }}' ).on("value", snapshot => {
                                        var childData = snapshot.val();                                        
                                        if (childData['viewing'] == '1'){
                                            document.getElementById(childData['id']).style.backgroundColor = "lightgreen";
                                        } else {
                                        document.getElementById(childData['id']).style.backgroundColor = ""; 
                                        }      
                                });
                            </script>
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
