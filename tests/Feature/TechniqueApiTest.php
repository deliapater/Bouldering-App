<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Technique;
use App\Models\User;

class TechniqueApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
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

    //  /**
    //  * Test fetching a single technique.
    //  * @return void
    //  */
    // public function test_fetch_single_technique()
    // {
    //     $technique = Technique::first();
    //     $response = $this->getJson("/api/techniques/{$technique->id}");
    //     $response->assertStatus(200)
    //             ->assertJsonFragment(['name' => $technique->name]);
    // }

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