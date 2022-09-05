<div>
    <div class="modal fade" id="delete{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">
                        {{ $title }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ $action }}">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('msgs.deleting_warning') }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button x-small secondary-button"
                            data-dismiss="modal">{{ __('buttons.close') }}</button>
                        <button type="submit" class="button x-small dengerous-button">
                            {{ __('buttons.delete') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
