@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="d-flex flex-row-reverse my-3">
            <a href="{{route('users.create')}}" class="btn btn-primary px-4 py-2  mx-3">create</a>
          </div>
          </div>    
        <div class="card">
            <div class="card-header">Manage Users</div>
            
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show mx-4 mb-0 mt-3" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
       @endif
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush