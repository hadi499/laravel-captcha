@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <main class="form-registration">

                <h1 class="h3 mb-3 fw-normal text-center">Register Form</h1>
                <form action="/register" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" id="name"
                            placeholder="Name" required value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control @error('email')is-invalid @enderror"
                            id="email" placeholder="Email" required value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password')is-invalid @enderror" id="password"
                            placeholder="Password" required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">

                        {!! NoCaptcha::display() !!}

                        @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                        @endif
                    </div>

                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>

                </form>
                <small class="d-block text-center mt-3">Already registered? <a href="/login">Login</a></small>

            </main>

        </div>
    </div>
</div>

@endsection