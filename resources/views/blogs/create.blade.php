 {{-- @extends('layouts.app')

@section('content') --}}

@include('partials.tinymce')

    {{-- {{-- <div class="container-fluid" style="width: 80%;">
        <div class="jumbotron" style="background: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.2);"> --}}
            <div class="col-md-12" style="padding: 0; margin-bottom: 10px;">
                <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-pencil-square admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> Create a New Blog</strong></h3>
            </div>
            <div class="col-md-12" style="background: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); margin-top: 5px; padding: 25px 40px 30px 40px;">
                <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                    @include('partials.error_message')
                    <div class="form-group">
                        <label for="title"><strong>Title</strong></label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="content"><strong>Content</strong></label>
                        <textarea name="content" id="content" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group form-check form-check-inline">
                        <div class="col-md-12" style="padding: 0;">
                            <span><strong>Select Categories :</strong></span>
                            <div style="margin-top: 5px;">
                            @foreach($categories as $category)
                                <input type="checkbox" value="{{ $category->id }}" name="category_id[]" class="form-check-input">
                                <label class="form-check-label mr-4">{{ $category->name }}</label>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12" style="padding: 0; margin-top: 10px;">
                            <label class="btn btn-default form-label" style="padding: 0;">
                                <span class="btn btn-outline btn-success"><i class="fa fa-upload" aria-hidden="true"></i> &nbsp; Select Featured Image</span>
                                <input type="file" name="featured_image" class="form-control" hidden>
                            </label>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Create a new Blog</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        {{-- </div>
    </div> --}}

{{-- @endsection --}}