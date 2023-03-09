@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Employee List
                        </div>
                        <div class="text-info text-uppercase">
                            <a href="{{ route('employees.create') }}"><button type="button"
                                    class="btn btn-success btn-sm float-right"><i class="fa fa-plus">New
                                        Employee</i></button></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead class="bg-gradient-navy">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-light">
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->first_name }}</td>
                                        <td>{{ $employee->last_name }}</td>
                                        <td>{{ $employee->company->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>
                                            <a href="{{ route('employees.edit', $employee->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')" style="display: inline;"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $employees->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
