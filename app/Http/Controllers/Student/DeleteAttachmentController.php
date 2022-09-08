<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteAttachmentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = $request->only(['id', 'student_id', 'student_name', 'file_name']);
        Storage::disk('students_attachments')->delete('attachments/students/' . $data['student_name'] . '/' . $data['file_name']);
        Image::where(['id' => $data['id'], 'file_name' => $data['file_name']])->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('trans.attachment')]));
        return redirect()->back();
    }
}
