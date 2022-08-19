@extends('layouts.master')
@section('css')
    @livewireStyles

@section('title')
    {{ __('parent.parents_list') }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.parents') }}
@endsection

@section('breadcrum_home')
{{ __('parent.parents_list') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <livewire:add-parent />
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(".custom-file-input").on("change", function() {
        var filename = $(this).val().split("\\").pop();
        alert('hi')
        $(this).siblings(".custom-file-label").addClass("selected").html(filename);
    });
</script>

@endsection
