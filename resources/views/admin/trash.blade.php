@extends('admin.index')

@section('dashboard-content-right')
<h3 class="text-center" style="color: #3490dc;"><strong><span style="width: 30px; height: 30xp; background-color: #3490dc; padding: 0px 5px; border-radius: 5px;"><i class="fa fa-trash admin-link-icon" aria-hidden="true" style="color:#fff; font-size: 25px;"></i></span> Trashed Blogs</strong></h3>
    @include('blogs.trash')
@endsection