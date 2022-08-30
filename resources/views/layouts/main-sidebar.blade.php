<!-- Left Sidebar start-->
<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            @if (Auth::guard('web')->check())
                @include('layouts.sidebars.admin-sidebar')
            @endif
            @if (Auth::guard('teacher')->check())
                @include('layouts.sidebars.teacher-sidebar')
            @endif
            @if (Auth::guard('parent')->check())
                @include('layouts.sidebars.parent-sidebar')
            @endif
            @if (Auth::guard('student')->check())
                @include('layouts.sidebars.student-sidebar')
            @endif
        </ul>
    </div>
</div>

<!-- Left Sidebar End-->
