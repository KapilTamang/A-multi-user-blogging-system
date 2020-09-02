@extends('admin.index')

@section('dashboard-content-right')
    @if(request()->route()->getName() === 'admin.categories.create')
        <h3 class="text-center" style="color: #3490dc;"><strong><span style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-th-large admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> Add New Category</strong></h3>
        @include('categories.create');

    @elseif( request()->route()->getName() === 'categories.edit' )
        <h3 class="text-center" style="color: #3490dc;"><strong><span style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-th-large admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> Edit Category</strong></h3>
        @include('categories.edit');
    @else
        <h3 class="text-center" style="color: #3490dc;"><strong><span style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-th-large admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 22px;"></i></span> Categories</strong></h3>
        <div class="col-md-12" style="margin-top: 10px; padding: 0;">
            @if(count($categories) >= 1)
                <table class="content-table text-center" style="margin-bottom: 15px;">
                    <thead>
                        <tr>
                            <th><i class="fa fa-id-badge" aria-hidden="true"></i>&nbsp; Id</th>
                            <th><i class="fa fa-id-card" aria-hidden="true"></i>&nbsp; Name</th>
                            <th><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp; Created at</th>
                            <th><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="btn-group">
                                    {{-- restore --}}
                                    <form method="get" action=" {{ route('categories.edit', $category->id) }} ">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp; Edit</button>
                                        {{ csrf_field() }}
                                    </form>                      
                                    {{-- delete --}}
                                    {{-- <form method="post" action=" {{ route('categories.destroy', $category->id) }} ">
                                        {{ method_field('delete') }} --}}
                                        <input type="hidden" class="category-delete-id" value=" {{ $category->id }} ">
                                        <input type="hidden" class="category-delete-name" value=" {{ $category->name }} ">
                                        <button type="submit" class="btn btn-danger btn-sm category-delete-btn"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Delete</button>
                                        {{-- {{ csrf_field() }}
                                    </form> --}}
                                </div>
                            </td>
                            </tr>                        
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            @else 
                <h3>No Categories</h3>
            @endif
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <a href=" {{ route('admin.categories.create') }} " style="background-color: #3490dc; color: #fff; padding: 8px 12px; border-radius: 3px; text-decoration: none;">Add New Category</a>
                </div>
            </div>
        </div>
        @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.category-delete-btn').click(function(e) {
                e.preventDefault();
                var category_id = $(this).closest("tr").find('.category-delete-id').val();
                var category_name = $(this).closest("tr").find('.category-delete-name').val();
                
                Swal.fire({
                    title: 'Are you sure to delete category "'+category_name+'"?',
                    showCancelButton: true,
                    confirmButtonColor: '#3490dc',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        var data = ({
                            "_token" : $('input[name=_token]').val(),
                            "id" : category_id,
                        });
                       $.ajax({
                            type: 'DELETE',
                            url: '/categories/'+category_id,
                            data: data,
                            success: function(response) {
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
                                    title: 'Category "'+ category_name +'" has been deleted successfully.'
                                })
                                .then((result) => {
                                    location.reload();
                                });
                            }
                       })
                    }
                })
             });
        });
    </script>
@endsection