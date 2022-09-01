<li>
    <a href="{{ route('teacher.dashboard') }}" data-target="#dashboard">
        <div class="pull-left">
            <i class="fas fa-school"></i>
            <span class="right-nav-text">{{ __('trans.dashboard') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
<!-- menu title -->
<li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans.components') }} </li>

<li>
    <a href="{{ route('teacher.sections.index') }}" data-target="#dashboard">
        <div class="pull-left">
            <i class="fas fa-th-large"></i>
            <span class="right-nav-text">{{ __('section.sections') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

<li>
    <a href="{{ route('teacher.students.index') }}" data-target="#dashboard">
        <div class="pull-left">
            <i class="fas fa-user-graduate"></i>
            <span class="right-nav-text">{{ __('student.students') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-folder-open"></i></i><span
                class="right-nav-text">{{ __('trans.quizzes') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="quizzes-menu" class="collapse" data-parent="#sidebarnav">
        <li> <a href="{{ route('teacher.quizzes.index') }}">{{ __('trans.list', ['name' => __('trans.quizzes')]) }} </a>
        </li>
        <li> <a href="">{{ __('trans.list', ['name' => __('trans.questions')]) }}</a> </li>
    </ul>
</li>


<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#reports-menu">
        <div class="pull-left"><i class="fas fa-calendar-alt"></i></i><span
                class="right-nav-text">{{ __('teacher.reports') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="reports-menu" class="collapse" data-parent="#sidebarnav">
        <li> <a href="{{ route('teacher.attendances-report.index') }}">{{ __('teacher.attendace_reports') }} </a>
        </li>
        <li> <a href="">{{ __('teacher.quizzes_reports') }} </a> </li>
    </ul>
</li>

<!-- Zoom -->
<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#zooms-menu">
        <div class="pull-left"><i class="fas fa-video-camera"></i><span
                class="right-nav-text">{{ __('trans.online_classes') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="zooms-menu" class="collapse" data-parent="#sidebarnav">
        <li>
            <a href="{{ route('teacher.online-classess.index') }}">
                {{ __('trans.list', ['name' => __('trans.online_classes')]) }}
            </a>
        </li>
    </ul>
</li>

<!-- Profile -->
<li>
    <a href="{{ route('teacher.profile.index') }}"data-target="#profile-menu">
        <div class="pull-left"><i class="fas fa-id-card-alt"></i><span
                class="right-nav-text">{{ __('teacher.profile') }}</span></div>
        <div class="clearfix"></div>
    </a>
</li>
