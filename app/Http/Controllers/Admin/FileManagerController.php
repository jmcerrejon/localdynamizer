<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;

class FileManagerController
{
    public function __invoke(): View
    {
        return view('admin.file-manager.index');
    }
}
