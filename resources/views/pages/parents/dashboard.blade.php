@extends('layouts.master')


@section('title')
    {{ __('trans.dashboard') }}
@endsection

@section('breadcrum')
    {{ __('trans.dashboard') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.dashboard') }}
@endsection

@section('content')
    <!-- Orders Status widgets-->

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row justify-content-center">
                @if (isset($children) && $children->count() > 0)
                    @forelse ($children as $child)
                        <div class="col-md-6 col-lg-6 col-xl-3 mb-4">
                            <a href="">
                                <div class="card text-black">
                                    <img src="{{ URL::asset('assets/images/vectors/student.png') }}" width="200"
                                        class="img   d-block m-auto" />
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5 class="card-title">
                                                {{ $child->name }}</h5>
                                            <p class="text-muted mb-4">معلومات الطالب</p>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <span>المرحلة</span><span>{{ $child->grade->name }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>الصف</span><span>{{ $child->classroom->name }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>القسم</span><span>{{ $child->section->name }}</span>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                {{-- @if (\App\Models\Degree::where('student_id', $child->id)->count() == 0) --}}
                                                {{-- <span>عدد الاختبارات</span><span --}}
                                                {{-- class="text-danger">{{\App\Models\Degree::where('student_id',$child->id)->count()}}</span> --}}
                                                {{-- @else --}}
                                                {{-- <span>عدد الاختبارات</span><span --}}
                                                {{-- class="text-success">{{\App\Models\Degree::where('student_id',$child->id)->count()}}</span> --}}
                                                {{-- @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                @endif
            </div>
        </div>
    </section>
@endsection
