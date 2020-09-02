
<div class="col-md-12" style="margin-top: 10px; padding: 0;">
    @if(count($trashedBlogs) >= 1)
        <table class="content-table text-center" style="margin-bottom: 15px;">
            <thead>
                <tr>
                    <th><i class="fa fa-id-badge" aria-hidden="true"></i>&nbsp; Id</th>
                    <th><i class="fa fa-header" aria-hidden="true"></i>&nbsp; Title</th>
                    <th><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp; Content</th>
                    <th><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Author</th>
                    <th><i class="fa fa-calendar-check" aria-hidden="true"></i>&nbsp; Deleted at</th>
                    <th><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trashedBlogs as $blog)
                    @inject('Str', 'Illuminate\Support\Str')
                    <tr>
                    <td>{{ $blog->id }}</td>
                    <td>{{ Str::limit($blog->title, 50) }}</td>
                    <td>{{ Str::limit($blog->content, 30) }}</td>
                    <td> 
                        @if($blog->user)
                            {{ $blog->user->name }} 
                        @endif
                    </td>
                    <td>{{ $blog->deleted_at->diffForHumans() }}</td>
                    <td>
                        <div class="btn-group">
                            {{-- restore --}}
                            <form method="get" action="{{ route('blogs.restore', $blog->id) }}">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp; Restore</button>
                                {{ csrf_field() }}
                            </form>                      
                            {{-- delete --}}
                            {{-- <form method="post" action="{{ route('blogs.permanent-delete', $blog->id) }}">
                                {{ method_field('delete') }} --}}
                                <input type="hidden" class="blog-delete-id" value=" {{ $blog->id }} ">
                                <button type="submit" class="btn btn-danger btn-sm blog-delete-btn"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; Delete</button>
                                {{-- {{ csrf_field() }}
                            </form> --}}
                        </div>
                    </td>
                    </tr>                        
                @endforeach
            </tbody>
        </table>
        {{ $trashedBlogs->links() }}
    @else 
        <h3>No Trashed Items.</h3>
    @endif
</div>

@section('scripts') 
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.blog-delete-btn').click(function(e) {
                e.preventDefault();
                var blog_id = $(this).closest("tr").find('.blog-delete-id').val();
                Swal.fire({
                    title: 'Are you sure you want to delete this blog permanently?',
                    showCancelButton: true,
                    confirmButtonColor: '#3490dc',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        var data = {
                            "_token" : $('input[name=_token]').val(),
                            "id" : blog_id,
                        }
                        $.ajax({
                            type: 'DELETE',
                            url: '/blogs/trash/permanent-delete/'+ blog_id,
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
                                    title: 'Blog has been deleted permanently.'
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
