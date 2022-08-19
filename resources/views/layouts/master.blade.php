<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')
</head>

<body>
    <div class="wrapper">

        <!--================================= preloader -->

        <div id="pre-loader">
            <img src="{{ asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

        <!--================================= preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--================================= Main content -->
        <!-- main-content -->
        <div class="content-wrapper">

            @yield('page-header')

            <!-- breadcrumb -->
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0">@yield('breadcrum')</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                    class="default-color">{{ __('grade.home') }}</a></li>
                            <li class="breadcrumb-item active">@yield('breadcrum_home')</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- breadcrumb -->

            @yield('content')

            <!--================================= footer -->
            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>

    <!--================================= footer -->

    @include('layouts.footer-scripts')
</body>

</html>
