<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFileTrait
{
    public function uploadFile($request, $folder, $owner,  $name)
    {
        $file_name  = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/' . $folder . '/' . $owner . '/', $file_name, 'upload_attachments');
    }
}