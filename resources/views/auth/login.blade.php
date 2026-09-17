@extends('layouts.app')

@section('title', 'Admin Login | Thida Blog')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card p-4 p-md-5">
            <h1 class="mb-4">Admin Login</h1>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required
                        autofocus
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </form>
          </div>
        </div>
    </div>
@endsection
