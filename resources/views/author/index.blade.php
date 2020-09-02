@extends('layouts.app')

@section('content')
    
    <div class="container-fluid glider-contain" style="width: 90%; padding: 30px 0px;">
        <h3 class="text-center" style="color: #fff;"><span style="background-color: #3490dc; padding: 3px 15px; border-radius: 3px;"><i class="fa fa-pencil-square"></i>&nbsp; Authors</span> </h3>
        <div class="glider" style="width: 97%; padding: 30px 0px 30px 10px;">
            @foreach($authors as $author)
                <div class="text-center author-card" style="background-color: #fff; margin-right: 15px; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); padding: 10px 10px 15px 10px;">
                    <img class="img-thumbnail" src="/images/user/{{ $author->profile_image }}" alt="" width=" 90%;">
                    <p class="text-center" style="color: #3490dc; margin-top: 10px; margin-bottom: 5px; font-size: 18px;"><strong>Er. {{ $author->name }} </strong></p>
                    <div class="col-md-12 btn-group">
                        <a href=" {{route('user.blogs', $author->name) }} " class="btn mr-3" style="background-color: #3490dc; color: #fff; padding: 3px 5px; border-radius: 3px;"><i class="fa fa-file" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Blogs</a>
                        <a href="{{ route('author.show', $author->name) }}" class="btn" style="background-color: #3490dc; color: #fff; padding: 3px 5px; border-radius: 3px;"><i class="fa fa-user" aria-hidden="true" style="font-size: 16px;"></i>&nbsp; Profile</a>
                    </div>                      
                </div>    
            @endforeach
        </div>
        
        <button aria-label="Previous" class="glider-prev" style="color : #3490dc; margin-top: 90px;"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
        <button aria-label="Next" class="glider-next" style="color: #3490dc; margin-top: 90px;"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
        {{-- <div role="tablist" class="dots">
        </div> --}}
    </div>
@endsection