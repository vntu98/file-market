<?php

namespace App\Http\Controllers\Account;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Requests\File\UpdateFileRequest;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $files = auth()->user()->files()->latest()->finished()->get();

        return view('account.files.index', compact('files'));
    }

    public function edit(File $file)
    {
        $this->authorize('touch', $file);
        
        return view('account.files.edit', compact('file'));
    }

    public function create(File $file)
    {
        if (!$file->exists) {
            $file = $this->createAndReturnSkeletonFile();

            return redirect()->route('account.files.create', $file);
        }

        $this->authorize('touch', $file);

        return view('account.files.create', compact('file'));
    }

    public function update(UpdateFileRequest $request, File $file)
    {
        $this->authorize('touch', $file);

        if ($file->needsApproval($request->only(File::APPROVAL_PROPERTIES))) {
            return;
        }

        $file->update([
            'live' => $request->get('live', false) !== "false" ? true : false,
            'price' => $request->price
        ]);

        return back()->withSuccess('File updated!');
    }

    public function store(StoreFileRequest $request)
    {
        $file = File::query()->where('identifier', $request->file)->firstOrFail();
        $this->authorize('touch', $file);

        $file->fill($request->only(['title', 'overview', 'overview_short', 'price']));
        $file->finished = true;
        $file->save();

        return redirect()->route('account.files.index')
            ->withSuccess('Thanks, submitted for review');
    }

    protected function createAndReturnSkeletonFile()
    {
        return auth()->user()->files()->create([
            'title' => 'Untitle',
            'overview' => 'None',
            'overview_short' => 'None',
            'price' => 0,
            'finished' => false
        ]);
    }
}
