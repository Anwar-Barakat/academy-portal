<?php

namespace App\Http\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait AttachFileTrait
{
    public function uploadFile($request, $folder, $owner, $ownerId,  $name, $modal)
    {
        $file_name  = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/' . $folder . '/' . $owner . '/', $file_name, 'upload_attachments');

        $image                  = new Image();
        $image->file_name       = $file_name;
        $image->imageable_id    = $ownerId;
        $image->imageable_type  = "App\Models\\" . $modal;
        $image->save();
    }
}