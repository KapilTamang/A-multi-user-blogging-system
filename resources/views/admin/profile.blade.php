@extends('admin.index')

@section('dashboard-content-right')
    <div class="col-md-12" style="padding: 0;">
        <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-user-md admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 25px;"></i></span> My Profile</strong></h3>
    </div>
    <div class="col-md-12" style="margin-top: 10px; padding: 30px; background: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3);">
        <div class="row">
            <div class="col-md-3">
                @if($userProfile->profile_image)
                <img src="/images/user/{{ $userProfile->profile_image }}" class="img-thumbnail" alt="" width="100%">
                @else
                    <img src="https://via.placeholder.com/150/3490dc/fff?text=NO+IMAGE" class="img-thumbnail" width="100%">
                @endif

                <div class="text-center" style="margin-top: 10px;">
                    <button class="btn" style="padding: 5px 10px; background-color: #3490dc; color: #fff;" data-toggle="modal" data-target="#editProfileModal" data-name="{{$userProfile->name}}" data-address="{{$userProfile->address}}" 
                        data-description="{{ $userProfile->description }}" data-image="{{$userProfile->profile_image}}"
                        data-route=" {{route('user.update', [$userProfile->id, 'profile-update'])}} ">
                            <i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Edit Profile
                    </button>
                </div>
            </div>
            <div class="col-md-9">  
                <h5 class="text-center" style="background-color: #3490dc; color: #fff; padding: 10px 10px; border-radius: 3px;"><strong>{{ $userProfile->name }}</strong></h5><br>
                <p class="text-capitalize"><i class="fa fa-user-circle" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> {{ $userProfile->role->name }} </p>
                <p><i class="fa fa-envelope" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> {{ $userProfile->email }} </p>
                <p><i class="fa fa-file-text" style="color: #3490dc; font-size: 18px;" aria-hidden="true">&nbsp;</i> {{ $publishedBlogs->count() }} {{ $publishedBlogs->count() > 1 ? 'blogs' : 'blog' }} </p>
                <p><i class="fa fa-th-large" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> PHP, JAVASCRIPT AND ARTIFICIAL INTELLIGENCE</p>
                
                @if($userProfile->address)
                    <p><i class="fa fa-map-marker" style="color: #3490dc; font-size: 25px;" aria-hidden="true">&nbsp;</i> {{ $userProfile->address }} </p>
                @else
                    <p><i class="fa fa-map-marker" style="color: #3490dc; font-size: 25px;" aria-hidden="true">&nbsp;</i> Address Not Specified </p>
                @endif

                <p><i class="fa fa-info-circle" style="color: #3490dc; font-size: 22px;" aria-hidden="true">&nbsp;</i> Description</p>
                @if($userProfile->description)
                    <div style="width: 100%; background-color: #3490dc; color: #fff; padding: 15px; border-radius: 3px;">
                        <p class="text-justify">{{ $userProfile->description }}</p>
                    </div>
                @else
                    <div style="width: 100%; background-color: #3490dc; color: #fff; padding: 15px; border-radius: 3px;">
                        <p class="text-justify"> No Description Available.</p>
                    </div>
                @endif
            
            </div>
        </div>
    </div>
    {{-- Edit Profile Modal --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-pencil-square" aria-hidden="true" style="color: #3490dc; font-size: 22px;"></i>&nbsp; Edit Profile
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="edit-profile-form" method="post" enctype="multipart/form-data">
                  {{ method_field('patch') }}
                <div class="form-group">
                    <img id="profile-image" class="img-thumbnail" alt="" width="100px">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label"><strong>Profile Image</strong></label>
                  <input type="file" class="form-control-file" name="profile_image" id="profileImage">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label"><strong>Name</strong></label>
                  <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label"><strong>Address</strong></label>
                  <input type="text" class="form-control" name="address" id="address">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label"><strong>Description</strong></label>
                  <textarea class="form-control" name="description" id="description"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Close</button>
                    <button type="submit" class="btn" style="background-color: #3490dc; color: #fff;"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp; Update</button>
                    {{ csrf_field() }}
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
      {{-- Edit Profile Modal --}}
    <script>
        $('#editProfileModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) //button that triggered the modal
            var name = button.data('name')
            var address = button.data('address')
            var description = button.data('description')
            var image = button.data('image')
            var myroute = button.data('route')
             // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            console.log(image)

            // Populating user profile image
            if(image) {
                modal.find('#profile-image').attr('src', '/images/user/'+image+'')
            }
            else {
                modal.find('#profile-image').attr('src', 'https://via.placeholder.com/100/3490dc/fff?text=NO+IMAGE')
            }

            modal.find('#name').val(name)
            modal.find('#address').val(address)
            modal.find('#description').val(description)
            modal.find('#edit-profile-form').attr('action', myroute)
            
        });
    </script> 
@endsection