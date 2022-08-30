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
    <a href="{{ route('teacher.students.index') }}" data-target="#dashboard">
        <div class="pull-left">
            <i class="fas fa-user-graduate"></i>
            <span class="right-nav-text">{{ __('student.students') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
