<?php

namespace Tests\Feature\Api;

use App\User;
use Illuminate\Http\UploadedFile;
use Tests\Support\Structure;
use Tests\Support\Traits\InteractsWithPassport;

class AuthenticationTest extends TestCase
{
    use InteractsWithPassport;

    /** @test */
    public function a_guest_can_register()
    {
        $response = $this->postJson(route('api.auth.register'), [
            'name' => 'test',
            'email' => 'test@test.com',
            'date_of_birth' => '1993-08-09',
            'password' => 'password',
            'password_confirmation' => 'password',
            'image' => UploadedFile::fake()->image('photo1.jpg'),
        ]);

        $response->assertSuccessful()->assertJsonStructure([
            'data' => Structure::make(User::class)
        ]);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    public function a_user_can_login()
    {
        factory(User::class)->create([
            'email' => 'test@test.com',
        ]);

        $response = $this->postJson(route('api.auth.login'), [
            'email' => 'test@test.com',
            'password' => 'password',
        ]);

        $response->assertJsonStructure([
            'data' => Structure::make(User::class)
        ]);

        $this->assertEquals(1, User::count());
    }
}
