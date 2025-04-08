@extends('layouts.app')

@section('content')

@php
    $fields = [
        ['label' => 'Name', 'name' => 'name', 'type' => 'text', 'value' => $productProfile['name'] ?? ''],
        ['label' => 'Product Email', 'name' => 'email', 'type' => 'email', 'value' => $productProfile['email'] ?? ''],
        ['label' => 'Product Address', 'name' => 'address', 'type' => 'text', 'value' => $productProfile['address'] ?? ''],
        ['label' => 'Product No', 'name' => 'phone', 'type' => 'number', 'value' => $productProfile['phone'] ?? ''],
        ['label' => 'Product Pic', 'name' => 'profile_pic', 'type' => 'file', 'value' => ''],
    ];
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h3>{{ __('Product Edit') }}</h3>
                </div>
                 
                <div class="card-body">
                     <form action="{{route('product-prices.update',$productProfile->id)}}"   enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')
                        <!-- name Address Field -->
                        {{-- <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Product Name') }}</label>
                            <input id="pName" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$productData->name}}">
                            <div id="nameError" class="invalid-feedback "></div>
                        </div>
                           @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        <div class="mb-3">
                            <label for="product_pic" class="form-label">{{ __('Product Image Upload') }}</label>
                            <input  type="file" class="form-control  @error('product_pic') is-invalid @enderror" name="product_pic" value="{{$productData->product_pic}}" accept="image/*">
                            @error('product_pic')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <img src="{{asset('uploads/products/'.$productData->product_pic)}}" alt="" width="50px">
                            
                         </div> --}}


                         <div class="row">

                            @foreach($fields as $field)
                                <x-input-component 
                                    :label="$field['label']" 
                                    :name="$field['name']" 
                                    :type="$field['type']"
                                    :value="$field['value']"
                                />
                            @endforeach
                         </div>

                        <!-- Login Button -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100"  >{{ __('update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection