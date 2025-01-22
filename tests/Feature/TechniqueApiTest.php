<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Technique;
use App\Models\User;

class TechniqueApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
        ]);

        $this->actingAs($this->user);

        Technique::factory()->count(3)->create();
    }
     /**
     * Test fetching all techniques.
     * @return void
     */
    public function test_fetch_all_techniques()
    {
        $response = $this->getJson('/api/techniques');
        $response->assertStatus(200)
                ->assertJsonCount(3, 'data');
    }

    /**
     * Test create a technique.
     * @return void
     */
    public function test_create_technique()
    {
        $this->actingAs($this->user);

        $response = $this->postJson(route('techniques.store'), [
            'name' => 'Flagging',
            'description' => 'flagging description',
            'steps_to_practice' => '1.2.3.4...',
            'difficulty_level' => 'intermediate'
        ]);

        $response->assertStatus(201);
    }

     /**
     * Test fetching a single technique.
     * @return void
     */
    public function test_fetch_single_technique()
    {

        $technique = Technique::first();
        $response = $this->getJson("/api/techniques/{$technique->id}");
        $response->assertStatus(200)
                ->assertJsonFragment(['name' => $technique->name]);
    }

    /**
     * Test updating a technique.
     * @return void
     */
    public function test_update_technique()
    {
        $technique = Technique::first();

        $this->actingAs($this->user);

        $updatedData = [
            'name' => 'Updated Heel Hook',
            'description' => 'Using your heel to hook onto a hold.',
            'difficulty_level' => 'intermediate',
            'steps_to_practice' => '1. Place your heel on the hold. 2. Push down to stabilize. 3. Engage your core for balance.',
        ];

        $response = $this->putJson("/api/techniques/{$technique->id}", $updatedData);

        $response->assertStatus(200)
                ->assertJsonFragment(['name' => 'Updated Heel Hook']);
        $this->assertDatabaseHas('techniques', $updatedData);
    }

    /**
     * Test deleting a technique.
     *
     * @return void
     */
    public function test_delete_technique()
    {
        $technique = Technique::first();
        $response = $this->deleteJson("/api/techniques/{$technique->id}");
        $response->assertStatus(204);
        $this->assertSoftDeleted('techniques', ['id' => $technique->id]);
    }
}