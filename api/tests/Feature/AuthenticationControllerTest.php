<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationControllerTest extends TestCase
{
    // esse use RefresDatabase faz com que a cada comando de teste ele reseta o banco pra não atrapalhar
    use RefreshDatabase;

    /**
     * Testa o registro de um novo usuário.
     *
     * @return void
     */
    public function test_register_creates_new_user()
    {
        // Dados do usuário para registro
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'telephone' => '1234567',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        // Faz a requisição para registrar o usuário
        $response = $this->postJson('/api/register', $data);

        // Verifica se o usuário foi criado com sucesso
        $response->assertStatus(200);
        $response->assertJson([
            'status' => true,
            'message' => 'User registered successfully'
        ]);

        // Verifica se o usuário foi salvo no banco de dados
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

}
