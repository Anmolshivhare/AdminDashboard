@extends('layouts.app')
@section('title')
    {{ __('labels.create_role') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="flex-row-reverse gap-4 pb-2 mb-3 d-flex justify-content-end align-items-center">
                <h1 class="mb-0 page-title">{{ __('labels.create_role') }}</h1>
                <a class="btn btn-secondary back-link-padding back-btn rounded-cirlce"
                    href="{{ route('roles.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('error'))
                        <div class="mx-4 mt-3 mb-0 alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-6">
                                <label for="name" class="form-label text-dark">{{ __('labels.name') }}</label>
                                <input type="text" class="shadow-none form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="{{ __('labels.name') }}" value="{{ old('name') }}" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="category">{{ __('labels.permissions') }}</label>
                            <div class="form-check">
                                <input type="checkbox" id="select-all" class="form-check-input">
                                <label for="select-all" class="form-check-label text-dark">{{ __('labels.select_all') }}</label>
                            </div>
                            <div id="category-checkboxes" class="ms-5">
                                @foreach ($permissions['children'] as $category)
                                    @if ($category->parent_id === null)
                                        <!-- Parent categories -->
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input parent-checkbox"
                                                id="parent-{{ $category->id }}" name="parents[]"
                                                value="{{ $category->id }}">
                                            <label class="form-check-label text-dark" for="parent-{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>

                                            <!-- Child categories -->
                                            <div class="child-categories" style="margin-left: 20px;">
                                                @foreach ($category->children as $child)
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input child-checkbox"
                                                            name="children[]" value="{{ $child->id }}"
                                                            data-parent-id="{{ $category->id }}">
                                                        <label class="form-check-label text-dark"
                                                            for="child-{{ $child->id }}">
                                                            {{ $child->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                {{ __('buttons.create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
