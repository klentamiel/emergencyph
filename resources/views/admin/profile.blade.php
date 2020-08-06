@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card" style="width: 60%;">
                <div class="card-header text-center">USER PROFILE</div>  
                <div class="card-body">      
                @foreach($profile as $profile)              
                    <div class="row">
                        <div class="col-sm border">
                            First Name:
                        </div>
                        <div class="col-9 border">
                            {{ $profile->first_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm border">
                            Middle Name:
                        </div>
                        <div class="col-9 border">
                            {{ $profile->middle_name }}
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-sm border">
                            Last Name:
                        </div>
                        <div class="col-9 border">
                            {{ $profile->last_name }}
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-sm border">
                            Last Name:
                        </div>
                        <div class="col-9 border">
                        <img src="data:image/jpeg;base64,'.base64_encode( {{ $profile->profile_pic }} ).'"/>
                        </div>   
                    </div>
                    <form action="{{ route('admin.allow') }}" method="POST"> 
                        @csrf
                        <input type="text" style="display:none" name="id" value="{{ $profile->id }}">                      
                        <button onclick="return confirm('Are you sure you want to ALLOW this user?')" type="submit" name="allow" class="btn btn-success m-2 p-2">Allow User</button>
                        <button onclick="return confirm('Are you sure you want to DENY this user?')" type="submit" name="deny" class="btn btn-danger m-2 p-2">Invalid</button>
                    </form>     
                @endforeach                
                </div>
            </div>
        <!-- </div> -->
    </div>
</div>
@endsection
