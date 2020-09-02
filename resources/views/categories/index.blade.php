@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="width: 90%; padding-top: 30px;">
        <h3 class="text-center" style="color: #fff; margin-bottom: 50px;"><span style="background-color: #3490dc; padding: 3px 15px; border-radius: 3px;"><i class="fa fa-th-large"></i>&nbsp; Categories</span> </h3>
        <div class="row" style="background: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.2); margin: 20px 0px; padding: 50px 50px 40px 50px;">
            @foreach($categories as $category)
                <div class="col-md-3">
                    <a href="{{ route('categories.show', $category->slug) }}" style="color: #fff; text-decoration: none;">
                        <div class="categories col-md-12" style="width: 95%; height: auto; background-color: #3490dc; padding-top: 20px; padding-bottom: 5px; ; margin-bottom: 20px; border-radius: 3px;">
                            <div class="col-md-12 category-name">
                                <h4 class="text-center">{{ $category->name }}</h4>
                                <p class="text-center"><i class="fa fa-html5" aria-hidden="true" style="font-size:50px;"></i></p>
                            </div> 
                        </div>  
                    </a>
                </div>
            @endforeach
        </div> 
    </div>
@endsection