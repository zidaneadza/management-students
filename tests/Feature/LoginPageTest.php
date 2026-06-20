<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginPageTest extends TestCase
{
    public function test_unauthenticated_user_is_redirected_to_login_page(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin123',
        ]);

        $response->assertRedirect('/');
        $this->assertEquals(true, session('is_logged_in'));
        $this->assertEquals('admin', session('username'));
    }

    public function test_user_can_reset_password_and_login_with_new_password(): void
    {
        $response = $this->post('/reset-password', [
            'username' => 'admin',
            'new_password' => 'newpass123',
        ]);

        $response->assertRedirect('/login');

        $loginResponse = $this->post('/login', [
            'username' => 'admin',
            'password' => 'newpass123',
        ]);

        $loginResponse->assertRedirect('/');
    }
}
