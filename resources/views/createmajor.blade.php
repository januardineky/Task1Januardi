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

<!-- Form to Add New Major -->
<div class="coantainer">
    <a href="/index"><button class="btn btn-secondary mb-3">Back To Major List</button></a>
    <h3>Add New Major</h3>

    <form action="/create" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="major_name" class="form-label">Major Name</label>
            <input type="text" class="form-control" id="major_name" name="major_name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="mt-4">
            <button type="submit"  class="btn btn-primary w-100" style="height: 50px;">Add Major</button>
        </div>
    </form>
</div>

@endsection
