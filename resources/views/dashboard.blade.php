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

<div class="mb-3">
    <a href="/create" class="btn btn-success text-white" style="text-decoration: none">Add New Major</a>
</div>

<!-- Table for Majors -->
<table id="majorsTable" class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Major Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($majors as $major)
        <tr>
            <td>{{ $major->id }}</td>
            <td>{{ $major->major_name }}</td>
            <td>{{ $major->description }}</td>
            <td>
                @if($major->image)
                    <img src="{{ asset('storage/' . $major->image) }}" alt="{{ $major->major_name }}" style="width: 50px; height: 50px;">
                @else
                    <span>No Image</span>
                @endif
            </td>
            <td>
                <!-- Detail Button - Visible to All -->
                <a href="/detail/{{ $major->id }}" class="btn btn-warning btn-sm ms-4 text-white">
                    <i class="fa fa-eye"></i> Detail
                </a>
                @if($major->user_id == auth()->id())
                    <!-- Edit Button -->
                    <a href="/edit/{{ $major->id }}" class="btn btn-primary btn-sm text-white ms-4">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                
                    <form id="delete-form-{{ $major->id }}" action="{{ url('/delete', $major->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    
                    <button onclick="confirmDeletion({{ $major->id }})" class="btn btn-danger btn-sm ms-4">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                    
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- DataTables Initialization Script -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#majorsTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
        });
    });

    // SweetAlert deletion confirmation
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
