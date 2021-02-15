<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Manufacturer;

class ManufacturerTest extends TestCase
{
    /** @test */
    public function testSuccessfulIndexIngredient(): void
    {
        $manufacturers = Manufacturer::orderBy('created_at', 'DESC')->get();
        $this->get(route('manufacturers.index'))
            ->assertStatus(200)
            ->assertViewHas('manufacturers', $manufacturers)
            ->assertViewIs('manufacturers.index');
    }

    /** @test */
    public function testSuccessfulCreateIngredient(): void
    {
        $data = [
            'name' => 'TestManufacturer',
            'link' => 'testsomelink.com'
        ];
        $this->post(route('manufacturers.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('manufacturers.index'));
    }

    /** @test */
    public function testSuccessfulUpdateIngredient(): void
    {
        $manufacturer = Manufacturer::factory()->create();
        $this->put(
            route('manufacturers.update', ['manufacturer' => $manufacturer->id]),
            [
                'name' => 'TestChangedName',
                'link' => 'changingtestsomelink.com'
            ]
        )->assertStatus(302)
            ->assertRedirect(route('manufacturers.index'));
    }

    /** @test */
    public function testSuccessfulDeleteIngredient(): void
    {
        $manufacturer = Manufacturer::factory()->create();
        $this->delete(route('manufacturers.destroy', ['manufacturer' => $manufacturer->id]))
            ->assertStatus(302)
            ->assertRedirect(route('manufacturers.index'));
    }

    /** @test */
    public function testSuccessfulShowIngredient(): void
    {
        $manufacturer = Manufacturer::factory()->create();
        $this->get(route('manufacturers.show', ['manufacturer' => $manufacturer->id]))
            ->assertStatus(200)
            ->assertViewHas('manufacturer', $manufacturer)
            ->assertSeeText($manufacturer->name)
            ->assertViewIs('manufacturers.show');
    }
}
