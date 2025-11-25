<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\postJson;
use function Pest\Laravel\withoutExceptionHandling;
use function Pest\Laravel\withToken;

beforeEach(function (): void {
    $this->credentials = [
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    $this->user = User::factory()->create([
        'email' => $this->credentials['email'],
        'password' => Hash::make($this->credentials['password']),
    ]);
});

it('can issue a personal API token', function (): void {
    withoutExceptionHandling();
    postJson(route('login'), $this->credentials)
        ->assertStatus(201)
        ->assertJsonStructure(['token']);

    $this->assertDatabaseHas('personal_access_tokens', [
        'tokenable_id' => $this->user->id,
        'tokenable_type' => User::class,
    ]);
});

test('users can not authenticate with invalid password', function (): void {
    postJson(route('login'), [
        'email' => $this->credentials['email'],
        'password' => 'wrong-password',
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['email']);

    $this->assertGuest();
});

test('users can logout', function (): void {
    $response = postJson(route('login'), $this->credentials);
    $token = $response->json('token');

    $response = withToken($token)->postJson('api/logout');

    $response->assertNoContent();

    $this->assertDatabaseMissing('personal_access_tokens', [
        'tokenable_id' => $this->user->id,
        'tokenable_type' => User::class,
    ]);
});
