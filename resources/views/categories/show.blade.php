@extends('layouts.app')

@section('content')
<div class="container-fluid" style="width: 85%;  padding: 20px 20px 20px 20px;">
    @if($categoryBlogs->count() >= 1)
        <h3 class="text-center" style="color: #fff;"><span style="background-color: #3490dc; padding: 3px 15px; border-radius: 3px;"><i class="fa fa-th-large"></i>&nbsp; {{ $category->name }}</span> </h3>
        @foreach($categoryBlogs as $blog)
            <div class="row" style="margin: 25px 0px; background: #fff(153, 73, 73); border-left: 3px solid rgba(52, 144, 220, 0.7); box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); padding: 25px;" >
                <div class="col-md-12" style="padding: 0px 5px; background-color: ed;">
                    <h4 style="color: #3490dc;"><span class="text-center" style="background-color: #3490dc; padding: 0px 1px; border-radius: 5px;"><i class="fa fa-file-text-o admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 20px;"></i></span>&nbsp;<a href="{{ route('blogs.show', [$blog->slug]) }}" style="text-decoration: none; font-weight: 700;">{{ $blog->title }}</a></h4>
                    <hr>
                    <p style="color: #3490dc;"><strong>
                        @if($blog->user)
                            <i class="fa fa-pencil-square" aria-hidden="true"></i><span> {{ $blog->user->name }}  &nbsp;&nbsp; </span>
                        @else
                            <i class="fa fa-pencil-square" aria-hidden="true"></i><span> No Author  &nbsp;&nbsp; </span>
                        @endif
                        <span style="font-size: 14px;"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $blog->created_at->diffForHumans() }} &nbsp;&nbsp;</span>
                        <span style="font-size: 14px;"><i class="fa fa-th-large" aria-hidden="true"></i>&nbsp; 
                            @if($blog->category)
                                @foreach($blog->category as $category)
                                    {{ $category->name }} {{ $blog->category->count() > 1 ? '/' : '' }}
                                @endforeach
                            @else 
                                No Category    
                            @endif
                        </span>
                        </strong>
                    </p>
                </div>
                <div class="col-md-8" style="padding: 5px;">
                    @inject('Str', 'Illuminate\Support\Str')
                    {!! Str::limit($blog->content, 500) !!}
                    <div>
                        <a href="{{ route('blogs.show', [$blog->slug]) }}" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('blogs.show', [$blog->slug]) }}">
                        @if($blog->featured_image)
                            <img class="img-thumbnail" src="/images/featured_image/{{ $blog->featured_image ? $blog->featured_image : '' }}" width="100%" alt="{{ $blog->title }}" style="box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.2); ">
                        @else
                        <img class="img-thumbnail" src="https://via.placeholder.com/896x505/3490dc/fff?text=Featured Image" width="100%" alt="{{ $blog->title }}" style="box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.2); ">
                        @endif
                    </a>
                </div>
            </div>
        @endforeach 
        {{ $categoryBlogs->links() }}
    @else
        <div class="row" style="margin: 20px 0px; background: #fff(153, 73, 73); border-left: 3px solid rgba(52, 144, 220, 0.7); box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); padding: 25px;" >
            <h3 class="text-center">No Published Blogs Yet.</h3>
        </div>
    @endif
</div>
@endsection  