@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h3>{{ __('Product Edit') }}</h3>
                </div>
                 
                <div class="card-body">
                     <form action="{{ route('products.update',$productData->id) }}"   enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')
                        <!-- name Address Field -->
                        <div class="mb-3">
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