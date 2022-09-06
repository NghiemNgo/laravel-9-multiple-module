<?php
 
namespace Modules\Auth\Tests\Feature;
 
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
 
class AuthModuleTest extends TestCase
{
    /**
     * Test UserController's getAuthenticatedUser method
     *
     * @return void
     */
    public function test_getAuthenticatedUser_request()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg2L2FwaS92MS9hdXRoL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTY2MDk2Mjg3NywiZXhwIjoxNjYwOTY2NDc3LCJuYmYiOjE2NjA5NjI4NzcsImp0aSI6IndmVDBHdnRXUmVwQTd0UnYiLCJzdWIiOiIxIiwicHJ2IjoiMzRmNGZiOTVlMGNiYTNlZWE4YzM2MmYzYmQ4ZWNiNDQwNTcwYmQ0YSIsIjAiOiJyb2xlIiwiMSI6ImV4cCJ9._D3UkvDoNiZAuSjyg5MgkCcIU9u4-uAhPOYDwBheC2I',
        ])->getJson('/api/v1/auth/user');
        $response->assertStatus(200);
    }

    /**
     * Test UserController's register method
     *
     * @return void
     */
    public function test_register_request()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/auth/register', [
            'name' => 'Ngo Van Nghiem 3',
            'email' => 'nghiemnv3@tienngay.vn',
            'password' => '12345678'
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test UserController's authenticate method
     *
     * @return void
     */
    public function test_authenticate_request()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->postJson('/api/v1/auth/authenticate', [
            'email' => 'nghiemnv3@tienngay.vn',
            'password' => '12345678'
        ]);
        $response->assertStatus(200);
    }

}