<div class="mb-3 col-4">
    <label for="name" class="form-label">Create a new tag</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name"
    value="{{ old('name', $tag->name) }}">
    <div class="form-text">Insert tag's name</div>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex justify-content-center col-2">
    <button class="btn btn-lg btn-primary" type="submit">
        Save
    </button>
</div>