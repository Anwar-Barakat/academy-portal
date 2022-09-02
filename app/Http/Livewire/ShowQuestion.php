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
        $degrees = 0,
        $questionCount = 0;




    public function render()
    {
        $this->data = Question::where('quiz_id', $this->quiz_id)->orderBy('id', 'asc')->get();
        $this->questionCount = $this->data->count();
        return view('livewire.show-question', ['data']);
    }

    public function nextQuestion($score, $answer, $right_answer)
    {

        if (strcmp(trim($answer), trim($right_answer)) == 0) {
            $this->degrees += $score;
        }


        if ($this->counter == $this->questionCount - 1) {

            Degree::updateOrCreate([
                'quiz_id'       => $this->quiz_id,
                'student_id'    => $this->student_id,
            ], [
                'quiz_id'       => $this->quiz_id,
                'student_id'    => $this->student_id,
                'degree'        => $this->degrees,
                'date'          => date('Y-m-d'),
            ]);
        }

        if ($this->counter < $this->questionCount - 1) {
            $this->counter++;
        } else {
            toastr()->success(__('msgs.finished', ['name' => __('trans.quiz')]));
            return redirect()->route('student.quizzes.index');
        }
    }
}