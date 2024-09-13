@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card align-middle justify-content-center align-items-center">
                <h2></h2>
                <div class="modal-body m-4">
                    <form action="{{ isset($position) ? route('update/position', $position->id) : route('create/position') }}" method="POST">
                        @csrf
                        @if(isset($position))
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $position->id }}">
                        @endif
                        <div class="m-2 col-12 col-sm-12">
                            <div class="form-group">
                                <label class="fw-bold">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', isset($position) ? $position->name : '') }}" required>
                            </div>
                        </div>
                        <div class="m-2 col-12 col-sm-12">
                            <div class="form-group">
                                <label class="fw-bold">Reports To:</label>
                                <select class="form-select" id="reports_to" name="reports_to">
                                    <option value="">-- Select Position --</option>
                                    @foreach($positions as $pos)
                                        <option value="{{ $pos->id }}" {{ old('reports_to', isset($position) ? $position->reports_to : '') == $pos->id ? 'selected' : '' }}>
                                            {{ $pos->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="m-2 mb-0 pt-3 pb-3 text-center">
                            <button class="btn btn-success btn-block" type="submit">{{ isset($position) ? 'Update' : 'Submit' }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-4 container justify-content-center align-items-center">
                <table id="positionsTable" class="display cell-border" style="width:100%">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Reports To</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $position)
                            <tr>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->reportsTo ? $position->reportsTo->name : 'None' }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('edit/position', $position->id) }}" class="btn btn-sm btn-primary me-2">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('destroy/position', $position->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#positionsTable').DataTable({
            paging: true, 
            ordering: true, 
            info: true, 
            responsive: true 
        });
    });
</script>
@endsection
