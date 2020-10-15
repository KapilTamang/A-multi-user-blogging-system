<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title'){{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="@yield('meta_description')">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
     <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/content.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/glider.min.css') }}">
    <link rel="shortcut icon" type="image/jpg" href=" {{ asset('images/favicon.ico') }} "/>

</head>
<body>
    <div id="app">
        @include('layouts.nav')
        <main>
            @yield('content')
        </main>
    </div>
    @yield('scripts')

    {{-- Admin Dashboard blog dropdown --}}
    <script>
        $(function() {
            $('.admin-links > li').hover(function() {
                $(this).find('.my-dropdown-items').toggle('slow');
                if($(this).find('.toggle-icon').hasClass('fa fa-caret-right')){
                    $(this).find('.toggle-icon').removeClass('fa fa-caret-right').addClass('fa fa-caret-down '); 
                }
                else {
                    $(this).find('.toggle-icon').removeClass('fa fa-caret-down').addClass('fa fa-caret-right ');    
                }
                
            });
        });
    </script>

     {{-- Enabling Tooltip  --}}
     <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    {{-- Glider Slider js file --}}
    <script src="{{ asset('js/glider.min.js') }}"></script>
    <script src="{{ asset('js/author_show_slider.js') }}"></script>

    {{-- <script type="text/javascript">
        $('.toast').toast('show');
    </script> --}}

    {{-- SweetAlert CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    {{-- Alerts --}}
    @if(Session::has('loginSuccess'))
        <script src="{{ asset('js/alerts/login_success.js') }}"></script>
    @endif

    @if(Session::has('logoutSuccess'))
        <script src="{{ asset('js/alerts/logout_success.js') }}"></script>
    @endif

    @if(Session::has('registrationSuccess'))
        <script src="{{ asset('js/alerts/registration_success.js') }}"></script>
    @endif

    @if(Session::has('messageSuccess'))
        <script src="{{ asset('js/alerts/message_success.js') }}"></script>
    @endif

    @if(Session::has('blogPublish'))
        <script src=" {{ asset('js/alerts/blog_publish.js') }} "></script>
    @endif

    @if(Session::has('draftBlog'))
        <script src=" {{asset('js/alerts/blog_draft.js')}} "></script>
    @endif

    @if(Session::has('publishBlog'))
        <script src=" {{ asset('js/alerts/published_blog.js') }} "></script>
    @endif

    @if(Session::has('blogEdit'))
        <script src=" {{ asset('js/alerts/blog_edited.js') }} "></script>
    @endif

    @if(Session::has('blogRestore'))
        <script src=" {{ asset('js/alerts/blog_restored.js') }} "></script>
    @endif

    @if(Session::has('permanentDelete'))
        <script src=" {{ asset('js/alerts/permanent_delete.js') }} "></script>
    @endif

    @if(Session::has('categoryAdd'))
        <script src=" {{ asset('js/alerts/category_added.js') }} "></script>
    @endif

    @if(Session::has('categoryEdit'))
        <script src=" {{ asset('js/alerts/category_edited.js') }} "></script>
    @endif

    @if(Session::has('userRoleEdit'))
        <script src=" {{ asset('js/alerts/user_role_edited.js') }} "></script>
    @endif

    @if(Session::has('profileUpdate'))
        <script src=" {{ asset('js/alerts/profile_updated.js') }} "></script>
    @endif

    @if(Session::has('searchFieldEmpty'))
        <script src=" {{ asset('js/alerts/search_field_empty.js') }} "></script>
    @endif

    @if(Session::has('passwordReset'))
        <script src=" {{ asset('js/alerts/password_reset_success.js') }} "></script>
    @endif

    @if(Session::has('emailVerified'))
        <script src=" {{ asset('js/alerts/email_verification_success.js') }} "></script>
    @endif

    </body>
</html>
