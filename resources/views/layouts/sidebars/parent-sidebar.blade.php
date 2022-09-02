<!-- Dashboard -->
<li>
    <a href="{{ route('parent.dashboard') }}" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-school"></i><span class="right-nav-text">{{ __('trans.dashboard') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
<!-- menu title -->
<li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans.components') }} </li>

{{-- Children --}}
<li>
    <a href="{{ route('parent.children.index') }}" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-user-graduate"></i><span
                class="right-nav-text">{{ __('parent.children') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

{{-- Attendances Reports --}}
<li>
    <a href="{{ route('parent.attendances-report.index') }}" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                class="right-nav-text">{{ __('trans.attendances') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>

{{-- Fees Reports --}}
<li>
    <a href="{{ route('parent.children_fees') }}" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-money-check-alt"></i><span
                class="right-nav-text">{{ __('trans.accounts') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>


{{-- Profile --}}
<li>
    <a href="{{ route('parent.dashboard') }}" data-target="#quizzes-menu">
        <div class="pull-left"><i class="fas fa-id-card-alt"></i><span
                class="right-nav-text">{{ __('trans.profile') }}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
