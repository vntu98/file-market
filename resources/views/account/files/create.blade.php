@extends('account.layouts.default')

@section('account.content')
    <h1 class="title">Sell a file</h1>
    <form action="{{ route('upload.store', ['file' => $file]) }}" method="POST" id="formUpload" class="form" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file" multiple>

        <div style="margin-top: 10px; margin-bottom: 20px" class="field is-grouped">
            <p class="control">
                <button id="upload" class="button is-primary">Upload</button>
            </p>
        </div>
    </form>
    <form action="{{ route('account.files.store', ['file' => $file]) }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="uploads" value="{{ $file->id }}">

        <div class="field">
            <label for="title" class="label">Title</label>
            <p class="control">
                <input type="text" name="title" id="title" class="input {{ $errors->has('title') ? 'is-danger' : '' }}">
            </p>
            @if ($errors->has('title'))
                <p class="help is-danger">{{ $errors->first('title') }}</p>
            @endif
        </div>

        <div class="field">
            <label for="overview_short" class="label">Overview short</label>
            <p class="control">
                <input type="text" name="overview_short" id="overview_short" class="input {{ $errors->has('overview_short') ? 'is-danger' : '' }}">
            </p>
            @if ($errors->has('overview_short'))
                <p class="help is-danger">{{ $errors->first('overview_short') }}</p>
            @endif
        </div>

        <div class="field">
            <label for="overview" class="label">Overview</label>
            <p class="control">
                <textarea name="overview" id="overview" class="textarea {{ $errors->has('overview') ? 'is-danger' : '' }}"></textarea>
            </p>
            @if ($errors->has('overview'))
                <p class="help is-danger">{{ $errors->first('overview') }}</p>
            @endif
        </div>

        <div class="field">
            <label for="price" class="label">Price</label>
            <p class="control">
                <input type="text" name="price" id="price" class="input {{ $errors->has('price') ? 'is-danger' : '' }}">
            </p>
            @if ($errors->has('price'))
                <p class="help is-danger">{{ $errors->first('price') }}</p>
            @endif
        </div>

        <div class="field is-grouped">
            <p class="control">
                <button class="button is-primary">Submit</button>
            </p>
            <p>We'll review your file before it goes file</p>
        </div>
    </form>
@endsection

@section('scripts')
    @include('account.files.partials._file_upload_js', compact('file'))
@endsection