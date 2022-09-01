{{-- Delete The Fee Invoice --}}
<div class="modal fade" id="delete{{ $onlineClass->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ __('msgs.delete', ['name' => __('trans.subject')]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('teacher.online-classess.destroy', $onlineClass->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="meeting_id" value="{{ $onlineClass->meeting_id }}">
                    @method('DELETE')
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
