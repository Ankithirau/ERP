@extends('layouts.app')

@section('content')

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo h3 text-primary">
                            Sunny's Spring Dale School
                        </div>
                        <h4>Forgot Your Password?</h4>
                        <h6 class="font-weight-light">Enter your email to reset your password.</h6>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="pt-3" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email"
                                    class="form-control form-control-sm @error('email') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="Email Address" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary btn-sm font-weight-medium auth-form-btn">
                                    Send Password Reset Link
                                </button>
                            </div>

                            <div class="my-2 d-flex justify-content-between align-items-center mt-3">
                                <a class="auth-link text-black text-decoration-none" href="{{ route('login') }}">
                                    Back to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@endsection
