@extends('admin.index')

@section('dashboard-content-right')
    {{-- Content for Admin --}}
    @if( Auth::user()->role->id == 1)
        @if(request()->route()->getName() === 'admin.blogs')
            <div class='col-md-12' style="padding: 0; margin-bottom: 10px;">
                <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-files-o admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> All Blogs</strong></h3>
            </div>
            <div class="row" style="padding: 0; margin-top: 5px;">
                <div class="col-md-6" style="padding-right: 20px;">
                    <h4 style="color: #3490dc;"><span><i class="fa fa-bullhorn" aria-hidden="true" style="background-color: #3490dc; color: #fff; padding: 5px; border-radius: 3px;"></i></span>&nbsp; Published</h4>
                    <hr>
                    <div class="row" style="margin: 5px 0px;">
                        @foreach($publishedBlogs as $blog)  
                            <div class="col-md-12" style="margin-bottom: 20px; padding: 0;">
                                <div style="width: 100%; background: #fff(153, 73, 73); border-left: 2px solid rgba(52, 144, 220, 0.7); box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); padding: 15px 0px 10px 20px;">
                                    <div class="row" style="padding: 0px 10px;">
                                        <div class="col-md-12" style="padding: 0;">
                                            <h5><a href="{{ route('blogs.show', [$blog->slug]) }}" target="_blank" style="text-decoration: none; font-weight: 700;">
                                                <span class="text-center" style="background-color: #3490dc; padding: 0px 6px; border-radius: 5px;">
                                                <i class="fa fa-file-text-o" aria-hidden="true" style="color:#fff; font-size: 15px;"></i></span>&nbsp;{{ $blog->title }}</a>
                                            </h5>
                                        </div>
                                        <hr>
                                        <div class="col-md-12" style="padding: 0px; color:#3490dc;">
                                            <p style="font-size: 14px; margin-left: 5px;"><strong>
                                                @if($blog->user)
                                                    <span style="color: #3490dc;"><i class="fa fa-pencil-square" aria-hidden="true"></i></span> {{ $blog->user->name }}  &nbsp; &nbsp;
                                                @endif
                                                <span style="color: #4caf50;"><i class="fa fa-calendar" aria-hidden="true"></i></span> {{ $blog->created_at->diffForHumans() }} &nbsp; &nbsp;
                                                <span style="color: #ff8a65;"><i class="fa fa-th-large" aria-hidden="true"></i></span>&nbsp;
                                                @if($blog->category->count() > 0)
                                                    @foreach($blog->category as $category)
                                                        {{ $category->name }} {{ $blog->category->count() > 1 ? '/' : ' ' }}
                                                    @endforeach
                                                @else 
                                                    No Category Assigned.
                                                @endif    
                                                </strong>
                                            </p>
                                            <div style="margin-top: 0;">
                                                <form action="{{ route('blogs.update', [$blog->id, 'draft-blog']) }}" method="post">
                                                    {{ method_field('patch') }}
                                                    <input name="status" type="checkbox" value="0" checked style="display: none;">
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true" style="color:#fff; font-size: 16px;"></i>&nbsp; Save as Draft</button>
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $publishedBlogs->links() }}
                    </div>
                </div>
                <div class="col-md-6" style="padding-left: 20px;">  
                    <h4 style="color: #3490dc;"><span><i class="fa fa-pencil-square" aria-hidden="true" style="background-color: #3490dc; color: #fff; padding: 5px; border-radius: 3px;"></i></span>&nbsp; Draft </h4>
                    <hr>
                    <div class="row" style="margin: 5px 0px;">
                        @foreach($draftBlogs as $blog)  
                            <div class="col-md-12" style="margin-bottom: 20px; padding: 0;">
                                <div style="width: 100%; background: #fff(153, 73, 73); border-left: 2px solid rgba(52, 144, 220, 0.7); box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); padding: 15px 0px 10px 20px;">
                                    <div class="row" style="padding: 0px 10px;">
                                        <div class="col-md-12" style="padding: 0;">
                                            <h5><a href="{{ route('blogs.show', [$blog->slug]) }}" target="_blank" style="text-decoration: none; font-weight: 700;">
                                                <span class="text-center" style="background-color: #3490dc; padding: 0px 6px; border-radius: 5px;">
                                                <i class="fa fa-file-text-o" aria-hidden="true" style="color:#fff; font-size: 15px;"></i></span>&nbsp;{{ $blog->title }}</a>
                                            </h5>
                                        </div>
                                        <hr>
                                        <div class="col-md-12" style="padding: 0px; color:#3490dc;">
                                            <p style="font-size: 14px; margin-left: 5px;"><strong>
                                                @if($blog->user)
                                                    <span style="color: #3490dc;"><i class="fa fa-pencil-square" aria-hidden="true"></i></span> {{ $blog->user->name }}  &nbsp; &nbsp;
                                                 @endif
                                                <span style="color: #4caf50;"><i class="fa fa-calendar" aria-hidden="true"></i></span> {{ $blog->created_at->diffForHumans() }} &nbsp; &nbsp;
                                                <span style="color: #ff8a65;"><i class="fa fa-th-large" aria-hidden="true"></i></span>&nbsp;
                                                @if($blog->category->count() > 0)
                                                    @foreach($blog->category as $category)
                                                        {{ $category->name }} {{ $blog->category->count() > 1 ? '/' : ' ' }}
                                                    @endforeach
                                                @else 
                                                    No Category.
                                                @endif    
                                            </strong>
                                            </p>
                                            <div class="btn-group"style="margin-top: 0;">
                                                <form action="{{ route('blogs.update', [$blog->id, 'publish-blog']) }}" method="post">
                                                    {{ method_field('patch') }}
                                                    <input name="status" type="checkbox" value="1" checked style="display: none;">
                                                    <button type="submit" class="btn btn-sm" style="background-color:#4caf50; color: #fff;"><i class="fa fa-bullhorn" aria-hidden="true" style="color:#fff; font-size: 16px;"></i>&nbsp; Publish</button>
                                                    {{ csrf_field() }}
                                                </form>
                                                {{-- <form action="{{ route('blogs.delete', $blog->id) }}" method="post">
                                                    {{ method_field('delete') }} --}}
                                                    <input type="hidden" class="blog-delete-id" value=" {{ $blog->id }} ">
                                                    <button type="submit" class="btn btn-danger btn-sm blog-delete-btn" style="color: #fff;"><i class="fa fa-trash" aria-hidden="true" style="color:#fff; font-size: 16px;"></i>&nbsp; Delete</button>
                                                    {{-- {{ csrf_field() }}
                                                </form> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @elseif(request()->route()->getName() === 'admin.blogs.user')
            @if(count($adminBlogs) >= 1)
                <div class='col-md-12' style="padding: 0; margin-bottom: 5px;">
                    <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-files-o admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> My Blogs</strong></h3>
                </div>
                <div class="row" style="margin: 5px 0px;">
                    @foreach($adminBlogs as $blog)  
                        <div class="col-md-6" style="margin-bottom: 20px; padding: 0;">
                            <div style="width: 96%; background: #fff(153, 73, 73); border-left: 2px solid rgba(52, 144, 220, 0.7); box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); padding: 15px 0px 10px 20px;">
                                <div class="row" style="padding: 0px 10px;">
                                    <div class="col-md-12" style="padding: 0;">
                                        <h5><a href="{{ route('blogs.show', [$blog->slug]) }}" target="_blank" style="text-decoration: none; font-weight: 700;">
                                            <span class="text-center" style="background-color: #3490dc; padding: 0px 6px; border-radius: 5px;">
                                            <i class="fa fa-file-text-o" aria-hidden="true" style="color:#fff; font-size: 15px;"></i></span>&nbsp;{{ $blog->title }}</a>
                                        </h5>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px;">
                                        <p style="font-size: 14px; margin-left: 5px; margin-bottom: 10px; color:#3490dc;"><strong>
                                            <span style="color: #4caf50;"><i class="fa fa-calendar" aria-hidden="true"></i></span>&nbsp; {{ $blog->created_at->diffForHumans() }}&nbsp; &nbsp;
                                            <span style="color: #ff8a65;"><i class="fa fa-th-large" aria-hidden="true"></i></span>&nbsp;
                                            @if($blog->category->count() > 0)
                                                @foreach($blog->category as $category)
                                                    {{ $category->name }} {{ $blog->category->count() > 1 ? '/' : ' ' }}
                                                @endforeach
                                            @else 
                                                No Category Assigned.
                                            @endif 
                                            </strong>   
                                        </p>
                                        <p style="font-size: 14px; margin: 0px 0px 5px 5px; color:#3490dc;">
                                            <strong> Status : &nbsp;</strong>
                                            @if($blog->status ===  1)
                                                <span style="color: #4caf50;"><i class="fa fa-check-square" aria-hidden="true"></i></span> Published
                                            @else
                                            <span style="color: #ff8a65;;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span> Pending
                                                @endif
                                        </p>
                                        <div class="btn-group" style="margin-top: 5px;">
                                            <form action="{{ route('admin.blogs.edit', $blog->id) }}" method="get">
                                                <button class="btn btn-primary btn-sm" style><i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Edit</button>
                                            </form>
                                            {{-- <form action="{{ route('blogs.delete', $blog->id) }}" method="post">
                                                {{ method_field('delete') }} --}}
                                                <input type="hidden" class="blog-delete-id" value=" {{ $blog->id }} ">
                                                <button type="submit" class="btn btn-danger btn-sm blog-delete-btn"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Delete</button>
                                                {{-- {{ csrf_field() }}
                                            </form> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12">
                        {{ $adminBlogs->links() }}
                    </div>                </div>
            @else
            <div class="row" style="width: 100%; height: 80px; margin: 5px 0px; background: #fff(153, 73, 73); border-left: 3px solid rgba(52, 144, 220, 0.7); box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); padding: 25px;" >
                    <h4>No Blogs Yet.</h4>
                </div>
            @endif
        @elseif(request()->route()->getName() === 'admin.blogs.edit')
            <div class='col-md-12' style="padding: 0; margin-bottom: 5px;">
                <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-files-o admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> Edit Blog</strong></h3>
            </div>
            @include('blogs.edit')
        @endif {{-- endif for request()->route()->getName() --}}
    @else {{-- else for Auth::user()->id  --}}
        @if(request()->route()->getName() === 'admin.blogs.edit')
            <div class='col-md-12' style="padding: 0; margin-bottom: 5px;">
                <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-files-o admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> Edit Blog</strong></h3>
            </div>
            @include('blogs.edit')
        @elseif(request()->route()->getName() === 'admin.blogs.user')
            @if(count($adminBlogs) >= 1)
                <div class='col-md-12' style="padding: 0; margin-bottom: 5px;">
                    <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-files-o admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> Blogs</strong></h3>
                </div>
                <div class="row" style="margin: 5px 0px;">
                    @foreach($adminBlogs as $blog)  
                        <div {{ count($adminBlogs) > 1 ? 'class=col-md-6' : 'class=col-md-12'}} style="margin-bottom: 20px; padding: 0;">
                            <div style="width: 96%; background: #fff(153, 73, 73); border-left: 2px solid rgba(52, 144, 220, 0.7); box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); padding: 15px 0px 10px 20px;">
                                <div class="row" style="padding: 0px 10px;">
                                    <div class="col-md-12" style="padding: 0;">
                                        <h5><a href="{{ route('blogs.show', [$blog->slug]) }}" target="_blank" style="text-decoration: none; font-weight: 700;">
                                            <span class="text-center" style="background-color: #3490dc; padding: 0px 6px; border-radius: 5px;">
                                            <i class="fa fa-file-text-o" aria-hidden="true" style="color:#fff; font-size: 15px;"></i></span>&nbsp;{{ $blog->title }}</a>
                                        </h5>
                                    </div>
                                    <div class="col-md-12" style="padding: 0;">
                                        <p style="font-size: 14px; margin-left: 5px; margin-bottom: 10px; color:#3490dc;"><strong>
                                            <span style="color: #4caf50;"><i class="fa fa-calendar" aria-hidden="true"></i></span>&nbsp; {{ date('Y-m-d', strtotime($blog->created_at)) }}&nbsp; &nbsp;
                                            <span style="color: #ff8a65;"><i class="fa fa-th-large" aria-hidden="true"></i></span>&nbsp;
                                            @if($blog->category->count() > 0)
                                                @foreach($blog->category as $category)
                                                    {{ $category->name }} {{ $blog->category->count() > 1 ? '/' : ' ' }}
                                                @endforeach
                                            @else 
                                                No Category Assigned.
                                            @endif 
                                            </strong>   
                                        </p>
                                        <p style="font-size: 14px; margin: 0px 0px 5px 5px; color:#3490dc;">
                                            <strong> Status : &nbsp;</strong>
                                            @if($blog->status ===  1)
                                                <span style="color: #4caf50;"><i class="fa fa-check-square" aria-hidden="true"></i></span> Published
                                            @else
                                            <span style="color: #ff8a65;;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span> Pending
                                                @endif
                                        </p>
                                        <div class="btn-group" style="margin-top: 5px;">
                                            <form action="{{ route('admin.blogs.edit', $blog->id) }}" method="get">
                                                <button class="btn btn-primary btn-sm" style><i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Edit</button>
                                            </form>
                                            {{-- <form action="{{ route('blogs.delete', $blog->id) }}" method="post">
                                                {{ method_field('delete') }} --}}
                                                <input type="hidden" class="blog-delete-id" value=" {{ $blog->id }} ">
                                                <button type="submit" class="btn btn-danger btn-sm blog-delete-btn"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Delete</button>
                                                {{-- {{ csrf_field() }}
                                            </form> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $adminBlogs->links() }}
                </div>
            @else
                <div class="row" style="width: 100%; height: 80px; margin: 5px 0px; background: #fff(153, 73, 73); box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); padding: 25px; border-left: 3px solid rgba(52, 144, 220, 0.7);" >
                    <h4>No Blogs Yet.</h4>
                </div>
            @endif
        @endif
    @endif {{-- endif for Auth::user()->id --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.blog-delete-btn').click(function(e) {
                e.preventDefault();
                var blog_id = $(this).closest("div").find('.blog-delete-id').val();
                Swal.fire({
                    title: 'Are you sure you want to delete this blog?',
                    showCancelButton: true,
                    confirmButtonColor: '#3490dc',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        var data = {
                            "_token" : $('input[name=_token]').val(),
                            "id" : blog_id,
                        };
                        $.ajax({
                            type: 'DELETE',
                            url: '/blogs/delete/'+ blog_id,
                            data: data,
                            success: function (response) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                    })

                                    Toast.fire({
                                    icon: 'success',
                                    title: 'Blog has been deleted successfully.'
                                })
                                .then((result) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
