<!-- Dashboard -->
<li>
    <a href="{{ route('student.dashboard') }}" data-toggle="collapse" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-school"></i><span class="right-nav-text">{{ __('trans.dashboard') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
<!-- menu title -->
<li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans.components') }} </li>

<!-- Quizzes -->
<li>
    <a href="{{ route('student.quizzes.index') }}" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-book-open"></i><span
                class="right-nav-text">{{ __('trans.quizzes') }}</span></div>
        <div class="clearfix"></div>
    </a>
</li>


<!-- Quizzes -->
<li>
    <a href="javascript:void(0);" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-id-card-alt"></i><span
                class="right-nav-text">{{ __('trans.profile') }}</span></div>
        <div class="clearfix"></div>
    </a>
</li>
