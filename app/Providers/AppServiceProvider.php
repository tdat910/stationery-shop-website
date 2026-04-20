<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // chỉ chạy khi bảng tồn tại
        if (Schema::hasTable('categories')) {
            View::share('all_categories', Category::all());
        }
    }

}
