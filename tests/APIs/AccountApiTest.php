<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Account;

class AccountApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_data()
    {
        $userData = Account::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user-datas', $userData
        );

        $this->assertApiResponse($userData);
    }

    /**
     * @test
     */
    public function test_read_user_data()
    {
        $userData = Account::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/user-datas/'.$userData->id
        );

        $this->assertApiResponse($userData->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_data()
    {
        $userData = Account::factory()->create();
        $editedUserData = Account::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user-datas/'.$userData->id,
            $editedUserData
        );

        $this->assertApiResponse($editedUserData);
    }

    /**
     * @test
     */
    public function test_delete_user_data()
    {
        $userData = Account::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user-datas/'.$userData->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user-datas/'.$userData->id
        );

        $this->response->assertStatus(404);
    }
}
