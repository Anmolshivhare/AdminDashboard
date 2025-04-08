@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row-reverse my-3">

        <a href="{{route('shops.create')}}" class="btn btn-primary px-4 py-2  mx-3">create</a>
    </div>
    <div class="card">

        <div class="card-header">Manage Shop</div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush