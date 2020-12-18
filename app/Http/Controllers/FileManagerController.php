<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FileManagerController
{
    public function __invoke(): View
    {
        return view('file-manager.index');
    }
}
