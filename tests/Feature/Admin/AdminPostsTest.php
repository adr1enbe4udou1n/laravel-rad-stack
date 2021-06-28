<?php

use App\Console\Commands\PublishScheduledPosts;
use App\Enums\PostStatusEnum;
use App\Exports\PostExport;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Inertia\Testing\Assert;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function PHPUnit\Framework\assertCount;

uses(RefreshDatabase::class);

beforeEach(function () {
    actingAs(User::factory()->superAdmin()->create());
});

test('admin can list posts', function () {
    Post::factory()
        ->for(PostCategory::factory()->state([
            'name' => 'My post category',
        ]), 'category')
        ->create([
            'title' => 'My post title',
            'summary' => 'My post summary',
        ])
    ;
    Post::factory(29)->create();

    $response = get('/admin/posts');

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('posts/Index')
            ->where('posts.data.0.title', 'My post title')
            ->where('posts.data.0.category.name', 'My post category')
            ->where('posts.data.0.summary', 'My post summary')
            ->where('posts.meta.total', 30)
    );
});

test('admin can get ordered post categories json', function () {
    PostCategory::factory()->createMany([
        [
            'name' => 'Category 1',
        ],
        [
            'name' => 'Category 2',
        ],
    ]);

    /** @var PostCategory */
    $category = PostCategory::query()->first();
    $category->swapOrderWithModel(PostCategory::query()->skip(1)->first());

    $response = get('/admin/post-categories');

    $response->assertStatus(200);
    $response->assertJson([
        [
            'name' => 'Category 2',
        ],
        [
            'name' => 'Category 1',
        ],
    ]);
});

test('admin can sort posts', function (string $sort, $expected) {
    Post::factory()
        ->createMany([
            [
                'title' => 'My post title 1',
                'published_at' => Carbon::make('2020-01-01'),
            ],
            [
                'title' => 'My post title 2',
                'published_at' => Carbon::make('2020-02-01'),
            ],
        ])
    ;

    $response = get("/admin/posts?sort={$sort}");

    $attribute = Str::of($sort)->trim('-');

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('posts/Index')
            ->where("posts.data.0.{$attribute}", $expected)
            ->where('posts.meta.total', 2)
            ->where('sort', $sort)
    );
})->with([
    ['title', 'My post title 1'],
    ['-title', 'My post title 2'],
    ['published_at', Carbon::make('2020-01-01')->toISOString()],
    ['-published_at', Carbon::make('2020-02-01')->toISOString()],
]);

test('admin can filter posts', function (array $filter, int $total) {
    Post::factory()
        ->createMany([
            [
                'title' => 'My post title 1',
                'summary' => 'My post summary',
                'body' => '<p>My post body</p>',
                'status' => PostStatusEnum::draft(),
                'published_at' => Carbon::make('2020-01-01'),
                'pin' => true,
                'promote' => true,
            ],
            [
                'title' => 'My post title 2',
                'status' => PostStatusEnum::published(),
                'published_at' => Carbon::make('2021-01-01'),
                'pin' => false,
                'promote' => false,
            ],
        ])
    ;

    $query = filterAsQuery($filter);
    $response = get("/admin/posts?{$query}");

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('posts/Index')
            ->where('posts.meta.total', $total)
            ->where('filter', $filter)
    );
})->with([
    [['title' => 'post title 1'], 1],
    [['title' => 'post title'], 2],
    [['summary' => 'post summary'], 1],
    [['body' => 'post body'], 1],
    [['status' => 'draft'], 1],
    [['pin' => '1', 'promote' => '1'], 1],
    [['pin' => '1', 'promote' => '0'], 0],
    [['published_at' => Carbon::make('2020-12-01')->format('Y-m-d').','.Carbon::make('2021-02-01')->format('Y-m-d')], 1],
]);

test('admin can export posts', function () {
    Excel::fake();
    Post::factory(9)->create();

    get('/admin/posts?export=1');

    Excel::matchByRegex();
    Excel::assertDownloaded('/export-.*\\.xlsx/', function (PostExport $export) {
        return 9 === $export->query()->count() && $export->headings() && $export->map($export->query()->first());
    });
});

test('admin can render post create page', function () {
    $response = get('/admin/posts/create');

    $response->assertInertia(
        fn (Assert $page) => $page->component('posts/Create')
    );
});

