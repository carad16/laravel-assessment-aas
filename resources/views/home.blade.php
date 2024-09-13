@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card align-middle justify-content-center align-items-center">
                <div class="modal-body m-4">
                    <form action="{{ route('create/position') }}" method="POST">
                        @csrf
                            <div class="m-2 col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="m-2 col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Reports To:</label>
                                    <select class="form-control" id="reports_to" name="reports_to">
                                        <option value="">-- Select Position --</option>
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="m-2 mb-0 pt-3 pb-3 text-center">
                                <button class="btn btn-success btn-block" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
