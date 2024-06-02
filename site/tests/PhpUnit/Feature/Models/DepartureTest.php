<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Departure;
use App\Models\Boat;
use App\Models\Transect;
use App\Models\User;
use Illuminate\Http\Request;

class DepartureTest extends TestCase
{
    use RefreshDatabase;

    public function testDepartureCreation(): void
    {
        $boat = Boat::factory()->create();
        $transect = Transect::factory()->create();

        Departure::factory()->create([
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-06-01',
            'observers' => 'John Doe'
        ]);

        $this->assertDatabaseHas('departures', [
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-06-01',
            'observers' => 'John Doe'
        ]);
    }

    public function testDepartureSearchScope(): void
    {
        $boat = Boat::factory()->create();
        $transect = Transect::factory()->create();

        Departure::factory()->create([
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-06-01',
            'observers' => 'John Doe'
        ]);

        Departure::factory()->create([
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-07-01',
            'observers' => 'Jane Doe'
        ]);

        $departures = Departure::search('2023-06-01')->get();
        $this->assertCount(1, $departures);
        $this->assertEquals('2023-06-01', $departures->first()->date);

        $departures = Departure::search($boat->id)->get();
        $this->assertCount(2, $departures);
    }

    public function testDepartureUpdate(): void
    {
        $boat = Boat::factory()->create();
        $transect = Transect::factory()->create();

        $departure = Departure::factory()->create([
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-06-01',
            'observers' => 'John Doe'
        ]);

        $request = new Request([
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-06-02',
            'users' => [1]
        ]);

        $updateResult = Departure::updateFromRequest($request, $departure->id);
        $this->assertTrue($updateResult);

        $this->assertDatabaseHas('departures', [
            'date' => '2023-06-02'
        ]);
    }

    public function testDepartureCreateIfNotExists(): void
    {
        $boat = Boat::factory()->create();
        $transect = Transect::factory()->create();

        $data = [
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-06-01',
            'users' => [1]
        ];

        $departure = Departure::createIfNotExists($data);
        $this->assertNotNull($departure);

        $this->assertDatabaseHas('departures', [
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-06-01'
        ]);

        $departure = Departure::createIfNotExists($data);
        $this->assertNull($departure);
    }

    public function testDepartureDeleteIfNoObservations(): void
    {
        $boat = Boat::factory()->create();
        $transect = Transect::factory()->create();

        $departure = Departure::factory()->create([
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-06-01',
            'observers' => 'John Doe'
        ]);

        $result = $departure->deleteIfNoObservations();
        $this->assertTrue($result);

        $this->assertDatabaseMissing('departures', [
            'id' => $departure->id
        ]);
    }

    public function testGetObserverUsers(): void
    {
        $boat = Boat::factory()->create();
        $transect = Transect::factory()->create();

        $user = User::factory()->create(['name' => 'John Doe']);
        $departure = Departure::factory()->create([
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => '2023-06-01',
            'observers' => 'John Doe'
        ]);

        $observerUsers = $departure->getObserverUsers();
        $this->assertCount(1, $observerUsers);
        $this->assertEquals($user->id, $observerUsers->first()->id);
    }

    public function testGetObserversAttribute(): void
    {
        $departure = Departure::factory()->create([
            'observers' => 'John Doe, Jane Smith'
        ]);

        $observers = $departure->observers;
        $this->assertIsArray($observers);
        $this->assertCount(2, $observers);
        $this->assertEquals('John Doe', $observers[0]);
        $this->assertEquals('Jane Smith', trim($observers[1]));
    }
}
