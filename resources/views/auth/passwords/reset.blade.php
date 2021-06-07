@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <h1 class="title">Choose a new password</h1>

                    <form action="{{ route('password.request') }}" class="form" method="post">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

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

                        <div class="field">
                            <label for="password" class="label">Choose a password</label>
                            <p class="control">
                                <input type="password" name="password" id="password" class="input {{ $errors->has('password') ? 'is-danger' : '' }}">
                            </p>

                            @if ($errors->has('password'))
                                <p class="help is-danger">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>

                        <div class="field is-grouped">
                            <p class="control">
                                <button type="submit" class="button is-primary">Change password</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
