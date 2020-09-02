{{-- @extends('layouts.app')

@section('content') --}}

@include('partials.tinymce')
    <div class="col-md-12" style="background: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3); margin-top: 5px; padding: 25px 40px 30px 40px;">
        <form action="{{ route('blogs.update', [$blog->id, 'edit-blog']) }}" method="post" enctype="multipart/form-data">
            {{ method_field('patch') }}
            <div class="form-group">
                <label for="title"><strong>Title</strong></label>
                <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
            </div>
            <div class="form-group">
                <label for="content"><strong>Content</strong></label>
                <textarea name="content" id="content" class="form-control" cols="30" rows="10">{{ $blog->content }}</textarea>
            </div>
            <div class="form-group form-check form-check-inline">
                <div class="col-md-12" style="padding: 0;">
                    <strong>{{ $categories->count() ? 'Categories : ' : '' }}</strong>
                    <div style="margin-top: 5px;">
                        @foreach($categories as $category)
                            <input type="checkbox" value="{{ $category->id }}" name="category_id[]" class="form-check-input"
                                @foreach($blog->category as $c)
                                    @if($c->id == $category->id)
                                        checked
                                    @endif
                                @endforeach
                            >
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
                <button class="btn btn-primary" type="submit">Update Blog</button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>

{{-- @endsection --}}