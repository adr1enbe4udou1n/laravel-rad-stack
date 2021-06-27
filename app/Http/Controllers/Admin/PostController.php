<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Queries\PostQuery;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Http\Requests\Admin\PostUpdateRequest;
use App\Http\Resources\Admin\PostResource;
use App\Models\Post;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post as HttpPost;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix('posts')]
class PostController extends Controller
{
    #[Get('/', name: 'posts')]
    public function index()
    {
        return app(PostQuery::class)->make()
            ->paginateOrExport(fn ($data) => Inertia::render('posts/Index', $data))
        ;
    }

    #[Get('create', name: 'posts.create')]
    public function create()
    {
        return Inertia::render('posts/Create');
    }

    #[Get('{post}/edit', name: 'posts.edit')]
    public function edit(Post $post)
    {
        return Inertia::render('posts/Edit', [
            'post' => PostResource::make($post),
        ]);
    }

    #[HttpPost('/', name: 'posts.store')]
    public function store(PostStoreRequest $request)
    {
        Post::create($request->validated());

        return redirect()->route('admin.posts')->with('flash.success', __('Post created.'));
    }

    #[Put('{post}', name: 'posts.update')]
    public function update(Post $post, PostUpdateRequest $request)
    {
        $post->update($request->validated());

        return redirect()->route('admin.posts')->with('flash.success', __('Post updated.'));
    }

    #[Delete('{post}', name: 'posts.destroy')]
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts')->with('flash.success', __('Post deleted.'));
    }
}
