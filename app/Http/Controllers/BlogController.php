<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Blog;
use App\User;
use App\Category;
use App\Mail\BlogPublished;
use Illuminate\Support\Facades\Mail;
use Session;


class BlogController extends Controller
{
    public function __construct() {
        $this->middleware('admin', ['only' => ['restore', 'permanentDelete']]);
        $this->middleware('author', ['only'=> ['create', 'store', 'edit', 'update', 'delete'] ]);
        $this->middleware('auth', ['except' => ['index', 'show', 'searchResult']]);
    }

    public function index() {
        $blogs = Blog::Where('status', '1')->latest()->paginate(5);
        return view('blogs.index', compact('blogs'));
    }

    public function create() {
        $categories = Category::latest()->get();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request) {
        // validate
        $rules = [
            'title' => ['required', 'min:20', 'max:160'],
            'content' => ['required', 'min: 250']
        ];

        $this->validate($request, $rules);

        $input = $request->all();
        $input['slug'] = Str::slug($request->title);
        $input['meta_title'] = Str::limit($request->title, 55);
        $input['meta_description'] =  Str::limit($request->content, 155);
        //image upload
        if($file = $request->file('featured_image')) {
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move('images/featured_image/', $file_name);
            $input['featured_image'] = $file_name;
        }
        // $blog = Blog::create($input);
        $blogByUser = $request->user()->blogs()->create($input); 
        if($request->category_id) {
            $blogByUser->category()->sync($request->category_id);
        }

        //mail
        $users = User::all();
        foreach($users as $user) {
            Mail::to($user->email)->send(new BlogPublished($blogByUser, $user));
        }

        return redirect('/blogs')->with('blogPublish', 'Your blog has been published successfully.');
    }

    public function show($slug) { 
        // $blog = Blog::findOrFail($id);
        $blog = Blog::whereSlug($slug)->first();
        return view('blogs.show', compact('blog'));
    }

    public function edit($id) {
        $blog = Blog::findOrFail($id);   
        $categories = Category::latest()->get();

        return view('admin.blogs', compact('blog','categories'));
    }

    public function update(Request $request, $id, $keyword) {
        $input = $request->all();
        $blog = Blog::findOrFail($id);
        //image upload
        if($file = $request-> file('featured_image')) {
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move('images/featured_image', $file_name);
            $input['featured_image'] = $file_name;
        }  
        $blog->update($input);
        //Sync Categories
        if($request->category_id) {
            $blog->category()->sync($request->category_id);
        }

        if($keyword === 'draft-blog') {
            return back()->with('draftBlog', 'Blog has been saved as draft.');
        }

        if($keyword === 'publish-blog') {
            return back()->with('publishBlog', 'Blog has been published.');
        }

        if($keyword === 'edit-blog') {
            return back()->with('blogEdit', 'Blog has been updated successfully.');
        }
    }

    public function delete($id) {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        //  alternative  
        //  Blog::destroy($id);
    } 

    public function trash() {
        $trashedBlogs = Blog::onlyTrashed()->get();
        return view('blogs.trash', compact('trashedBlogs'));
    }

    public function restore($id) {
        $restoredBlog = Blog::onlyTrashed()->findOrFail($id);
        $restoredBlog->restore($restoredBlog);

        return back()->with('blogRestore', 'Blog has been restored successfully.');
    }

    public function permanentDelete($id) {
        $permanentDeleteBlog = Blog::onlyTrashed()->findOrFail($id);
        $permanentDeleteBlog->forceDelete($permanentDeleteBlog);

    }

    public function searchResult(Request $request) {
        $search_query = $request->search_query;

        if($search_query) {
            $blogs = Blog::where('title', 'LIKE', '%'. $search_query. '%')->where('status', 1)->orderBy("id", "desc")->get();
            return view('blogs.search', compact('blogs', 'search_query'));
        }
        else {
            return redirect('/')->with('searchFieldEmpty', 'Search Field is Empty!');
        }
    }
}