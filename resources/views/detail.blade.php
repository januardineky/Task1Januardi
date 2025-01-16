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

<!-- Action Buttons -->
<div class="d-flex justify-content-between mb-3">
    <a href="/index"><button class="btn btn-secondary">Back To Major List</button></a>
    <a href="/competency/create"><button class="btn btn-success">Add New Competency Standard</button></a>
</div>

@if($competencyStandards->isEmpty())
    <p>No competency standards available for this major.</p>
@else
    @php
        $hasAction = $competencyStandards->contains(function ($standard) {
            return $standard->user_id == auth()->id();
        });
    @endphp
    <table id="competencyTable" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Unit Code</th>
                <th>Unit Title</th>
                <th>Description</th>
                <th>Grade Level</th>
                <th>Major Name</th>
                @if($hasAction)
                    <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($competencyStandards as $standard)
                <tr>
                    <td>{{ $standard->id }}</td>
                    <td>{{ $standard->unit_code }}</td>
                    <td>{{ $standard->unit_title }}</td>
                    <td>{{ $standard->unit_description }}</td>
                    <td>{{ $standard->grade_level }}</td>
                    <td>{{ $standard->major->major_name }}</td>
                    @if($standard->user_id == auth()->id())
                        <td>
                            <!-- Edit Button -->
                            <a href="/edit/standard/{{ $standard->id }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>     

                            <!-- Delete Button -->
                            <form id="delete-form-{{ $standard->id }}" action="{{ url('/delete/standard', $standard->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button onclick="confirmDeletion({{ $standard->id }})" class="btn btn-danger btn-sm ms-4">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#competencyTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 10 // Set default number of rows per page
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDeletion(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection
