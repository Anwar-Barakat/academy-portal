<?php

namespace App\Repositories\Repository;

use App\Http\Traits\AttachFileTrait;
use App\Models\Grade;
use App\Models\Library;
use App\Repositories\Interface\LibraryRepositoryInterface;

class LibraryRepository implements LibraryRepositoryInterface
{
    use AttachFileTrait;
    public function index()
    {
        $library    = Library::latest()->get();
        return view('pages.library.index', ['library' => $library]);
    }

    public function create()
    {
        $grades     = Grade::all();
        return view('pages.library.create', ['grades' => $grades]);
    }

    public function store($request)
    {
        if ($request->isMethod('post')) {
            try {
                Library::create([
                    'title'         => $request->title,
                    'file_name'     => $request->file('file_name')->getClientOriginalName(),
                    'grade_id'      => $request->grade_id,
                    'classroom_id'  => $request->classroom_id,
                    'section_id'    => $request->section_id,
                    'teacher_id'    => 1,
                ]);

                $this->uploadFile($request, 'file_name');

                toastr()->success(__('msgs.added', ['name' => __('trans.book')]));
                return redirect()->back();
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['error' => $th->getMessage()]);
            }
        }
    }

    public function edit($library)
    {
        $grades     = Grade::all();
        return view('pages.library.edit', ['grades' => $grades, 'library' => $library]);
    }

    public function update($request, $library)
    {
        if ($request->isMethod('put')) {
            try {
                if ($request->hasFile('file_name')) {
                    $this->deleteFile($library->file_name);

                    $this->uploadFile($request, 'file_name');

                    $file_name = $request->file('file_name')->getClientOriginalName();
                } else
                    $file_name = $library->file_name;




                $library->update([
                    'title'         => $request->title,
                    'file_name'     => $file_name,
                    'grade_id'      => $request->grade_id,
                    'classroom_id'  => $request->classroom_id,
                    'section_id'    => $request->section_id,
                    'teacher_id'    => 1,
                ]);

                toastr()->success(__('msgs.updated', ['name' => __('trans.book')]));
                return redirect()->back();
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['error' => $th->getMessage()]);
            }
        }
    }

    public function destroy($library)
    {
        try {
            $this->deleteFile($library->file_name);
            $library->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('trans.book')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}