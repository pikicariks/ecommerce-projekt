@extends('frontend.main_master')
@section('content')
@php
$user = DB::table('users')->where('id',Auth::user()->id)->first();
@endphp
<div class="body-contain">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br><br>
                <img class="card-img-top" style="border-radius: 50%;" src="{{(!empty($data->profile_photo_path)) ? url('upload/user_images/'.$data->profile_photo_path) :url('upload/no_image.jpg')}}" height="100%" width="100%">
                <br><br><ul class="list-group list-group-flush">
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile update</a>
                    <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change password</a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>

                </ul>
            </div>

            <div class="col-md-2">
                
            </div>

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Change your password</span></h3>

                    <div class="card-body">
                        <form method="post" action="{{route('user.password.update')}}">
                            @csrf
                           
                            <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Current Password</label>
		                     <input type="password"  name="oldpassword" id="current_password" class="form-control unicase-form-control text-input" >
		                    </div>

                            <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">New password</label>
		                     <input type="password"  name="password" id="password" class="form-control unicase-form-control text-input"  >
		                    </div>

                            <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Confirm password</label>
		                     <input type="password"  name="password_confirmation" id="password_confirmation" class="form-control unicase-form-control text-input">
		                    </div>

                           

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update</button>
		                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>  
</div>

@endsection