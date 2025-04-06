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
                        <h4>Confirm Your Password</h4>
                        <h6 class="font-weight-light">Please confirm your password before continuing.</h6>

                        <form class="pt-3" method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="form-group">
                                <input id="password" type="password" 
                                    class="form-control form-control-sm @error('password') is-invalid @enderror" 
                                    name="password" placeholder="Password" required autofocus>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary btn-sm font-weight-medium auth-form-btn">
                                    Confirm Password
                                </button>
                            </div>

                            <div class="my-2 d-flex justify-content-between align-items-center">
                                @if (Route::has('password.request'))
                                    <a class="auth-link text-black text-decoration-none mt-2" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                @endif
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
