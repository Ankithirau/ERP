@extends('layouts.master')
@section('content')
<div id="app" class="container-scroller">
        @include('partials.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('partials.sidebar')
        @yield('panel')
    </div>
</div>
@endsection