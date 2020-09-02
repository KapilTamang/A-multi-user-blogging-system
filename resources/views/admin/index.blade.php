@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="width: 100%; height: 100vh; background:#fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.2); padding: 15px 0px 20px 0px;">
                <div class="row justify-content-center" style="padding: 0px 15px;">
                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            @if(Auth::user()->profile_image)
                            <img src="/images/user/{{ Auth::user()->profile_image }}" class="image-responsive" width="60px" alt="" style="border-radius: 50%; margin-bottom: 10px; border: 3px solid rgba(52, 144, 220, 0.8);">
                            @else
                            <i class="fa fa-user-circle" aria-hidden="true" style="font-size: 50px; color: #3490dc;"></i>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <p style="margin-bottom: 10px;">Welcome, <span style="color: #3490dc;">{{Auth::user()->name}}</span></p>
                    </div>
                    <div class="col-md-12" style="padding: 0;">
                        <div class="btn-group" style="width: 100%; padding: 10px 5px; background-color: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.5);">
                            <button class="btn" style="padding: 0; color: #3490dc;" data-toggle="tooltip" data-placement="top" title="messages"><i class="fa fa-envelope" aria-hidden="true" style="font-size: 18px;"></i>
                                <span class="badge badge-danger" style="position: absolute; margin-right: 10px; font-size: 10px;"> 5 </span>
                            </button>                      
                            <button class="btn" style="padding: 0; color: #3490dc;" data-toggle="tooltip" data-placement="top" title="notifications"><i class="fa fa-bell" aria-hidden="true" style="font-size: 18px;"></i></button>                    
                            <button class="btn" style="padding: 0; color: #3490dc;" data-toggle="tooltip" data-placement="top" title="settings"><i class="fa fa-cog" aria-hidden="true" style="font-size: 18px;"></i></button>                      
                        </div>
                    </div>
                    @if(Auth::user()->role->id == 1)
                        <div class="col-md-12 text-center admin-home" style="background-color: #fff; color: #3490dc; border-right: 4px solid rgba(52, 144, 220, 0.7); padding-top: 15px;">
                            <p style="font-size: 18px;"><strong>Admin Dashboard</strong></p>
                        </div>
                    @elseif(Auth::user()->role->id == 2)
                    <div class="col-md-12 text-center admin-home" style="background-color: #fff; color: #3490dc; border-right: 4px solid rgba(52, 144, 220, 0.7); padding-top: 15px;">
                            <p style="font-size: 18px;"><strong>Author Dashboard</strong></p>
                        </div>
                    @else
                    <div class="col-md-12 text-center admin-home" style="background-color: #fff; color: #3490dc; border-right: 4px solid rgba(52, 144, 220, 0.7); padding-top: 15px;">
                            <p style="font-size: 18px;"><strong>Subscriber Dashboard</strong></p>
                        </div>
                    @endif                  
                </div>
                <ul class="admin-links">
                    {{-- Navigation Menu For Admin  --}}
                    @if( Auth::user()->role->id == 1 )
                         <li {{ request()->route()->getName() === 'admin.dashboard' ? 'class=active' : '' }} {{ request()->route()->getName() === 'admin.index' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.dashboard') }}">
                                <span><i class="fa fa-tachometer admin-link-icon" aria-hidden="true"></i></span> Dashboard
                            </a>
                        </li>
                        <li {{ request()->route()->getName() === 'admin.create' ? 'class=active' : '' }}>
                            <a  href="{{ route('admin.create') }}">
                                <span><i class="fa fa-pencil-square admin-link-icon" aria-hidden="true"></i></span> Create Blog
                            </a>
                        </li>
                        <li {{ request()->route()->getName() === 'admin.blogs' ? 'class=active' : '' }} {{ request()->route()->getName() === 'admin.blogs.user' ? 'class=active' : '' }}
                            {{ request()->route()->getName() === 'admin.blogs.edit' ? 'class=active' : '' }}>
                            <a href=""><span><i class="fa fa-files-o admin-link-icon" aria-hidden="true"></i></span> Blogs &nbsp; <i class="fa fa-caret-right toggle-icon" aria-hidden="true" style="font-size: 18px; margin-left: 10px;"></i></a>
                            <ul class="my-dropdown-items">
                                <li><a href="{{ route('admin.blogs') }}"><span><i class="fa fa-files-o " aria-hidden="true"></i></span>&nbsp; All Blogs</a></li>
                                <li><a href="{{ route('admin.blogs.user', Auth::user()->id) }}"><span><i class="fa fa-file-text " aria-hidden="true"></i></span>&nbsp; My Blogs</a></li>
                            </ul>
                        </li>
                        <li {{ request()->route()->getName() ==='admin.users' ? 'class=active' : '' }} {{ request()->route()->getName() ==='admin.users.profile' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.users') }}">
                                <span><i class="fa fa-users admin-link-icon" aria-hidden="true"></i></span> Users
                            </a>
                        </li>
                        <li {{ request()->route()->getName() ==='admin.categories' ? 'class=active' : '' }} {{ request()->route()->getName() === 'admin.categories.create' ? 'class=active' : '' }}
                            {{ request()->route()->getName() === 'categories.edit' ? 'class=active' : ''}}>
                            <a href="{{ route('admin.categories') }}">
                                <span><i class="fa fa-th-large admin-link-icon" aria-hidden="true"></i></span> Categories
                            </a>
                        </li>
                        <li {{ request()->route()->getName() === 'admin.trash' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.trash') }}">
                                <span><i class="fa fa-trash admin-link-icon" aria-hidden="true"></i></span> Trashed Blogs
                            </a>
                        </li>
                        <li {{ request()->route()->getName() === 'admin.profile' ? 'class=active' : '' }}>
                            <a  href="{{ route('admin.profile', Auth::user()->id) }}">
                                <span><i class="fa fa-user-md admin-link-icon" aria-hidden="true"></i></span> My Profile
                            </a>
                        </li>
                    {{-- Navigation Menu For Author --}}
                    @elseif( Auth::user()->role->id == 2 )
                        <li {{ request()->route()->getName() === 'admin.dashboard' ? 'class=active' : '' }} {{ request()->route()->getName() === 'admin.index' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.dashboard') }}">
                                <span><i class="fa fa-tachometer admin-link-icon" aria-hidden="true"></i></span> Dashboard
                            </a>
                        </li>
                        <li {{ request()->route()->getName() === 'admin.create' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.create') }}">
                                <span><i class="fa fa-pencil-square admin-link-icon" aria-hidden="true"></i></span> Create Blog
                            </a>
                        </li>
                        <li {{ request()->route()->getName() === 'admin.blogs.user' ? 'class=active' : '' }} {{ request()->route()->getName() === 'admin.blogs.edit' ? 'class=active' : '' }}>
                            <a  href="{{ route('admin.blogs.user', Auth::user()->id ) }}"> 
                                <span><i class="fa fa-files-o admin-link-icon" aria-hidden="true"></i></span> Blogs
                            </a>
                        </li>
                        <li  {{ request()->route()->getName() === 'admin.profile' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.profile', Auth::user()->id) }}">
                                <span><i class="fa fa-user-md admin-link-icon" aria-hidden="true"></i></span> My Profile
                            </a>
                        </li>

                    {{-- Navigation Menu For Subscriber --}}
                    @elseif(Auth::user()->role->id == 3)
                        <li {{ request()->route()->getName() === 'admin.dashboard' ? 'class=active' : '' }} {{ request()->route()->getName() === 'admin.index' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.dashboard') }}">
                                <span><i class="fa fa-tachometer admin-link-icon" aria-hidden="true"></i></span> Dashboard
                            </a>
                        </li>
                        <li {{ request()->route()->getName() === 'admin.create' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.create') }}">
                                <span><i class="fa fa-pencil-square admin-link-icon" aria-hidden="true"></i></span> Create Blog
                            </a>
                        </li>
                        <li {{ request()->route()->getName() === 'admin.blogs.user' ? 'class=active' : '' }} {{ request()->route()->getName() === 'admin.blogs.edit' ? 'class=active' : '' }}>
                            <a href="{{ route('admin.blogs.user', Auth::user()->id) }}">
                                    <span><i class="fa fa-files-o admin-link-icon" aria-hidden="true"></i></span> Blogs
                            </a>
                        </li>
                        <li {{ request()->route()->getName() === 'admin.profile' ? 'class=active' : '' }}>
                            <a  href="{{ route('admin.profile', Auth::user()->id) }}">
                                <span><i class="fa fa-user-md admin-link-icon" aria-hidden="true"></i></span> My Profile
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-10" style="width: 100%; height: 100vh;">
                <div class="row" style="margin: 30px 20px 20px 20px;">
                    @if(request()->route()->getName() === 'admin.index')
                        @yield('dashboard-content-right', View::make('admin.dashboard'))
                    @else
                        @yield('dashboard-content-right')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
