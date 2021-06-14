@extends('layouts.app')

@section('content')
    @include('admin.layouts.partials._stats')
    <div style="margin-top: 30px;" class="container">
        <div class="columns">
            <div class="column is-one-quarter">
                @include('admin.layouts.partials._navigation')
            </div>
            <div class="column">
                @include('account.layouts.partials._flash')
                @yield('admin.content')
            </div>
        </div>
    </div>
@endsection