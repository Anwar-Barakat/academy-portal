<button type="button" class="button x-small mb-4" wire:click="showParentForm">
    {{ __('msgs.add', ['name' => __('parent.parent')]) }}
</button>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif
<div class="table-responsive">
    <table id="datatable" class="table table-striped table-bordered p-0 table-hover table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('trans.email') }}</th>
                <th>{{ __('parent.father_name') }}</th>
                <th>{{ __('parent.father_identification') }}</th>
                <th>{{ __('parent.father_passport') }}</th>
                <th>{{ __('parent.father_phone') }}</th>
                <th>{{ __('trans.created_at') }}</th>
                <th>{{ __('buttons.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($my_parents as $my_parent)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $my_parent->email }}</td>
                    <td>{{ $my_parent->father_name }}</td>
                    <td>{{ $my_parent->father_identification }}</td>
                    <td>{{ $my_parent->father_passport }}</td>
                    <td>{{ $my_parent->father_phone }}</td>
                    <td>{{ $my_parent->created_at }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" wire:click="edit({{ $my_parent->id }})"
                            title="{{ __('buttons.update') }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})"
                            title="{{ __('buttons.delete') }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="8">{{ __('msgs.not_found_yet') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
