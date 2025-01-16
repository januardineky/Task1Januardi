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

<!-- Form to Add Competency Standard -->
<div class="container">
    <a href="{{ url()->previous() }}"><button class="btn btn-secondary mb-3">Back To Competency List</button></a>
    <h3>Update Competency Standard</h3>

    <form action="/edit/standard/{{ $standard->id }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="unit_code" class="form-label">Unit Code</label>
            <input type="text" class="form-control" id="unit_code" name="unit_code" value="{{ $standard->unit_code }}" required>
        </div>
        
        <div class="mb-3">
            <label for="unit_title" class="form-label">Unit Title</label>
            <input type="text" class="form-control" id="unit_title" name="unit_title" value="{{ $standard->unit_title }}" required>
        </div>
 
        <div class="mb-3">
            <label for="unit_description" class="form-label">Unit Description</label>
            <textarea class="form-control" id="unit_description" name="unit_description" rows="3" required>{{ $standard->unit_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="grade_level" class="form-label">Grade Level</label>
            <input type="number" class="form-control" id="grade_level" name="grade_level" value="{{ $standard->grade_level }}" required>
        </div>

        <div class="mb-3">
            <label for="major_id" class="form-label">Major</label>
            <select class="form-control" id="major_id" name="major_id" required>
                <option value="">Select Major</option>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}" {{ $standard->major_id == $major->id ? 'selected' : '' }}>
                        {{ $major->major_name }}
                    </option>
                @endforeach
            </select>
            
        </div>

        <div class="mb-3">
            <button type="submit"  class="btn btn-primary w-100" style="height: 50px;">Update Competency Standard</button>
        </div>
    </form>
</div>

@endsection
