@extends('layouts.app')

@section('content')
    <div class="float-right">
        <a class="btn btn-primary btn-sm" href="{{ route('employee.create') }}">Add Employee</a>
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone No.</th>
                <th>Actions</th>
            </tr>
            @foreach ($employees as $data)
                <tr>
                    <td>{{ !empty($data->id) ? $data->id : 'No Records' }}</td>
                    <td>{{ !empty($data->company_id) ? $data->company->name : 'No Records' }}</td>
                    <td>{{ !empty($data->first_name) ? $data->first_name : 'No Records' }}</td>
                    <td>{{ !empty($data->last_name) ? $data->last_name : 'No Records' }}</td>
                    <td>{{ !empty($data->email) ? $data->email : 'No Records' }}</td>
                    <td>{{ !empty($data->phone_number) ? $data->phone_number : 'No Records' }}</td>
                    <td>
                        <form action="{{ route('employee.destroy',['employee' => $data]) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('employee.edit',['employee' => $data]) }}"><i class="fa fa-pencil"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>    
    {!! $employees->links() !!}


@endsection