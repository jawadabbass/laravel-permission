    @csrf
    <input type="hidden" name="id" value="{{ old('id', $role->id) }}" />
    <div class="form-group">
        <label for="title">{{ __('Role Title') }}</label>
        <input type="text" name="title" id="title" value="{{ old('title', $role->title) }}"
            class="form-control @error('title') is-invalid @enderror" />
        @error('title')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

