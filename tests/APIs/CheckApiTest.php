<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Check;

class CheckApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_check()
    {
        $check = Check::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/checks', $check
        );

        $this->assertApiResponse($check);
    }

    /**
     * @test
     */
    public function test_read_check()
    {
        $check = Check::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/checks/'.$check->id
        );

        $this->assertApiResponse($check->toArray());
    }

    /**
     * @test
     */
    public function test_update_check()
    {
        $check = Check::factory()->create();
        $editedCheck = Check::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/checks/'.$check->id,
            $editedCheck
        );

        $this->assertApiResponse($editedCheck);
    }

    /**
     * @test
     */
    public function test_delete_check()
    {
        $check = Check::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/checks/'.$check->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/checks/'.$check->id
        );

        $this->response->assertStatus(404);
    }
}
