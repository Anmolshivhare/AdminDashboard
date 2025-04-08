@extends('layouts.app')

@section('content')

@php
    $fields = [
        ['label' => 'Name', 'name' => 'name', 'type' => 'text'],
        ['label' => 'Product Email', 'name' => 'email', 'type' => 'email'],
        ['label' => 'Product Address', 'name' => 'address', 'type' => 'text'],
        ['label' => 'Product No', 'name' => 'phone', 'type' => 'number'],
        ['label' => 'Product Pic', 'name' => 'profile_pic', 'type' => 'file'],
    ];
@endphp


<div class="container">
    <div class="row ">
        <div class="col-md-6 col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h3>{{ __('Product Price') }}</h3>
                </div>
                 
                <div class="card-body">
                    <!-- method="POST" action="{{ route('products.store') }}" -->
                    <form action="{{ route('product-prices.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                                @foreach($fields as $field)
                                        <x-input-component 
                                            :label="$field['label']" 
                                            :name="$field['name']" 
                                            :type="$field['type']"
                                        />
                                @endforeach
                                 <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary w-25">{{ __('create') }}</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

 