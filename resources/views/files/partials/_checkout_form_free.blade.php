<form action="{{ route('checkout.free', $file) }}" method="POST">
    @csrf

    <span class="field has-addons">
        <p class="control">
            <input type="email" name="email" class="input" id="email" placeholder="you@somewhere.com" value="{{ old('email') }}">
        </p>
        <p class="control">
            <button class="button is-primary">Download for free</button>
        </p>
    </span>
    @if ($errors->has('email'))
        <p class="help is-danger">{{ $errors->first('email') }}</p>
    @endif
</form>