@extends('admin.index')

@section('dashboard-content-right')
    <div class="col-md-12" style=" padding: 0px;">
        <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-tachometer admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 25px;"></i></span> Dashboard</strong></h3>
    </div>
    @if(Auth::user()->role->id === 1)
        <div class="col-md-12" style="padding-bottom: 20px;">
            <div class="row">
                <div class="col-md-3" style="margin-top: 10px; padding-top: 10px;">
                    <div class="row" style="width: 100%; background-color: #fff; color: #4caf50; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.5); border-left: 3px solid rgba(76, 175, 80, 0.7);">
                        <div class="col-md-4 text-center" style="padding: 10px;">
                            <i class="fa fa-bullhorn" aria-hidden="true" style="background-color: #4caf50; font-size: 45px; color: #fff; padding: 12px; border-radius: 3px;"></i>
                        </div>
                        <div class="col-md-8" style=" padding: 12px;">
                            <h5 class="center" style="color:#000">Published Blogs</h5> 
                        <h3 class="text-center"><strong> {{ count($blogs) }} </strong></h3>  
                        <a class="view-detail" href="{{ route('admin.blogs') }}" style="background-color: #4caf50; box-shadow: 0px 5px 15px 3px rgba(76, 175, 80, 0.3); text-decoration: none; color: #fff; border-radius: 3px; padding: 3px 10px; transform: translateY(3px); position: absolute;">View Details &nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i></a>  
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="margin-top: 10px; padding-top: 10px;">
                    <div class="row" style="width: 100%; background-color: #fff; color: #3490dc; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.5); border-left: 3px solid rgba(52, 144, 220, 0.7);">
                        <div class="col-md-4 text-center" style="padding: 10px;">
                            <i class="fa fa-users" aria-hidden="true" style="background-color: #3490dc; font-size: 45px; color: #fff; padding: 12px; border-radius: 3px;"></i>
                        </div>
                        <div class="col-md-8" style=" padding: 12px;">
                            <h5 class="text-center" style="color:#000">Total Users</h5> 
                        <h3 class="text-center"><strong> {{ count($users) }} </strong></h3>
                        <a href="{{ route('admin.users') }}" style="background-color: #3490dc; box-shadow: 0px 5px 15px 3px rgba(52, 144, 220, 0.3); text-decoration: none; color: #fff; border-radius: 3px; padding: 3px 10px; transform: translateY(3px); position: absolute;">View Details &nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i></a>        
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="margin-top: 10px; padding-top: 10px;">
                    <div class="row" style="width: 100%; background-color: #fff; color: #ff8a65; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.5); border-left: 3px solid rgba(255, 138, 101, 0.7);">
                        <div class="col-md-4 text-center" style="padding: 12px;">
                            <i class="fa fa-th-large" aria-hidden="true" style="background-color: #ff8a65; font-size: 45px; color: #fff; padding: 10px; border-radius: 3px;"></i>
                        </div>
                        <div class="col-md-8" style=" padding: 12px;">
                            <h5 class="text-center" style="color:#000">Categories</h5> 
                        <h3 class="text-center"><strong> {{ count($categories) }} </strong></h3> 
                        <a href="{{ route('admin.categories') }}" style="background-color: #ff8a65; box-shadow: 0px 5px 15px 3px rgba(255, 138, 101, 0.3);  text-decoration: none; color: #fff; border-radius: 3px; padding: 3px 10px; transform: translateY(3px); position: absolute;">View Details &nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i></a>       
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="margin-top: 10px; padding-top: 10px;">
                    <div class="row" style="width: 100%; background-color: #fff; color: #dc3545; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.5); border-left: 3px solid rgba(220, 53, 69, 0.7);">
                        <div class="col-md-4 text-center" style="padding: 12px;">
                            <i class="fa fa-trash" aria-hidden="true" style="background-color: #dc3545; font-size: 45px; color: #fff; padding: 10px 12px; border-radius: 3px;"></i>
                        </div>
                        <div class="col-md-8" style=" padding: 12px;">
                            <h5 class="text-center" style="color:#000">Trashed Blogs</h5> 
                            <h3 class="text-center"><strong> {{ $trashedBlogs->count() }} </strong></h3>
                        <a href="{{ route('admin.trash') }}" style="background-color: #dc3545; box-shadow: 0px 5px 15px 3px rgba(220, 53, 69, 0.3); text-decoration: none; color: #fff; border-radius: 3px; padding: 3px 10px; transform: translateY(3px); position: absolute;">View Details &nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i></a>        
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="padding-bottom: 20px; margin-top: 70px;">
            <div class="row">
                <div class="col-md-4">
                    <div style="width: 95%;; background-color: #fff; Padding: 10px 10px 30px 10px; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.4); border-bottom: 3px solid rgba(76, 175, 80, 0.7);;">
                        <h5 class="text-center" style="background-color: #4caf50; width: 60%; color: #fff; padding: 10px 10px; transform: translate(50px, -25px); position: absolute; border-radius: 3px;"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp; Most Popular Blog</h5>
                        <div class="row" style="width: 100%; padding-top: 35px;">
                            <div class="col-md-6 text-center" style="padding-top: 5px; padding-left: 20px;">
                                <img class="img-thumbnail" src="/images/laravel.jpg"  width="100%" alt="">
                            </div>
                            <div class="col-md-6" style="padding: 5px 5px;">
                                <p>Why Laravel is the best Framework?</p>
                                <a href="" style="background-color:#4caf50; color: #fff; padding: 5px 10px; border-radius: 3px; text-decoration: none;">View Blog</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="width: 95%; background-color: #fff; padding: 10px 10px 30px 10px; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.4); border-bottom: 3px solid rgba(52, 144, 220, 0.7);">
                        <h5 class="text-center" style="background-color: #3490dc; width: 60%; color: #fff; padding: 10px 10px; transform: translate(50px, -25px); position: absolute; border-radius: 3px;"><i class="fa fa-user" aria-hidden="true"></i>&nbsp; Most Popular Author</h5>
                        <div class="row" style="padding-top: 35px;">
                            <div class="col-md-4 text-center" style="padding-top: 5px; padding-left: 20px;">
                                <img class="img-thumbnail" src="/images/user/kapil.jpg"  width="100%" alt="">
                            </div>
                            <div class="col-md-8" style="padding: 5px 5px;">
                                <p><span style="color: #3490dc;"><strong>Kapil Tamang</strong></span><br><strong>Category:</strong> JAVASCRIPT</p>
                                <a href="" style="background-color: #3490dc; color: #fff; padding: 5px 10px; border-radius: 3px; text-decoration: none;">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="width: 95%; background-color: #fff; padding: 10px 10px 30px 10px; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.4); border-bottom: 3px solid rgba(255, 138, 101, 0.7);">
                        <h5 class="text-center" style="background-color: #ff8a65; width: 70%; color: #fff; padding: 10px 10px; transform: translate(30px, -25px); position: absolute; border-radius: 3px;"><i class="fa fa-th-large" aria-hidden="true"></i>&nbsp; Most Popular Category</h5>
                        <div class="row" style="width: 100%; padding-top: 35px;">
                            <div class="col-md-6 text-center" style="padding-top: 5px; padding-left: 20px;">
                                <img class="img-thumbnail" src="/images/python.png"  width="100%" alt="">
                            </div>
                            <div class="col-md-6" style="padding: 5px 5px;">
                                <p><span style="color: #ff8a65;"><strong>PYTHON</strong></span><br>Machine Learning</p>
                                <a href="" style="background-color: #ff8a65; color: #fff; padding: 5px 10px; border-radius: 3px; text-decoration: none;">Browse Category</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="width: 100%; height: 60px; margin-top: 30px;">
        </div>
    @elseif(Auth::user()->role->id === 2)
        <div class="row" style="width: 100%; height: 100vh; padding-left: 30%; padding-top: 20%;">
            <div class="col-md-12">
                <h1 style="opacity: 0.5;"><strong>Author Dashboard</strong></h1>
            </div>
        </div>
    @elseif(Auth::user()->role->id === 3)
    <div class="row" style="width: 100%; height: 100vh; padding-left: 30%; padding-top: 20%;">
        <div class="col-md-12">
            <h1 style="opacity: 0.5;"><strong>Subscriber Dashboard</strong></h1>
        </div>
    </div>
    @endif
@endsection