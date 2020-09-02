<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin', ['except' => ['userBlogs']]);
        
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $keyword)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        // image upload
        if($file = $request->file('profile_image')) {
           $file_name = uniqid().$file->getClientOriginalName();
           $file->move('images/user', $file_name);
           $input['profile_image'] = $file_name;
        }
        $user->update($input);

        if($keyword === 'role-update') {
            return back()->with('userRoleEdit', 'User role has been updated successfully.');
        }
        else {
            return back()->with('profileUpdate', 'Profile has been updated successfully.');
        } 
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userBlogs($name) {
        $user = User::Where('name', $name)->first();
        $userBlogs = Blog::Where('user_id', $user->id)->Where('status', 1)->latest()->paginate(5);
        return view('blogs.index', compact('userBlogs','user'));
    }
}
