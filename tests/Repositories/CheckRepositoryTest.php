<?php

namespace Tests\Repositories;

use App\Models\Check;
use App\Repositories\CheckRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CheckRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected CheckRepository $checkRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->checkRepo = app(CheckRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_check()
    {
        $check = Check::factory()->make()->toArray();

        $createdCheck = $this->checkRepo->create($check);

        $createdCheck = $createdCheck->toArray();
        $this->assertArrayHasKey('id', $createdCheck);
        $this->assertNotNull($createdCheck['id'], 'Created Check must have id specified');
        $this->assertNotNull(Check::find($createdCheck['id']), 'Check with given id must be in DB');
        $this->assertModelData($check, $createdCheck);
    }

    /**
     * @test read
     */
    public function test_read_check()
    {
        $check = Check::factory()->create();

        $dbCheck = $this->checkRepo->find($check->id);

        $dbCheck = $dbCheck->toArray();
        $this->assertModelData($check->toArray(), $dbCheck);
    }

    /**
     * @test update
     */
    public function test_update_check()
    {
        $check = Check::factory()->create();
        $fakeCheck = Check::factory()->make()->toArray();

        $updatedCheck = $this->checkRepo->update($fakeCheck, $check->id);

        $this->assertModelData($fakeCheck, $updatedCheck->toArray());
        $dbCheck = $this->checkRepo->find($check->id);
        $this->assertModelData($fakeCheck, $dbCheck->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_check()
    {
        $check = Check::factory()->create();

        $resp = $this->checkRepo->delete($check->id);

        $this->assertTrue($resp);
        $this->assertNull(Check::find($check->id), 'Check should not exist in DB');
    }
}
