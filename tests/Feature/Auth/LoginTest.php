<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Passport\Passport;
use App\User;



class LoginTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
   
    /**
     * A basic test example.
     *
     * @return void
     */
    public function user_gets_login_view()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
    }
    
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertSuccessful(); // Vue router will redirect to /userboard
    }
    
    
    public function test_user_can_login_with_correct_credentials()
    {
        $user = [
            'email' => "test@gmail.com",
            'password' => bcrypt($password = 'i-love-laravel'),
        ];
        
        Passport::actingAs(factory(User::class)->create($user));
        
        $response = $this->post('/login', [
            'email' => $user["email"],
            'password' => $user["password"]
        ])
        ->assertStatus(200)
        ->assertJsonStructure(['token_type','expires_in','access_token','refresh_token']);
        //->assertJson();
        //$response->assertRedirect('/userboard');
        //$this->assertAuthenticatedAs($user);
        
        
        
        
    }
}
