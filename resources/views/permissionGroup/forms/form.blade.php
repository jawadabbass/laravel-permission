    @csrf
    <input type="hidden" name="id" value="{{ old('id', $permissionGroup->id) }}" />
    <div class="form-group">
        <label for="title">{{ __('Permission Group Title') }}</label>
        <input type="text" name="title" id="title" value="{{ old('title', $permissionGroup->title) }}"
            class="form-control @error('title') is-invalid @enderror" />
        @error('title')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

