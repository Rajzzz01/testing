@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('company.update', ['company' => $company]) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @include('backcompanies.form')

            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>
    @section('page-specific-js')
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#animal-standing')
                            .attr('src', e.target.result)
                            .width(160)
                            .height(80);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endsection
@endsection