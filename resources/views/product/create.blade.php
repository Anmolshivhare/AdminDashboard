@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h3>{{ __('Product') }}</h3>
                </div>
                 
                <div class="card-body">
                    <!-- method="POST" action="{{ route('products.store') }}" -->
                    <form action="{{ route('products.store') }}"  class="dynamic-form" enctype="multipart/form-data">
                        @csrf
                        <!-- name Address Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Product Name') }}</label>
                            <input id="pName" type="name" class="form-control" name="name" value="{{ old('name') }}"  >
                            <div id="nameError" class="invalid-feedback "></div>
                        </div>
                        <div class="mb-3">
                            <label for="product_pic" class="form-label">{{ __('Product Image Upload') }}</label>
                            <input id="product_pic" type="file" class="form-control" name="product_pic" value="{{ old('product_pic') }}"    accept="image/*">
                         </div>
{{--  
                         <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target=".offcanvasScrolling" aria-controls="offcanvasScrolling">Enable body scrolling</button>

                            <div class="offcanvas offcanvas-start offcanvasScrolling" data-bs-scroll="true"     data-bs-backdrop="false" tabindex="-1" id=""  aria-labelledby="offcanvasScrollingLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Offcanvas with body scrolling</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <p>Try scrolling the rest of the page to see this option in action.</p>
                                    <br>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Textarea</label>
                                        <textarea  type="name" class="form-control" id="editor" name="name"></textarea>
                                    </div>
                                </div>
                             </div> --}}
                          
                        <!-- Login Button -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100"  data-url="">{{ __('create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

 