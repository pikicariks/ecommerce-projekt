@extends('frontend.main_master')
@section('content')

<div class="body-contain">
    <div class="container">
        <div class="row">
           @include('frontend.common.user_sidebar')

            <div class="col-md-2">
                
            </div>

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">HI.... </span><strong>{{Auth::user()->name}}</strong> Welcome to online shop</h3>
                </div>
            </div>
        </div> 
    </div>  
</div>

@endsection