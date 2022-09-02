<div>
    <div>
        <h4 class="mb-4 text-info">{{ $data[$counter]->title }}</h4>

        @php
            $allAnswers = explode('-', $data[$counter]->all_answers);
        @endphp

        @foreach ($allAnswers as $index => $answer)
            <div class="custom-control custom-radio mb-4" style="font-size: 1.2rem">
                <input type="radio" name="customRadio" id="customRadio{{ $index }}" class="custom-control-input">
                <label for="customRadio{{ $index }}" class="custom-control-label"
                    wire:click.prefetch="nextQuestion({{ $data[$counter]->degrees }}, '{{ $answer }}', '{{ $data[$counter]->right_answer }}')">
                    &nbsp; {{ $answer }}
                </label>
            </div>
        @endforeach
    </div>
</div>
