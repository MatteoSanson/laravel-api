@extends('layouts.admin')

@section('header')
    <h1>Add a project</h1>
@endsection

@section('content')
    <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" aria-label="Default select example" name="type_id">
                    <option selected>Choose an option</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                            {{ $type->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div>
                    <label class="form-label">Tehcnology</label>
                </div>
                @foreach ($technologies as $technology)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="{{ $technology->id }}" name="technologies[]"
                            id="tag-{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tag-{{ $technology->id }}">{{ $technology->title }}</label>
                    </div>
                @endforeach
            </div>
            {{-- <div class="mb-3">
                <label class="form-label">Language/Framework</label>
                <input type="text" class="form-control @error('language_framework') is-invalid @enderror"
                    name="language_framework" value="{{ old('language_framework') }}">
                @error('language_framework')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label for="visibility" class="form-label">Visibility</label>
                <select class="form-select" aria-label="Default select example" name="visibility">
                    <option value="public" {{ old('visibility') == 'public' ? 'selected' : '' }}>public</option>
                    <option value="private" {{ old('visibility') == 'private' ? 'selected' : '' }}>private</option>
                </select>
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
