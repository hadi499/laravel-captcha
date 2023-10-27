@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @endif
            @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @endif
            <main class="form-signin">

                <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>
                <form action="/login" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email')is-invalid @enderror" name="email"
                            id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                            required>
                    </div>
                    <div class="mb-3">

                        {!! NoCaptcha::display() !!}

                        @if ($errors->has('g-recaptcha-response'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="mb-3">

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                    </div>



                </form>
                <small class="d-block text-center mt-3">Not registered? <a href="/register">Register now!</a></small>
            </main>

        </div>
    </div>
</div>

@endsection