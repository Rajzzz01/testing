@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('employee.update', ['employee' => $employee]) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @include('backemployees.form')

            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>
    @section('page-specific-js')
    @endsection
@endsection