<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get the image with slug format
     *
     * @param  String  $path
     * @return void
     */
	public function delFile($path)
	{
		if (Storage::disk('public')->exists($path)) {
			return Storage::disk('public')->delete($path);
		}

		return false;
	}
}
