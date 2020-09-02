@extends('layouts.app')

@section('content')
<div class="container-fluid" style="width: 85%; margin-top: 4%;">
    <div class="col-md-12" style="margin-bottom: 30px; padding: 30px; background: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3);">
        <div class="row">
            <div class="col-md-3">
                @if($author->profile_image)
                <img src="/images/user/{{ $author->profile_image }}" class="img-thumbnail" alt="" width="100%">
                @else
                    <img src="https://via.placeholder.com/150/3490dc/fff?text=NO+IMAGE" class="img-thumbnail" width="100%">
                @endif

                <div class="col-md-12 btn-group author-profile" style="margin-top: 15px; margin-bottom: 15px;">
                    <a href=" {{ route('user.blogs', $author->name) }}" class="btn mr-3" style="background-color: #3490dc; color: #fff; border-radius: 3px; padding: 5px;"><i class="fa fa-file" aria-hidden="true"></i>&nbsp; Blogs</a>
                    <button class="btn" style="background-color: #3490dc; color: #fff; border-radius: 3px; padding: 5px;" data-target="#contactFormModal" data-toggle="modal">
                        <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; Contact
                    </button>
                </div>
            </div>
            <div class="col-md-9">  
                <h5 class="text-center" style="background-color: #3490dc; color: #fff; padding: 10px 10px; border-radius: 3px;"><strong>{{ $author->name }}</strong></h5><br>
                <p class="text-capitalize"><i class="fa fa-user-circle" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> {{ $author->role->name }} </p>
                <p><i class="fa fa-envelope" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> {{ $author->email }} </p>
                <p><i class="fa fa-file-text" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> {{ $publishedBlogs->count() }} {{ $publishedBlogs->count() > 1 ? 'Published blogs' : 'Published blog' }}</p>
                <p><i class="fa fa-th-large" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> PHP, JAVASCRIPT AND ARTIFICIAL INTELLIGENCE</p>

                @if($author->address)
                    <p><i class="fa fa-map-marker" style="color: #3490dc; font-size: 25px;" aria-hidden="true">&nbsp;</i> {{ $author->address }} </p>
                @else
                    <p><i class="fa fa-map-marker" style="color: #3490dc; font-size: 25px;" aria-hidden="true">&nbsp;</i> Address Not Specified </p>
                @endif

                <p><i class="fa fa-info-circle" style="color: #3490dc; font-size: 22px;" aria-hidden="true">&nbsp;</i> Description</p>
                @if($author->description)
                    <div style="width: 100%; background-color: #3490dc; color: #fff; padding: 15px; border-radius: 3px;">
                        <p class="text-justify">{{ $author->description }}</p>
                    </div>
                @else
                    <div style="width: 100%; background-color: #3490dc; color: #fff; padding: 15px; border-radius: 3px;">
                        <p class="text-justify"> No Description Available.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Contact Form Modal --}}
<div class="modal fade" id="contactFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-envelope" aria-hidden="true" style="color: #3490dc;"></i>&nbsp; New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="name" class="col-form-label">Your Name:</label>
              <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Your Email:</label>
              <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-mail-forward" aria-hidden="true"></i>&nbsp; Send message</button>
        </div>
      </div>
    </div>
  </div>

@endsection