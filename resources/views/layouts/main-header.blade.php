@php
    $setting = App\Models\Setting::all();
@endphp

<!--================================= header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper d-flex pl-3">
        <a class="navbar-brand brand-logo d-flex" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('attachments/logo/logo-icon.png') }}" alt="" style="border-radius: inherit; max-width: 60px">
            <span class="mobile-hidden">AN Academy <br>Managment</span>
        </a>
    </div>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);">
                <i class="zmdi zmdi-menu ti-align-right"></i>
            </a>
        </li>
        <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                    <input type="text" class="not-click form-control" placeholder="Search" value="" name="search">
                    <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </div>
            </div>
        </li>
    </ul>



    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto align-items-center">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-language language-toggle" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </div>
        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>
        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('attachments/logo/logo-icon.png') }}" alt="" style="border-radius: inherit;">
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            @if (Auth::guard('web')->check())
                                <h5 class="mt-0 mb-0">{{ Auth::guard('web')->user()->name }}</h5>
                                <span>{{ Auth::guard('web')->user()->email }}</span>
                            @endif
                            @if (Auth::guard('teacher')->check())
                                <h5 class="mt-0 mb-0">{{ Auth::guard('teacher')->user()->name }}</h5>
                                <span>{{ Auth::guard('teacher')->user()->email }}</span>
                            @endif
                            @if (Auth::guard('parent')->check())
                                <h5 class="mt-0 mb-0">{{ Auth::guard('parent')->user()->name }}</h5>
                                <span>{{ Auth::guard('parent')->user()->email }}</span>
                            @endif
                            @if (Auth::guard('student')->check())
                                <h5 class="mt-0 mb-0">{{ Auth::guard('student')->user()->name }}</h5>
                                <span>{{ Auth::guard('student')->user()->email }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                @if (auth('student')->check())
                    <a class="dropdown-item" href="{{ route('student.profile.index') }}"><i class="text-info ti-settings"></i>{{ __('trans.settings') }}</a>
                    <form method="GET" action="{{ route('all.logout', 'student') }}">
                        @csrf
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();">
                            <i class="fas fa-sign-out"></i> {{ __('trans.logout') }}
                        </a>
                    </form>
                @elseif (auth('parent')->check())
                    <a class="dropdown-item" href="{{ route('parent.profile.index') }}"><i class="text-info ti-settings"></i>{{ __('trans.settings') }}</a>
                    <form method="GET" action="{{ route('all.logout', 'parent') }}">
                        @csrf
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();">
                            <i class="fas fa-sign-out"></i> {{ __('trans.logout') }}
                        </a>
                    </form>
                @elseif (auth('teacher')->check())
                    <a class="dropdown-item" href="{{ route('student.profile.index') }}"><i class="text-info ti-settings"></i>{{ __('trans.settings') }}</a>
                    <form method="GET" action="{{ route('all.logout', 'teacher') }}">
                        @csrf
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();">
                            <i class="fas fa-sign-out"></i> {{ __('trans.logout') }}
                        </a>
                    </form>
                @else
                    <a class="dropdown-item" href="{{ route('settings.index') }}"><i class="text-info ti-settings"></i>{{ __('trans.settings') }}</a>
                    <form method="GET" action="{{ route('all.logout', 'web') }}">
                        @csrf
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();">
                            <i class="fas fa-sign-out"></i> {{ __('trans.logout') }}
                        </a>
                    </form>
                @endif
            </div>
        </li>
    </ul>
</nav>
