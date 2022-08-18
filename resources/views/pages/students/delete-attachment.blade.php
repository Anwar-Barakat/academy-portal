{{-- Delete The Grade --}}
<div class="modal fade" id="deleteImage{{ $img->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteAttachmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="deleteAttachmentLabel">
                    {{ __('msgs.delete', ['name' => __('trans.attachment')]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('delete_student_attachment') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <x-input type="hidden" name="id" :value="$img->id" />
                    <x-input type="hidden" name="student_id" :value="$img->imageable->id" />
                    <x-input type="hidden" name="student_name" :value="$img->imageable->name" />
                    <x-input type="hidden" name="file_name" :value="$img->file_name" />
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('msgs.deleting_warning') }}
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('buttons.close') }}</button>
                    <x-button class="btn btn-danger">
                        {{ __('buttons.delete') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>
</div>
