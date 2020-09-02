@extends('layouts.app')

@include('partials.meta_dynamic')

@section('content')

<div class="container-fluid" style="width: 85%;">
    <div class="row" style="background: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.2); margin: 30px 0px; padding: 40px 25px 25px 25px;">
        <article>
            <h3 class="text-center" style="color: #3490dc;  font-weight: 700;"><span class="text-center" style="background-color: #3490dc; padding: 0px 4px; border-radius: 5px;"><i class="fa fa-file-text-o admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> {{ $blog->title }} </h3>
            <div class="col-md-12">
                @if($blog->featured_image)
                    <img class="img-responsive mx-auto d-block" src="/images/featured_image/{{ $blog->featured_image ? $blog->featured_image : '' }}" width="50%" alt="{{ $blog->title }}" style="box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.2); margin: 20px;">                
                @endif
                <br>
                <p style="color: #3490dc;"><strong>
                    @if($blog->user)
                        <i class="fa fa-pencil-square" aria-hidden="true"></i><span>&nbsp; {{ $blog->user->name }}  &nbsp;&nbsp; </span>
                    @endif
                    <span style="font-size: 14px;"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp; {{ $blog->created_at->diffForHumans() }} &nbsp;&nbsp;</span>
                    @if($blog->category->count() > 0)
                        <span style="font-size: 14px;"><i class="fa fa-th-large" aria-hidden="true"></i>&nbsp; 
                            @foreach($blog->category as $category)
                                <a style="color: #3490dc; text-decoration: none;">{{ $category->name }} {{ $blog->category->count() > 1 ? '/' : '' }} </a>
                            @endforeach
                        </span>
                    @endif
                    </strong>
                </p>
                <hr>
                <p class="text-justify" style="margin: 5px 0px; font-size: 16px;">{!! $blog->content !!}</p>
            </div>
            <hr>
        </article>
        <hr>
        <div class="col-md-12" style="margin-top: 20px;">
            {{-- <div class="col-md-12" style="background-color: #3490dc; color: #fff; padding: 8px 5px 3px 10px; margin-bottom: 20px;">
                <h5><i class="fa fa-commenting" aria-hidden="true"></i>&nbsp; Comment Section</h5>
            </div> --}}
            <div>
                @comments([
                    'model'=> $blog,
                    'perPage' => 5
                ])
            </div> 
        </div>               
    </div> 
</div>
    
@endsection