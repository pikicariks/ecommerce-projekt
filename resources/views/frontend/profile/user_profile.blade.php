@extends('frontend.main_master')
@section('content')

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
                    <h3 class="text-center"><span class="text-danger">HI.... </span><strong>{{Auth::user()->name}}</strong>Update your profile</h3>

                    <div class="card-body">
                        <form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                            @csrf
                           
                            <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Name</label>
		                     <input type="text"  name="name" class="form-control unicase-form-control text-input" value="{{$data->name}}" >
		                    </div>

                            <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Email</label>
		                     <input type="email"  name="email" class="form-control unicase-form-control text-input" value="{{$data->email}}" >
		                    </div>

                            <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Phone</label>
		                     <input type="text"  name="phone" class="form-control unicase-form-control text-input"  value="{{$data->phone}}">
		                    </div>

                            <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">User image</label>
		                     <input type="file"  name="profile_photo_path" class="form-control unicase-form-control text-input" >
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