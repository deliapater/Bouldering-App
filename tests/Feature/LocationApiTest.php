<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Location;
use App\Models\User;

class LocationApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Location::factory()->count(3)->create();
    }
    /**
     * Test fetching all locations.
     * @return void
     */
    public function test_fetch_all_locations()
    {
        $response = $this->getJson('/api/locations');
        $response->assertStatus(200)
                ->assertJsonCount(3, 'data');
    }

     /**
     * Test creating a location.
     * @return void
     */
    // public function test_create_location()
    // {
    //     $data = [
    //         'name' => 'Test Location',
    //         'latitude' => 12.345,
    //         'longitude' => 67.890,
    //         'description' => '123 Test St',
    //     ];
    
    //     $response = $this->postJson('/api/locations', $data);
    //     $response->assertStatus(201)
    //              ->assertJsonFragment(['name' => 'Test Location']);

    //     $this->assertDatabaseHas('locations', $data);
    // }

    /**
     * Test fetching a single location.
     * @return void
     */
    public function test_fetch_single_location()
    {
        $location = Location::first();
        $response = $this->getJson("api/locations/{$location->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $location->name]);
    }

    // /**
    //  * Test updating a location.
    //  * @return void
    //  */
    // public function test_update_location()
    // {
    //     $location = Location::factory()->create();

    //     $updatedData = [
    //         'name' => 'Updated Location',
    //         'description' => '456 Updated St',
    //         'latitude' => 50.123456,
    //         'longitude' => -90.123456,
    //     ];

    //     $response = $this->putJson("/api/locations/{$location->id}", $updatedData);

    //     $response->assertStatus(200)
    //             ->assertJsonFragment(['name' => 'Updated Location']);
    //     $this->assertDatabaseHas('locations', $updatedData);
    // }

        /**
     * Test deleting a location.
     *
     * @return void
     */
    public function test_delete_location()
    {
        $location = Location::first();
        $response = $this->deleteJson("/api/locations/{$location->id}");
        $response->assertStatus(204);
        $this->assertSoftDeleted('locations', ['id' => $location->id]);
    }
}
