@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
            @include('backemployees.form')

            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>
@endsection