<?php

namespace App\Http\Controllers;

use App\Category;
use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('admin', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', ['categories' => $categories]); /* alternative compact('categories') */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name'], '-'),
        ]);

        return redirect('admin/categories')->with('categoryAdd', 'New category has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $categoryBlogs = $category->blog()->Where('status', 1)->latest()->paginate(5);
        return view('categories.show', compact('category','categoryBlogs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id); 
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect('admin/categories')->with('categoryEdit', 'Category has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

    }
}
