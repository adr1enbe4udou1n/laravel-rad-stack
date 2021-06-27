<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('post-categories')]
class PostCategoryController extends Controller
{
    #[Get('/', name: 'post-categories')]
    public function reference()
    {
        return PostCategory::query()->ordered()->withCount('posts')->get();
    }
}
