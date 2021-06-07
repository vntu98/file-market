@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">

                    @if (session('status'))
                        <div class="notification is-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 class="title">Recover your password</h1>
                    <form action="{{ route('password.email') }}" class="form" method="post">
                        @csrf

                        <div class="field">
                            <label for="email" class="label">Email</label>
                            <p class="control">
                                <input type="email" name="email" id="email" placeholder="e.g mabel@gmail.com" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" value="{{ old('email') }}">
                            </p>

                            @if ($errors->has('email'))
                                <p class="help is-danger">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>

                        <div class="field is-grouped">
                            <p class="control">
                                <button type="submit" class="button is-primary">Send email</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
