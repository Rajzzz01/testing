@extends('layouts.app')

@section('content')
    <div class="float-right">
        <a class="btn btn-primary btn-sm" href="{{ route('company.create') }}">Add Company</a>
    </div>
    <br>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif

    <div>
        <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>No</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
            @foreach ($companies as $data)
                <tr>
                    <td>{{ !empty($data->id) ? $data->id : 'No Records' }}</td>
                    <td>{{ !empty($data->name) ? $data->name : 'No Records' }}</td>
                    <td>{{ !empty($data->email) ? $data->email : 'No Records' }}</td>
                    <td><img src="{{ asset('storage/'.$data->logo) }}" height="100" width="100"></td>
                    <td>{{ !empty($data->website) ? $data->website : 'No Records' }}</td>
                    <td>
                        <form action="{{ route('company.destroy',['company' => $data]) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('company.edit',['company' => $data]) }}"><i class="fa fa-pencil"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>    
    {!! $companies->links() !!}


@endsection
