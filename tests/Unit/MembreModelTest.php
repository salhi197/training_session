<?php
namespace Tests\Unit;

use App\Models\Membre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MembreModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_membre()
    {
        $membre = Membre::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
        ]);

        $this->assertDatabaseHas('membres', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
        ]);
    }

    /** @test */
    public function it_requires_unique_email()
    {
        Membre::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        Membre::create([
            'name' => 'Jane Doe',
            'email' => 'john@example.com', // Duplicate email
            'phone' => '987654321',
        ]);
    }
}

