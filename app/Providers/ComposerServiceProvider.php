<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\Blog;
use App\User;
use App\Category;
use App\Role;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.nav', 'admin.dashboard'], function($view) {
            $view->with('blogs', Blog::Where('status', '1')->get());
        });

        View::composer(['admin.trash'], function($view) {
            $view->with('trashedBlogs', Blog::onlyTrashed()->latest()->paginate(8));
        });

        View::composer(['admin.dashboard'], function($view) {
            $view->with('trashedBlogs', Blog::onlyTrashed()->get());
        });

        View::composer(['admin.users'], function($view) {
            $view->with('users', User::latest()->paginate(8));
        });

        View::composer(['admin.dashboard'], function($view) {
            $view->with('users', User::latest()->get());
        });

        View::composer(['admin.categories'], function($view) {
            $view->with('categories', Category::latest()->paginate(7));
        });

        View::composer(['admin.dashboard'], function($view) {
            $view->with('categories', Category::latest()->get());
        });

        View::composer('admin.users', function($view) {
            $view->with('roles', Role::All());
        });
    }
}
