<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Boat;
use Illuminate\Http\Request;

class BoatsTest extends TestCase
{
    use RefreshDatabase;

    public function testBoatCreation(): void
    {
        Boat::factory()->create([
            'name' => 'Boaty McBoatface',
            'registration_number' => '123456'
        ]);

        $this->assertDatabaseHas('boats', [
            'name' => 'Boaty McBoatface',
            'registration_number' => '123456'
        ]);

        $this->assertDatabaseMissing('boats', [
            'name' => 'Nonexistent Boat',
            'registration_number' => '654321'
        ]);
    }

    public function testBoatSearchScope(): void
    {
        Boat::factory()->create([
            'name' => 'Boaty McBoatface',
            'registration_number' => '123456'
        ]);

        Boat::factory()->create([
            'name' => 'Seabiscuit',
            'registration_number' => '654321'
        ]);

        $boats = Boat::search('Boaty')->get();
        $this->assertCount(1, $boats);
        $this->assertEquals('Boaty McBoatface', $boats->first()->name);

        $boats = Boat::search('123456')->get();
        $this->assertCount(1, $boats);
        $this->assertEquals('123456', $boats->first()->registration_number);
    }

    public function testBoatUpdate(): void
    {
        $boat = Boat::factory()->create([
            'name' => 'Boaty McBoatface',
            'registration_number' => '123456'
        ]);

        $request = new Request([
            'name' => 'Boaty McBoatface II',
            'registration_number' => '1234567'
        ]);

        $updateResult = Boat::updateFromRequest($request, $boat->id);
        $this->assertTrue($updateResult);

        $this->assertDatabaseHas('boats', [
            'name' => 'Boaty McBoatface II',
            'registration_number' => '1234567'
        ]);
    }

    public function testBoatCreateFromRequest(): void
    {
        $request = new Request([
            'name' => 'Boaty McBoatface',
            'registration_number' => '123456'
        ]);

        $newBoat = Boat::createFromRequest($request);

        $this->assertDatabaseHas('boats', [
            'name' => 'Boaty McBoatface',
            'registration_number' => '123456'
        ]);

        $this->assertEquals('Boaty McBoatface', $newBoat->name);
        $this->assertEquals('123456', $newBoat->registration_number);
    }

    public function testBoatGetFilteredBoats(): void
    {
        Boat::factory()->create([
            'name' => 'Boaty McBoatface',
            'registration_number' => '123456'
        ]);

        Boat::factory()->create([
            'name' => 'Seabiscuit',
            'registration_number' => '654321'
        ]);

        $request = new Request([
            'search' => 'Boaty',
            'orderByField' => 'name',
            'orderByDirection' => 'asc'
        ]);

        $boats = Boat::getFilteredBoats($request);

        $this->assertCount(1, $boats);
        $this->assertEquals('Boaty McBoatface', $boats->first()->name);

        $request = new Request([
            'search' => '123456',
            'orderByField' => 'registration_number',
            'orderByDirection' => 'desc'
        ]);

        $boats = Boat::getFilteredBoats($request);

        $this->assertCount(1, $boats);
        $this->assertEquals('123456', $boats->first()->registration_number);
    }
}
