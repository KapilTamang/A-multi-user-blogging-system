<nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #3490dc; color: #fff;">
    <div class="container-fluid" style="margin-left: 70px;">
        <span style="width: 30px; height: 30px; background-color: #eeeeee; margin-right: 8px; border-radius: 50%; padding: 6px;">
            <img src=" {{ asset('images/favicon.ico') }} " alt="" width="20px">
        </span>
        <a class="navbar-brand" href="{{ route('blogs') }}" style="font-weight: 600;">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto links">
                <li>
                    <a href="{{ route('blogs') }}" class="{{ request()->route()->getName() === 'blogs' ? 'nav-link active' : 'nav-link' }} {{ request()->route()->getName() === 'home' ? 'nav-link active' : 'nav-link' }} " style="color: #fff;">Blogs
                         <span class="badge badge-danger"> {{ $blogs->count() }} </span>
                    </a>
                </li>
                <li>
                <a href="{{ route('categories.index') }}"  class="{{ request()->route()->getName() === 'categories.index' ? 'nav-link active' : 'nav-link' }}" style="color: #fff;">Categories</a>
                </li>
                <li>
                    <a href="{{ route('author.index') }}"  class="{{ request()->route()->getName() === 'author.index' ? 'nav-link active' : 'nav-link' }}" style="color: #fff;">Authors</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"  class="{{ request()->route()->getName() === 'contact' ? 'nav-link active' : 'nav-link' }}" style="color: #fff;">Contact us</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li style="margin-right: 10px;">
                    <button  class="btn btn-info nav-link" data-toggle="modal" data-route="{{ route('blogs.search') }}" data-target="#blogSearch" style="color: #fff;">Search Blog &nbsp;<i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                </li>
                @if(Auth::user() && Auth::user()->role_id == 1)
                    <li>
                        <a href="{{ route('admin.index') }}" class="{{request()->route()->getName() === 'admin.index' ? 'nav-link active' : 'nav-link'}}" style="color: #fff;">Admin Dashboard</a>
                    </li>
                @elseif(Auth::user() && Auth::user()->role_id == 2)
                    <li>
                        <a href="{{ route('admin.index') }}" class="{{request()->route()->getName() === 'admin.index' ? 'nav-link active' : 'nav-link'}}" style="color: #fff;">Author Dashboard</a>
                    </li>
                @elseif(Auth::user() && Auth::user()->role_id ==3)
                    <li>
                        <a href="{{ route('admin.index') }}" class="{{request()->route()->getName() === 'admin.index' ? 'nav-link active' : 'nav-link'}}" style="color: #fff;">Subscriber Dashboard</a>
                    </li>
                @endif
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="color: #fff;">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color: #fff;">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" style="color: #fff;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Auth::user()->role->id == 1)
                            <i class="fa fa-circle" aria-hidden="true" style="color: #00e676; font-size: 12px;"></i>&nbsp; 
                            @elseif(Auth::user()->role->id ==2)
                            <i class="fa fa-circle" aria-hidden="true" style="color: #ffd54f; font-size: 12px;"></i>&nbsp;
                            @else
                            <i class="fa fa-circle" aria-hidden="true" style="color: #e53935; font-size: 12px;"></i>&nbsp;
                            @endif
                            {{ Auth::user()->name }} <span class="caret"></span>    
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
{{-- Modal for Search --}}
<div class="modal fade" id="blogSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="border-radius: 2px; borde: none;">
            <div class="modal-header">
                <div class="modal-body" style="padding-bottom: 0; margin: 0;">
                    <form id="search-form" method="post">
                        <div class="form-group row">
                            <div class="col-md-10" style="padding: 0 0 0 50px;">
                                <input type="text" class="form-control" name="search_query" placeholder="What are you looking for?" id="search_query">
                            </div>
                            <div class="col-md-2" style="padding: 0 0 0 10px;">
                                <button class="btn" type="submit" style="background-color: #3490dc; color: #fff;">Search&nbsp;<i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>         
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>  
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $('#blogSearch').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var route = button.data('route')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#search-form').attr('action', route);
        })
    </script>
@endsection