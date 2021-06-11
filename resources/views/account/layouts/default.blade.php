@extends('layouts.app')

@section('content')
    @include('account.layouts.partials._stats')
    <div style="margin-top: 30px;" class="container">
        <div class="columns">
            <div class="column is-one-quarter">
                @include('account.layouts.partials._navigation')
            </div>
            <div class="column">
                @include('account.layouts.partials._flash')
                @yield('account.content')
            </div>
        </div>
    </div>
@endsection