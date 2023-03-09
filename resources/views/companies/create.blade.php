@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            New Company
                        </div>
                        <div class="text-info text-uppercase float-right">
                            <a href="{{ route('companies.index') }}" target="_self">
                                <button type="button" class="btn btn-success btn-sm"><i class="fa fa-list">Company
                                        List</i></button>
                            </a>
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
                        <form method="POST" action="{{ route('companies.store') }}" class="form"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Company Name</label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text"
                                        class="form-control @error('company_name') is-invalid @enderror" name="company_name"
                                        value="{{ old('company_name') }}">

                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="logo" class="col-md-4 col-form-label text-md-right">Logo</label>

                                <div class="col-md-6">
                                    <input id="logo" type="file"
                                        class="form-control @error('logo') is-invalid @enderror" name="logo"
                                        value="{{ old('logo') }}">

                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="website" class="col-md-4 col-form-label text-md-right">Website</label>

                                <div class="col-md-6">
                                    <input id="website" type="text"
                                        class="form-control @error('website') is-invalid @enderror" name="website"
                                        value="{{ old('website') }}">

                                    @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('div.alert').delay(2000).slideUp(300);
    </script>
@endsection
