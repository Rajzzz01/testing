@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
            @include('backcompanies.form')

            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>
@endsection