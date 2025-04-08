<div>
    <div class="col-md-6 mb-3">
        <div class="col-md-6 mb-3">
            <label for="{{ $id }}" class="form-label">{{ __($label) }}</label>
            <input id="{{ $id }}" type="{{ $type }}" class="form-control" name="{{ $name }}" value="{{ $value }}" >
            @error($name)
             <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>