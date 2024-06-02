<?php

namespace Tests\Feature\Models;

use App\Models\Transect;
use App\Models\Departure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class TransectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to create a transect.
     *
     * @return void
     */
    public function testCreateTransect(): void
    {
        $transectData = ['name' => 'Test Transect'];

        $transect = Transect::create($transectData);

        $this->assertDatabaseHas('transects', $transectData);
        $this->assertEquals('Test Transect', $transect->name);
    }

    /**
     * Test to update a transect.
     *
     * @return void
     */
    public function testUpdateTransect(): void
    {
        $transect = Transect::factory()->create(['name' => 'Old Name']);
        $updateData = ['name' => 'Updated Name'];

        $request = Request::create('/transects/update', 'POST', $updateData);
        $result = Transect::updateFromRequest($request, $transect->id);

        $this->assertTrue($result);
        $this->assertDatabaseHas('transects', ['name' => 'Updated Name']);
    }

    /**
     * Test to search transects by name.
     *
     * @return void
     */
    public function testSearchTransects(): void
    {
        Transect::factory()->create(['name' => 'Test Transect 1']);
        Transect::factory()->create(['name' => 'Another Transect']);
        Transect::factory()->create(['name' => 'Test Transect 2']);

        $searchResults = Transect::search('Test')->get();

        $this->assertCount(2, $searchResults);
        $this->assertTrue($searchResults->contains('name', 'Test Transect 1'));
        $this->assertTrue($searchResults->contains('name', 'Test Transect 2'));
    }

    /**
     * Test to get filtered transects.
     *
     * @return void
     */
    public function testGetFilteredTransects(): void
    {
        Transect::factory()->create(['name' => 'Alpha']);
        Transect::factory()->create(['name' => 'Beta']);
        Transect::factory()->create(['name' => 'Gamma']);
        Transect::factory()->create(['name' => 'Delta']);
    
        $request = Request::create('/transects', 'GET', [
            'search' => 'Alph',
            'orderByField' => 'name',
            'orderByDirection' => 'asc'
        ]);
    
        $filteredTransects = Transect::getFilteredTransects($request);
    
        $this->assertCount(1, $filteredTransects);
        $this->assertEquals('Alpha', $filteredTransects->first()->name);
    }

    /**
     * Test the relationship with departures.
     *
     * @return void
     */
    public function testTransectHasManyDepartures(): void
    {
        $transect = Transect::factory()->create();
        Departure::factory()->create(['transect_id' => $transect->id]);
        Departure::factory()->create(['transect_id' => $transect->id]);

        $this->assertCount(2, $transect->departure);
    }
}

