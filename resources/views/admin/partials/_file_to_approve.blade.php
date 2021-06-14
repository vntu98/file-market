@component('files.partials._file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    <a href="">Preview file</a>
                </p>
                <p class="level-item">
                    <a href="" onclick="event.preventDefault(); document.getElementById('approve-{{ $file->id }}').submit()">Approve</a>
                </p>

                <form action="{{ route('admin.files.new.update', $file) }}" method="POST" class="is-hidden" id="approve-{{ $file->id }}">
                    @csrf
                </form>

                <p class="level-item">
                    <a href="" onclick="event.preventDefault(); document.getElementById('reject-{{ $file->id }}').submit()">Reject</a>
                </p>

                <form action="{{ route('admin.files.new.destroy', $file) }}" method="post" class="is-hidden" id="reject-{{ $file->id }}">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    @endslot
@endcomponent