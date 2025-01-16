@extends('template.navbar')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Form to Edit Major -->
<div class="container">
    <a href="/index"><button class="btn btn-secondary mb-3">Back To Major List</button></a>
    <h3>Edit Major</h3>
    <form action="/update/{{ $major->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="major_name" class="form-label">Major Name</label>
            <input type="text" class="form-control" id="major_name" name="major_name" value="{{ $major->major_name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $major->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @if($major->image)
                <p>Current Image: <img src="{{ asset('storage/' . $major->image) }}" class="mt-4 mb-4" alt="Current Image" width="150" height="150"></p>
            @endif
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100" style="height: 50px;">Update Major</button>
        </div>
    </form>
</div>

@endsection
