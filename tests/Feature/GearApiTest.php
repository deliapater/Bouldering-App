<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Gear;
use App\Models\User;

class GearApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void 
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123',
            'role' => 'admin',
        ]);
        Gear::factory()->count(3)->create();
    }

    /**
     * Test fetching all gears.
     * @return void
     */
    public function test_fetch_all_gears()
    {
        $response = $this->getJson('/api/gears');
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

     /**
     * Test fetching a single gear.
     * @return void
     */
    public function test_fetch_single_gear()
    {
        $gear = Gear::first();
        $response = $this->getJson("/api/gears/{$gear->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $gear->name]);
    }

    /**
     * Test creating a new gear.
     * @return void
     */
    public function test_create_gear()
    {
        $this->actingAs($this->user);
        $data = [
            'name' => 'New Gear',
            'description' => 'A new gear description.',
            'category' => 'shoes'
        ];
        $response = $this->postJson('/api/gears', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'New Gear']);
        $this->assertDatabaseHas('gears', $data);
    }

    /**
     * Test updating a gear.
     * @return void
     */
    public function test_update_gear()
    {
        $this->actingAs($this->user);
        $gear = Gear::first();
        $updatedData = [
            'name' => 'Updated Gear',
            'description' => 'Gear description.',
            'category' => 'shoes'
        ];
        $response = $this->putJson("/api/gears/{$gear->id}", $updatedData);

        $response->assertStatus(200)
                ->assertJsonFragment(['name' => 'Updated Gear']);
        $this->assertDatabaseHas('gears', $updatedData);
    }

    /**
     * Test deleting a gear.
     * @return void
     */
    public function test_delete_gear()
    {
        $gear = Gear::first();
        $response = $this->deleteJson("/api/gears/{$gear->id}");
        $response->assertStatus(204);
        $this->assertSoftDeleted('gears', ['id' => $gear->id]);
    }
}
