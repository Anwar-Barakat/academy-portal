{{-- Delete The Section --}}
<div class="modal fade" id="returnStudent{{ $promotion->student_id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="deleteGradeLabel">
                    {{ __('msgs.return', ['name' => __('student.student')]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('students-promotions.destroy', 'test') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $promotion->id }}">
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('msgs.return_student_warning') }}
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('buttons.close') }}</button>
                    <x-button class="btn btn-danger">
                        {{ __('msgs.returned') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>
</div>
