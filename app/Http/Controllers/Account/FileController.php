<?php

namespace App\Http\Controllers\Account;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function create(File $file)
    {
        if (!$file->exists) {
            $file = $this->createAndReturnSkeletonFile();

            return redirect()->route('account.files.create', $file);
        }
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
