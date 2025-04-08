@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h3>{{ __('Shop') }}</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('shops.store') }}">
                        @csrf

                        <!-- name Address Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Shop Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="shop_name" value="{{ old('shop_name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product" class="form-label">{{ __('Product Select') }}</label>
                            <select id="product" class="form-control select2" name="product_id[]" value="{{ old('product_id') }}" multiple="multiple">
                                @foreach($productData as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>

                        </div>


                        <!-- Login Button -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100">{{ __('create') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="module" defer>
    $(document).ready(function() {
        // Initialize Select2 on the element with ID 'product'
        $('#product').select2({
            placeholder: 'Select Product', // Placeholder text
            allowClear: true, // Allow clearing the selection
        });
    });
</script>
@endpush