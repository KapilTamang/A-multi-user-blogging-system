<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;
use App\Category;
use App\User;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
        $this->middleware('admin', ['only'=> ['users', 'categories', 'trash', 'createCategory']]);
        $this->middleware('verified');
    }

    public function index() {
        return view('admin.index');
    }

    public function blogs() {
        $publishedBlogs = Blog::Where('status', 1)->latest()->paginate(3);
        $draftBlogs = Blog::Where('status', '0')->latest()->paginate(3);
        return view('admin.blogs', compact('publishedBlogs', 'draftBlogs'));
    }

    public function adminBlogs($id) {
        $adminBlogs = Blog::Where('user_id', $id)->latest()->paginate(6);
        return view('admin.blogs', compact('adminBlogs'));
    }

    public function create() {
        $categories = Category::latest()->get();
        return view('admin.create', compact('categories'));
    }

    public function dashboard() {
        $categories = Category::latest()->get();
        return view('admin.dashboard');
    }

    public function users() { ///access users from UserControlller
        return view('admin.users');
    }

    public function categories() {
        return view('admin.categories');
    }

    public function trash() {
        return view('admin.trash');
    }

    public function getProfile($id) {
        $userProfile = User::findOrFail($id);
        $publishedBlogs = $userProfile->blogs->Where('status', 1);
        return view('admin.profile', compact('userProfile', 'publishedBlogs'));
    }

    public function getUserProfile($id) {
        $userProfile = User::findOrFail($id);
        $publishedBlogs = $userProfile->blogs->Where('status', 1);
        return view('admin.users', compact('userProfile', 'publishedBlogs'));
    }

    public function createCategory() {
        return view('admin.categories');
    }

}
