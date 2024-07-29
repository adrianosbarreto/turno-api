<?php

namespace Tests\Repositories;

use App\Models\UserData;
use App\Repositories\UserDataRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserDataRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected UserDataRepository $userDataRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userDataRepo = app(UserDataRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_data()
    {
        $userData = UserData::factory()->make()->toArray();

        $createdUserData = $this->userDataRepo->create($userData);

        $createdUserData = $createdUserData->toArray();
        $this->assertArrayHasKey('id', $createdUserData);
        $this->assertNotNull($createdUserData['id'], 'Created UserData must have id specified');
        $this->assertNotNull(UserData::find($createdUserData['id']), 'UserData with given id must be in DB');
        $this->assertModelData($userData, $createdUserData);
    }

    /**
     * @test read
     */
    public function test_read_user_data()
    {
        $userData = UserData::factory()->create();

        $dbUserData = $this->userDataRepo->find($userData->id);

        $dbUserData = $dbUserData->toArray();
        $this->assertModelData($userData->toArray(), $dbUserData);
    }

    /**
     * @test update
     */
    public function test_update_user_data()
    {
        $userData = UserData::factory()->create();
        $fakeUserData = UserData::factory()->make()->toArray();

        $updatedUserData = $this->userDataRepo->update($fakeUserData, $userData->id);

        $this->assertModelData($fakeUserData, $updatedUserData->toArray());
        $dbUserData = $this->userDataRepo->find($userData->id);
        $this->assertModelData($fakeUserData, $dbUserData->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_data()
    {
        $userData = UserData::factory()->create();

        $resp = $this->userDataRepo->delete($userData->id);

        $this->assertTrue($resp);
        $this->assertNull(UserData::find($userData->id), 'UserData should not exist in DB');
    }
}
