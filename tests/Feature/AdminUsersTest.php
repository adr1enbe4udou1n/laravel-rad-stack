<?php

use App\Enums\RoleEnum;
use App\Exports\UserExport;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Inertia\Testing\Assert;
use Maatwebsite\Excel\Facades\Excel;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

beforeEach(function () {
    actingAs(User::factory()->admin()->create());
    User::addGlobalScope('admin', fn (Builder $builder) => $builder->where('id', '!=', 1));
});

test('admin can list users', function () {
    User::factory(30)->create();

    $response = get('/admin/users');

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('users/Index')
            ->where('action', 'list')
            ->where('users.total', 30)
    );
});

test('admin can sort users', function (string $sort, $expected) {
    User::factory()->createMany(
        collect(range(1, 9))->map(fn ($i) => [
            'name' => "user {$i}",
            'email' => "user-{$i}@example.com",
        ])->toArray()
    );

    $response = get("/admin/users?sort={$sort}");

    $attribute = Str::of($sort)->trim('-');

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('users/Index')
            ->where('action', 'list')
            ->where("users.data.0.{$attribute}", $expected)
            ->where('users.total', 9)
            ->where('sort', $sort)
    );
})->with([
    ['id', 2], ['name', 'user 1'],
    ['-id', 10], ['-name', 'user 9'],
]);

test('admin can filter users', function (array $filter, int $total) {
    User::factory()->createMany(
        collect(range(1, 9))->map(fn ($i) => [
            'name' => "user {$i}",
            'email' => "user-{$i}@example.com",
            'role' => RoleEnum::user(),
        ])->toArray()
    );

    $query = filterAsQuery($filter);
    $response = get("/admin/users?{$query}");

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('users/Index')
            ->where('action', 'list')
            ->where('users.total', $total)
            ->where('filter', $filter)
    );
})->with([
    [['q' => 'user'], 9],
    [['q' => 'user 9'], 1],
    [['name' => 'user 9'], 1],
    [['email' => 'user'], 9],
    [['email' => 'user-5'], 1],
    [['name' => 'user 1', 'email' => 'user-1'], 1],
    [['name' => 'user 1', 'email' => 'user-2'], 0],
    [['active' => '1'], 9],
    [['active' => '0'], 0],
    [['role' => 'user'], 9],
    [['role' => 'admin'], 0],
]);

test('admin can export users', function () {
    Excel::fake();
    User::factory()->createMany(
        collect(range(1, 9))->map(fn ($i) => [
            'name' => "user {$i}",
            'email' => "user-{$i}@example.com",
            'role' => RoleEnum::user(),
        ])->toArray()
    );

    get('/admin/users?export=1');

    Excel::matchByRegex();
    Excel::assertDownloaded('/export-.*\\.xlsx/', function (UserExport $export) {
        /* @var User $user */
        return 9 === $export->query()->count();
    });
});

test('admin can show user', function () {
    $user = User::factory()->create();

    $response = get("/admin/users/{$user->id}");

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('users/Index')
            ->where('action', 'show')
            ->where('user.id', $user->id)
            ->where('user.name', $user->name)
            ->where('user.email', $user->email)
    );
});

test('admin can create user', function () {
    $response = get('/admin/users/create');

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('users/Index')
            ->where('action', 'create')
    );
});

test('admin can edit user', function () {
    $user = User::factory()->create();

    $response = get("/admin/users/{$user->id}/edit");

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('users/Index')
            ->where('action', 'edit')
            ->where('user.id', $user->id)
            ->where('user.name', $user->name)
            ->where('user.email', $user->email)
    );
});

test('admin can store user', function () {
    $response = post('/admin/users', [
        'name' => 'example',
        'email' => 'user@example.com',
        'password' => 'password',
        'active' => true,
        'role' => RoleEnum::user(),
    ]);

    $response->assertSessionDoesntHaveErrors();
    assertDatabaseHas('users', [
        'name' => 'example',
        'email' => 'user@example.com',
        'active' => true,
        'role' => RoleEnum::user(),
    ]);
});

test('admin can update user', function () {
    $user = User::factory()->create();

    $response = put("/admin/users/{$user->id}", [
        'name' => 'example',
        'email' => 'user@example.com',
        'password' => 'password',
        'active' => true,
        'role' => RoleEnum::user(),
    ]);

    $response->assertSessionDoesntHaveErrors();
    assertDatabaseHas('users', [
        'name' => 'example',
        'email' => 'user@example.com',
        'active' => true,
        'role' => RoleEnum::user(),
    ]);
});

test('admin can delete user', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
    ]);

    $response = delete("/admin/users/{$user->id}");

    $response->assertSessionDoesntHaveErrors();
    assertDatabaseMissing('users', [
        'email' => 'user@example.com',
    ]);
});
