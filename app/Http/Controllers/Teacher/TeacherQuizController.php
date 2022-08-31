<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes    = Quiz::where('teacher_id', Auth::guard('teacher')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('pages.teachers.quizzes.index', ['quizzes' => $quizzes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionIds         = Teacher::findOrFail(Auth::guard('teacher')->id())->sections()->pluck('section_id');

        $sections           = Section::with(['grade', 'classroom'])->whereIn('id', $sectionIds)->get();

        $subjects           = Subject::where('teacher_id', Auth::guard('teacher')->user()->id)->get();

        return view('pages.teachers.quizzes.create', ['sections' => $sections, 'subjects' => $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizRequest $request)
    {
        try {
            if ($request->isMethod('post')) {
                $data               = $request->only(['grade_id', 'classroom_id', 'section_id', 'subject_id']);
                $data['name']['ar'] = $request->name_ar;
                $data['name']['en'] = $request->name_en;
                $data['teacher_id'] = Auth::guard('teacher')->user()->id;

                Quiz::create($data);

                toastr()->success(__('msgs.added', ['name' => __('trans.quiz')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        $questions      = Question::with(['quiz'])->where('quiz_id', $quiz->id)->latest()->get();
        return view('pages.teachers.question.index', ['quiz' => $quiz, 'questions' => $questions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        $sectionIds         = Teacher::findOrFail(Auth::guard('teacher')->id())->sections()->pluck('section_id');

        $sections           = Section::with(['grade', 'classroom'])->whereIn('id', $sectionIds)->get();

        $subjects           = Subject::where('teacher_id', Auth::guard('teacher')->user()->id)->get();

        return view('pages.teachers.quizzes.edit', ['sections' => $sections, 'subjects' => $subjects, 'quiz' => $quiz]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        try {
            if ($request->isMethod('put')) {
                $data               = $request->only(['grade_id', 'classroom_id', 'section_id', 'subject_id']);
                $data['name']['ar'] = $request->name_ar;
                $data['name']['en'] = $request->name_en;
                $data['name']['en'] = $request->name_en;
                $data['teacher_id'] = Auth::guard('teacher')->user()->id;


                $quiz->update($data);

                toastr()->success(__('msgs.updated', ['name' => __('trans.quiz')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        try {
            $quiz->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('trans.quiz')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}