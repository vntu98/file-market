@component('files.partials._file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    <a href="">Preview changes</a>
                </p>

                <p class="level-item">
                    <a href="" onclick="event.preventDefault(); document.getElementById('approve-{{ $file->id }}').submit()">Approve</a>
                </p>

                <form action="{{ route('admin.files.updated.update', $file) }}" method="POST" class="is-hidden" id="approve-{{ $file->id }}">
                    @csrf
                    @method('PATCH')
                </form>

                <p class="level-item">
                    <a href="" onclick="event.preventDefault(); document.getElementById('reject-{{ $file->id }}').submit()">Reject</a>
                </p>

                <form action="{{ route('admin.files.updated.destroy', $file) }}" method="post" class="is-hidden" id="reject-{{ $file->id }}">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    @endslot
@endcomponent