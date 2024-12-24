<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Gear;
use App\Models\User;

class GearApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void 
    {
        parent::setUp();
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
     * @retuen void
     */
    public function test_fetch_single_gear()
    {
        $gear = Gear::first();
        $response = $this->getJson("/api/gears/{$gear->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $gear->name]);
    }

    //  /**
    //  * Test creating a new gear.
    //  * @retuen void
    //  */
    // public function test_create_gear()
    // {
    //     $data = [
    //         'name' => 'New Gear',
    //         'description' => 'A new gear description.',
    //         'category' => 'shoes'
    //     ];
    //     $response = $this->postJson('/api/gears', $data);
    //     $response->assertStatus(201)
    //              ->assertJsonFragment(['name' => 'New Gear']);
    //     $this->assertDatabaseHas('gears', $data);
    // }

    //TODO: test_update_gear()

    /**
     * Test deleting a gear.
     * @retuen void
     */
    public function test_delete_gear()
    {
        $gear = Gear::first();
        $response = $this->deleteJson("/api/gears/{$gear->id}");
        $response->assertStatus(204);
        $this->assertSoftDeleted('gears', ['id' => $gear->id]);
    }
}
