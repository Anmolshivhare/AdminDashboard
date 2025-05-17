@extends('layouts.app')
@section('title')
    {{ __('labels.create_user') }}
@endsection
@section('content')
<div class=" admin-profile-screen px-sm-4">
    <div class="  gap-2 align-items-center mb-4 pb-2">
        <h3 class="page-title">{{ __('labels.create_user') }}</h3>

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
                            <h3 class="mb-0 fw-bold ms-4">{{__('labels.create_user')}}</h3>
                        </div>
                    </div>
                </div>
                <!-- card header end -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{route('users.store')}}" class="px-2"
                                enctype="multipart/form-data">
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
                                                value="{{old('name')}}"
                                                placeholder="{{ __('name') }}" />
                                            @error('name')
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
                                                value="{{old('email')}}"
                                                placeholder="{{ __('Email') }}"/>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xm-12 col-sm-6 col-lg-6 col-md-6 col-xl-6 col-xxl-6 mb-3">
                                        <label class="form-label text-dark"
                                            for="password">{{ __('labels.password') }}
                                        </label>
                                        <div class="input-group">
                                            <input
                                                class="form-control
                                        @error('password') is-invalid @enderror"
                                                name="password" type="password" id=""
                                                value="{{old('password')}}"
                                                placeholder="{{ __('password') }}"/>
                                            @error('password')
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
                                                value="{{old('profile_pic')}}"
                                                placeholder="{{ __('profile_pic') }}" accept="image/*" />
                                                  
                                            @error('profile_pic')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="col-xm-12 col-sm-6 col-lg-6 col-md-6 col-xl-6 col-xxl-6 mb-3">
                                        <label class="form-label text-dark"
                                            for="phone_no">{{ __('labels.phone') }}
                                        </label>
                                        <div class="input-group">
                                            <input
                                                class="form-control
                                        @error('phone_no') is-invalid @enderror"
                                                name="phone_no" type="number" id=""
                                                value="{{old('phone_no')}}"
                                                placeholder="{{ __('labels.phone') }}"  />
                                            @error('phone_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <label for="role" class="form-label">{{ __('labels.role') }}</label>
                                        <select id="role" name="role"
                                            class="form-select
                                        @error('role') is-invalid @enderror">
                                            <option value="">{{ __('labels.select_role') }}</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role') == $role->id ? 'selected="selected"' : '' }}>
                                                    {{ ucwords($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 col-lg-12 mb-3">
                                        <label class="form-label text-dark"
                                            for="address">{{ __('labels.address') }}
                                        </label>
                                        <div class="">
                                            <textarea
                                                class="form-control
                                        @error('address') is-invalid @enderror"
                                                name="address" type="text" id="editor" 
                                                value=""
                                                placeholder="{{ __('labels.address') }}"> {{ old('address') }}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>  
 
                                <button class="btn btn-primary fs-5 mt-3" type="submit">
                                    {{ __('buttons.create') }}
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
 
 
 