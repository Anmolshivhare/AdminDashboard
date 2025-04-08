@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row-reverse my-3">
        <a href="{{route('products.create')}}" class="btn btn-primary px-4 py-2  mx-3">create</a>
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
    <div class="card mt-3">
        <div class="card-header">Manage Products</div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
 {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script type="module" defer>
	$(document).ready(function() {
		let table = $('#products-table').DataTable();

		// Select/Deselect all rows
		$('#select-all').on('click', function() {
			if (this.checked) {
				table.rows().select();
			} else {
				table.rows().deselect();
			}
		});
	});
</script>
@endpush