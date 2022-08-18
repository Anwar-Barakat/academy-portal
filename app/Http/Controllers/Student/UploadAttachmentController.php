<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class UploadAttachmentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->only(['student_name', 'student_id']);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $photo) {
                $name   = $photo->getClientOriginalName();
                $photo->storeAs('attachments/students/' . $data['student_name'], $name, 'students_attachments');

                $image                  = new Image();
                $image->file_name       = $name;
                $image->imageable_id    = $data['student_id'];
                $image->imageable_type  = 'App\Models\Student';
                $image->save();
            }

            toastr()->success(__('msgs.added', ['name' => __('trans.attachments')]));
            return redirect()->back();
        }
    }
}