test('admin can render post edit page', function () {
    /** @var Post */
    $post = Post::factory()->create();

    $response = get("/admin/posts/{$post->id}/edit");

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('posts/Edit')
            ->where('post.id', $post->id)
            ->where('post.title', $post->title)
    );
});

test('admin can store post', function (array $data, array $expected) {
    $category = PostCategory::factory()->create();

    $response = post('/admin/posts', $data + [
        'category_id' => $category->id,
    ]);

    $response->assertStatus(302);
    $response->assertSessionDoesntHaveErrors();

    assertDatabaseHas('posts', $expected);
})->with([[
    [
        'title' => 'My new post',
        'summary' => 'My summary of the new post',
    ],
    [
        'title' => 'My new post',
        'summary' => 'My summary of the new post',
        'status' => 'draft',
        'slug' => 'my-new-post',
        'published_at' => null,
    ],
], [
    [
        'title' => 'My new post',
        'summary' => 'My summary of the new post',
        'publish' => true,
        'pin' => true,
        'promote' => true,
    ],
    [
        'title' => 'My new post',
        'summary' => 'My summary of the new post',
        'status' => 'published',
        'pin' => true,
        'promote' => true,
        'published_at' => Carbon::now()->second(0),
    ],
], [
    [
        'title' => 'My new post',
        'summary' => 'My summary of the new post',
        'publish' => true,
        'published_at' => Carbon::tomorrow(),
    ],
    [
        'title' => 'My new post',
        'summary' => 'My summary of the new post',
        'status' => 'scheduled',
    ],
]]);

test('admin cannot store post with invalid data', function (array $data, array $expected) {
    $category = PostCategory::factory()->create();

    $response = post('/admin/posts', $data + [
        'category_id' => $category->id,
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors($expected);
})->with('invalid_posts');

test('admin can update post', function (array $initial, array $data, array $expected) {
    $post = Post::factory()
        ->for(PostCategory::factory(), 'category')
        ->create($initial)
    ;

    $response = put("/admin/posts/{$post->id}", $data + [
        'category_id' => $post->category->id,
    ]);

    $response->assertStatus(302);
    $response->assertSessionDoesntHaveErrors();

    assertDatabaseHas('posts', $expected);
})->with([[
    [
        'slug' => 'initial-slug',
        'status' => 'draft',
    ],
    [
        'title' => 'My updated title',
        'summary' => 'My updated summary',
    ],
    [
        'title' => 'My updated title',
        'summary' => 'My updated summary',
        'slug' => 'initial-slug',
    ],
], [
    [
        'slug' => 'initial-slug',
        'status' => 'published',
        'published_at' => Carbon::now()->second(0),
    ],
    [
        'title' => 'My updated title',
        'summary' => 'My updated summary',
        'publish' => true,
        'published_at' => Carbon::now()->second(0)->toISOString(),
    ],
    [
        'status' => 'published',
        'title' => 'My updated title',
        'summary' => 'My updated summary',
        'slug' => 'initial-slug',
    ],
]]);

test('admin cannot update post with invalid data', function (array $data, array $expected) {
    $post = Post::factory()
        ->draft()
        ->for(PostCategory::factory(), 'category')
        ->create()
    ;

    $response = put("/admin/posts/{$post->id}", $data + [
        'category_id' => $post->category->id,
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors($expected);
})->with('invalid_posts');

test('admin can delete post', function () {
    $post = Post::factory()->create([
        'title' => 'My deleted post',
    ]);

    $response = delete("/admin/posts/{$post->id}");

    $response->assertStatus(302);
    $response->assertSessionDoesntHaveErrors();
    assertDatabaseMissing('posts', [
        'title' => 'My deleted post',
    ]);
});

test('scheduled posts are published when current time overlaps post publication date', function () {
    Post::factory()->draft()->create([
        'published_at' => (new Carbon())->subDay(1),
    ]);
    Post::factory()->scheduled()->create([
        'published_at' => (new Carbon())->subDay(1),
    ]);
    Post::factory()->scheduled()->create([
        'published_at' => (new Carbon())->addDay(1),
    ]);
    Post::factory()->published()->create([
        'published_at' => (new Carbon())->subDay(1),
    ]);

    artisan(PublishScheduledPosts::class);

    assertCount(1, Post::draft()->get());
    assertCount(1, Post::scheduled()->get());
    assertCount(2, Post::published()->get());
});
