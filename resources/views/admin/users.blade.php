@extends('admin.index')

@section('dashboard-content-right')
    @if(request()->route()->getName() === 'admin.users.profile')
        <div class="col-md-12" style="padding: 0;">
            <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-users admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> User Profile</strong></h3>
        </div>
        <div class="col-md-12" style="margin-top: 10px; padding: 30px; background: #fff; box-shadow: 0px 5px 15px 3px rgba(177, 174, 174, 0.3);">
            <div class="row">
                <div class="col-md-3">
                    @if($userProfile->profile_image)
                        <img src="/images/user/{{ $userProfile->profile_image }} " class="img-thumbnail" alt="" width="100%">
                    @else 
                        <img src="https://via.placeholder.com/150/3490dc/fff?text=NO+IMAGE" class="img-thumbnail" width="100%" alt="">
                    @endif
                </div>
                <div class="col-md-9">  
                    <h5 class="text-center" style="background-color: #3490dc; color: #fff; padding: 10px 10px; border-radius: 3px;"><strong>{{ $userProfile->name }}</strong></h5><br>
                    <p class="text-capitalize"><i class="fa fa-user-circle" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> {{ $userProfile->role->name }} </p>
                    <p><i class="fa fa-envelope" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> {{ $userProfile->email }} </p>
                    <p><i class="fa fa-file-text" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> {{ $publishedBlogs->count() }} {{ $publishedBlogs->count() > 1 ? 'blogs' : 'blog' }} </p>
                    <p><i class="fa fa-th-large" style="color: #3490dc; font-size: 20px;" aria-hidden="true">&nbsp;</i> PHP, JAVASCRIPT AND ARTIFICIAL INTELLIGENCE</p>

                    @if($userProfile->address)
                        <p><i class="fa fa-map-marker" style="color: #3490dc; font-size: 25px;" aria-hidden="true">&nbsp;</i> {{ $userProfile->address }} </p>
                    @else
                        <p><i class="fa fa-map-marker" style="color: #3490dc; font-size: 25px;" aria-hidden="true">&nbsp;</i> Address Not Specified </p>
                    @endif

                    <p><i class="fa fa-info-circle" style="color: #3490dc; font-size: 22px;" aria-hidden="true">&nbsp;</i> Description</p>
                    @if($userProfile->description)
                        <div style="width: 100%; background-color: #3490dc; color: #fff; padding: 15px; border-radius: 3px;">
                            <p class="text-justify">{{$userProfile->description }}</p>
                        </div>
                    @else 
                        <div style="width: 100%; background-color: #3490dc; color: #fff; padding: 15px; border-radius: 3px;">
                            <p class="text-justify">No Description Available</p>
                        </div>
                    @endif         
                </div>
            </div>
        </div>
    @elseif(request()->route()->getName() === 'admin.users')
        <div class="col-md-12" style="padding: 0;">
            <h3 style="color: #3490dc;"><strong><span class="text-center" style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-users admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> Users</strong></h3>
        </div>
        <div class="col-md-12" style="margin-top: 10px; padding: 0;">
            @if(count($users) >= 1)
                <table class="content-table text-center" style="margin-bottom: 15px;">
                    <thead>
                        <tr>
                            <th><i class="fa fa-id-badge" aria-hidden="true"></i>&nbsp; Id</th>
                            <th><i class="fa fa-id-card" aria-hidden="true"></i>&nbsp; Name</th>
                            <th><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; Email</th>
                            <th><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp; Role</th>
                            <th><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp; Created At</th>
                            <th><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="btn-group">
                                    {{-- Update User Role --}}
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#roleEditModal" data-user="{{ $user->name }}" data-role="{{$user->role->id}}" data-route="{{ route('user.update', [$user->id, 'role-update']) }} ">
                                        <i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Edit Role 
                                    </button>
                                    {{--View User Profile--}}
                                    <form method="get" action=" {{ route('admin.users.profile', $user->id) }} ">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; View Profile </button>
                                        {{ csrf_field() }}
                                    </form> 
                                    {{-- delete User --}}
                                    {{-- <form method="post" action=" {{ route('user.delete', $user->id) }} ">
                                        {{ method_field('delete') }} --}}
                                        <input type="hidden" class="user-delete-id" value=" {{$user->id}} ">
                                        <input type="hidden" class="user-delete-name" value=" {{$user->name}} ">
                                        <button type="submit" class="btn btn-danger btn-sm user-delete-btn"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Delete </button>
                                        {{-- {{ csrf_field() }}
                                    </form>       --}}
                                </div>
                            </td>
                            </tr>                        
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            @else 
                <h3>No Users.</h3>
            @endif 
        </div>
    @endif
    <div class="modal fade" id="roleEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square" aria-hidden="true" style="color: #3490dc; font-size: 22px;"></i>&nbsp; Edit Role</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="role-edit-form" method="post">
                    {{ method_field('patch') }}
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label"><strong>Name : </strong><span id="username"></span></label>
                </div>
                <div class="form-group form-check form-check-inline">
                    <span class="mr-2"><strong>Choose a Role :</strong>&nbsp; </span>
                        <input type="radio" id="admin" name="role_id" value="1" class="form-check-input">
                        <label for="admin" class="form-check-label mr-3">Admin</label>
                        <input type="radio" id="author" name="role_id" value="2" class="form-check-input">
                        <label for="admin" class="form-check-label mr-3">Author</label>
                        <input type="radio" id="subscriber" name="role_id" value="3" class="form-check-input">
                        <label for="admin" class="form-check-label mr-3">Subscriber</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</button>
                    <button type="submit" class="btn" style="background-color: #3490dc; color: #fff;"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp; Update</button>
                    {{ csrf_field() }}
                </div>
              </form>
            </div>
          </div>
        </div>
@endsection

@section('scripts')

  {{-- User Role Edit Modal --}}
     <script>
        $('#roleEditModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)// Button that triggered the modal
            var userName = button.data('user') // Extract info from data-* attributes
            var role = button.data('role')
            var myroute = button.data('route')
        
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            
            if(role === 1) {
                modal.find('#admin').attr('checked', 'checked')
            }
            else if(role ===2) {
                modal.find('#author').attr('checked', 'checked')
            }
            else if(role === 3) {
                modal.find('#subscriber').attr('checked', 'checked')
            }

            modal.find('.close').click(function() {
                modal.find('#admin').removeAttr('checked', 'checked')
                modal.find('#author').removeAttr('checked', 'checked')
                modal.find('#subscriber').removeAttr('checked', 'checked')
                
            }) 

            modal.find('.btn-close').click(function() {
                modal.find('#admin').removeAttr('checked', 'checked')
                modal.find('#author').removeAttr('checked', 'checked')
                modal.find('#subscriber').removeAttr('checked', 'checked')
            }) 

            modal.find('.modal-body #username').html(userName)
            modal.find('#role-edit-form').attr('action', myroute)          
        })
    </script>


    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.user-delete-btn').click(function(e) {
                e.preventDefault() ;

                var user_id = $(this).closest("tr").find('.user-delete-id').val();
                var user_name = $(this).closest("tr").find('.user-delete-name').val();
        
                Swal.fire({
                    title: 'Are you sure you want to delete user  "'+ user_name + '"?' ,
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: '#3490dc',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {

                        var data = {
                            "_token" : $('input[name=_token]').val(),
                            "id" : user_id,
                        };
                        $.ajax({
                            type: 'DELETE',
                            url: '/user/delete/'+user_id,
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
                                    title: 'User "'+ user_name +'" has been deleted successfully.'
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
