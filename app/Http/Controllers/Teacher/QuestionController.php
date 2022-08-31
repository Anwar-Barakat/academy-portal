<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        try {
            if ($request->isMethod('post')) {
                $data                   = $request->only(['title_ar', 'title_en', 'all_answers', 'right_answer', 'degrees', 'quiz_id']);
                $data['title']['ar']    = $data['title_ar'];
                $data['title']['en']    = $data['title_en'];

                Question::create($data);

                toastr()->success(__('msgs.added', ['name' => __('trans.question')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz   = Quiz::findOrFail($id);
        return view('pages.teachers.question.create', ['quiz' => $quiz]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question   = Question::findOrFail($id);
        return view('pages.teachers.question.edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, $id)
    {
        try {
            if ($request->isMethod('put')) {
                $data                   = $request->only(['title_ar', 'title_en', 'all_answers', 'right_answer', 'degrees', 'quiz_id']);
                $data['title']['ar']    = $data['title_ar'];
                $data['title']['en']    = $data['title_en'];
                $question = Question::where('quiz_id', $data['quiz_id'])->where('id', $id)->first();

                $question->update($data);

                toastr()->success(__('msgs.updated', ['name' => __('trans.question')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $question = Question::findOrFail($id);
            $question->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('trans.question')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}