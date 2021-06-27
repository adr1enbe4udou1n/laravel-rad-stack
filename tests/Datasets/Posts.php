<?php

use Illuminate\Support\Carbon;

dataset('posts', [[
    [
        'title' => 'My new post',
        'summary' => 'My summary of the new post',
    ],
    [
        'title' => 'My new post',
        'summary' => 'My summary of the new post',
        'status' => 'draft',
        'slug' => 'my-new-post',
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

dataset('invalid_posts', [[
    [
        'summary' => 'My summary of the new post',
    ],
    [
        'title',
    ],
]]);
