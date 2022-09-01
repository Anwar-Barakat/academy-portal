<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ShowQuestion extends Component
{
    public $quiz_id,
        $student_id,
        $data,
        $counter = 0,
        $questionCount = 0;




    public function render()
    {
        $this->data = Question::where('quiz_id', $this->quiz_id)->orderBy('id', 'asc')->get();
        return view('livewire.show-question', ['data']);
    }

    public function nextQuestion($question_id, $score, $answer, $right_answer)
    {
        $stuDegree = Degree::where('student_id', $this->student_id)
            ->where('quiz_id', $this->quiz_id)
            ->first();
        // insert
        if ($stuDegree == null) {
            $degree                 = new Degree();
            $degree->quiz_id        = $this->quiz_id;
            $degree->student_id     = $this->student_id;
            $degree->question_id    = $question_id;
            if (strcmp(trim($answer), trim($right_answer)) === 0) {
                $degree->degree += $score;
            } else {
                $degree->degree += 0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();
        } else {

            // update
            if ($stuDegree->question_id >= $this->data[$this->counter]->id) {
                $stuDegree->degree = 0;
                $stuDegree->abuse = '1';
                $stuDegree->save();
                toastr()->error('تم إلغاء الاختبار لإكتشاف تلاعب بالنظام');
                return redirect()->route('student.quizzes.index');
            } else {

                $stuDegree->question_id = $question_id;
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                    $stuDegree->degree += $score;
                } else {
                    $stuDegree->degree += 0;
                }
                $stuDegree->save();
            }
        }

        if ($this->counter < $this->questionCount - 1) {
            $this->counter++;
        } else {
            toastr()->success('تم إجراء الاختبار بنجاح');
            return redirect()->route('student.quizzes.index');
        }
    }
}