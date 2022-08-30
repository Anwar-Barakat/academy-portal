<!-- Dashboard -->
<li>
    <a href="{{ route('student.dashboard') }}" data-toggle="collapse" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-home"></i><span class="right-nav-text">{{ __('trans.dashboard') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

<!-- Quizzes -->
<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-book-open"></i><span
                class="right-nav-text">{{ __('trans.quizzes') }}</span></div>
        <div class="clearfix"></div>
    </a>
</li>


<!-- Quizzes -->
<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-id-card-alt"></i><span
                class="right-nav-text">{{ __('trans.profile') }}</span></div>
        <div class="clearfix"></div>
    </a>
</li>
