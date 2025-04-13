@extends('layouts.app')
@section('title') {{ __('labels.permissions') }} @endsection
@section('content')
<div class="d-flex gap-2 align-items-center mb-4 pb-2">
	<h3 class="page-title">{{ __('labels.permissions') }}</h3>
  </div>

	<div class="d-flex flex-row-reverse my-3">
		<a href="{{route('permissions.create')}}" class="btn btn-primary px-4 py-2  mx-3">create</a>
	</div>

	@if (session('message'))
					<div class="alert alert-success alert-dismissible fade show mx-4 mb-0 mt-3" role="alert">
						{{ session('message') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
	@endif
	@if (session('error'))
					<div class="alert alert-danger alert-dismissible fade show mx-4 mb-0 mt-3" role="alert">
						{{ session('error') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
	@endif
<div class="col-md-12 divide-y-1 dashboard-card-main-col">
	<div class="row">
		<div class="col-12">
			<div class="card no-scale">
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
	</div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }} 
@endpush
