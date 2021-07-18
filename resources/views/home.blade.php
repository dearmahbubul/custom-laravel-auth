@extends('layout.app')
@section('title','Login')
@push('header_scripts')

@endpush
@section('main')
    <div class="wrapper">
        <div id="formContent">
            <h2>Welcome to the {{env('APP_NAME')}}</h2>
            <br>
            @auth
                Hello {{auth()->user()->name}}
            @endauth
        </div>
    </div>
@endsection

@push('footer_scripts')

@endpush
