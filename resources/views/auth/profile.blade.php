@extends('layouts.app')
@section('title')
    {{ __('labels.edit_user') }}
@endsection
@section('content')
<div class=" admin-profile-screen px-sm-4">
    <div class="  gap-2 align-items-center mb-4 pb-2">
        <!-- <h3 class="page-title">{{ __('labels.user_profile') }}</h3> -->

        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show mx-4 mb-0 mt-3" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="row gap-3 gap-xl-0">
       
        <div class="col-xxl-12">
            <div class="card rounded-2 h-100">
                <!-- card header start -->
                <div class="row">
                    <div class="col-md-12">
                        <div
                            class="d-flex flex-row pb-4 py-4 px-6 border-bottom border-1 bg-white gap-3 justify-content-between align-items-center">
                            <h3 class="mb-0 fw-bold ms-4">Edit Profile</h3>
                        </div>
                    </div>
                </div>
                <!-- card header end -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{route('users.update',$userData->id)}}" class="px-2"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <input type="hidden" name="url" value="profile-update">
                              
                                <div class="row mb-0">
                                    <div class="col-xm-12 col-sm-6 col-lg-6 col-md-6 col-xl-6 col-xxl-6 mb-3">
                                        <label class="form-label text-dark"
                                            for="first_name">{{ __('Name') }}
                                        </label>
                                        <div class="input-group">
                                            <input
                                                class="form-control
                                        @error('name') is-invalid @enderror"
                                                name="name" type="text" id=""
                                                value="{{$userData->name}}"
                                                placeholder="{{ __('name') }}" />
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xm-12 col-sm-6 col-lg-6 col-md-6 col-xl-6 col-xxl-6 mb-3">
                                        <label class="form-label text-dark"
                                            for="email">{{ __('Email') }}
                                        </label>
                                        <div class="input-group">
                                            <input
                                                class="form-control
                                        @error('email') is-invalid @enderror"
                                                name="email" type="text" id=""
                                                value="{{$userData->email}}"
                                                placeholder="{{ __('Email') }}" readonly />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xm-12 col-sm-6 col-lg-6 col-md-6 col-xl-6 col-xxl-6 mb-3">
                                        <label class="form-label text-dark"
                                            for="profile_pic">{{ __('Profile') }}
                                        </label>
                                        <div class="input-group">
                                            <input
                                                class="form-control @error('profile_pic') is-invalid @enderror"
                                                name="profile_pic" type="file"
                                                value="{{$userData->profile_pic}}"
                                                placeholder="{{ __('profile_pic') }}" accept="image/*" />
                                                  
                                            @error('profile_pic')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @if($userData->profile_pic)
                                        <img src="{{asset('uploads/profile/' . $userData->profile_pic)}}" width="100" height="100" class="img-thumbnail">
                                        @else
                                        <img src="{{ asset('uploads/profile/user.png') }}" width="50" height="50" class="img-thumbnail rounded-circle">
                                        @endif
                                    </div>  
                                </div>  
 
                                <button class="btn btn-primary fs-5 mt-3" type="submit">
                                    {{ __('update') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
 
 