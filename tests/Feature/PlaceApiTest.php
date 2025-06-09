<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlaceApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_places()
    {
        Place::factory()->count(3)->create();

        $response = $this->getJson('/api/places');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_filter_places_by_name()
    {
        Place::factory()->create(['name' => 'Test Place 1']);
        Place::factory()->create(['name' => 'Test Place 2']);
        Place::factory()->create(['name' => 'Different Name']);

        $response = $this->getJson('/api/places?name=Test');

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    public function test_can_create_place()
    {
        $data = [
            'name' => 'New Place',
            'city' => 'Test City',
            'state' => 'Test State',
        ];

        $response = $this->postJson('/api/places', $data);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'New Place',
                'slug' => 'new-place',
                'city' => 'Test City',
                'state' => 'Test State',
            ]);

        $this->assertDatabaseHas('places', [
            'name' => 'New Place',
            'slug' => 'new-place',
        ]);
    }

    public function test_can_show_place()
    {
        $place = Place::factory()->create();

        $response = $this->getJson('/api/places/' . $place->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $place->id,
                'name' => $place->name,
            ]);
    }

    public function test_can_update_place()
    {
        $place = Place::factory()->create();

        $data = [
            'name' => 'Updated Place',
            'city' => 'Updated City',
        ];

        $response = $this->putJson('/api/places/' . $place->id, $data);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Updated Place',
                'slug' => 'updated-place',
                'city' => 'Updated City',
            ]);

        $this->assertDatabaseHas('places', [
            'id' => $place->id,
            'name' => 'Updated Place',
            'slug' => 'updated-place',
        ]);
    }

    public function test_can_delete_place()
    {
        $place = Place::factory()->create();

        $response = $this->deleteJson('/api/places/' . $place->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('places', [
            'id' => $place->id,
        ]);
    }
}
