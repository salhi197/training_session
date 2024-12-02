<?php
namespace Tests\Feature;

use App\Models\Membre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MembreControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_membres()
    {
        Membre::factory()->count(3)->create();

        $response = $this->get(route('membres.index'));

        $response->assertStatus(200);
        $response->assertViewIs('membres.index');
        $response->assertViewHas('membres');
    }

    /** @test */
    public function it_can_store_a_new_membre()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
        ];

        $response = $this->post(route('membres.store'), $data);

        $response->assertRedirect(route('membres.index'));
        $this->assertDatabaseHas('membres', $data);
    }

    /** @test */
    public function it_can_update_an_existing_membre()
    {
        $membre = Membre::factory()->create();

        $updatedData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '987654321',
        ];

        $response = $this->put(route('membres.update', $membre), $updatedData);

        $response->assertRedirect(route('membres.index'));
        $this->assertDatabaseHas('membres', $updatedData);
    }

    /** @test */
    public function it_can_delete_a_membre()
    {
        $membre = Membre::factory()->create();

        $response = $this->delete(route('membres.destroy', $membre));

        $response->assertRedirect(route('membres.index'));
        $this->assertDatabaseMissing('membres', ['id' => $membre->id]);
    }
}
