@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Company List
                        </div>
                        <div class="text-info text-uppercase">
                            <a href="{{ route('companies.create') }}"><button type="button"
                                    class="btn btn-success btn-sm float-right"><i class="fa fa-plus">New
                                        Company</i></button></a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead class="bg-gradient-navy">
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-light">
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>
                                            <a href="{{ route('companies.edit', $company->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
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
                        {!! $companies->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('div.alert').delay(2000).slideUp(300);
    </script>
@endsection
