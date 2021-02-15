<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Drug;
use App\Models\Ingredient;
use App\Models\Manufacturer;

class DrugTest extends TestCase
{
    /** @test */
    public function testSuccessfulIndexDrug(): void
    {
        $drugs = Drug::orderBy('created_at', 'DESC')->get();
        foreach ($drugs as $drug) {
            $drug['ingredient'] = Ingredient::find($drug->ingredient_id)['name'];
            $drug['manufacturer'] = Manufacturer::find($drug->manufacturer_id)['name'];
        }
        $manufacturers = Manufacturer::pluck('name', 'id');
        $ingredients = Ingredient::pluck('name', 'id');
        $this->get(route('drugs.index'))
            ->assertStatus(200)
            ->assertViewHas('drugs', $drugs)
            ->assertViewHas('ingredients', $ingredients)
            ->assertViewHas('manufacturers', $manufacturers)
            ->assertViewIs('drugs.index');
    }

    /** @test */
    public function testSuccessfulCreateDrug(): void
    {
        $data = [
            'name' => 'TestDrug',
            'price' => 55,
            'manufacturer_id' => Manufacturer::inRandomOrder()->first()['id'],
            'ingredient_id' => Ingredient::inRandomOrder()->first()['id']
        ];

        $this->post(route('drugs.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('drugs.index'));
    }

    /** @test */
    public function testSuccessfulUpdateDrug(): void
    {
        $drug = Drug::factory()->create();
        $this->put(
            route('drugs.update', ['drug' => $drug->id]),
            [
                'name' => 'TestChangedNameDrug',
                'price' => 44,
                'ingredient_id' => Ingredient::inRandomOrder()->first()['id'],
                'manufacturer_id' => Manufacturer::inRandomOrder()->first()['id'],
            ]
        )->assertStatus(302)
            ->assertRedirect(route('drugs.index'));
    }

    /** @test */
    public function testSuccessfulDeleteDrug(): void
    {
        $drug = Drug::factory()->create();
        $this->delete(route('drugs.destroy', ['drug' => $drug->id]))
            ->assertStatus(302)
            ->assertRedirect(route('drugs.index'));
    }

    /** @test */
    public function testSuccessfulShowDrug(): void
    {
        $drug = Drug::factory()->create();
        $this->get(route('drugs.show', ['drug' => $drug->id]))
            ->assertStatus(200)
            ->assertViewHas('drug', $drug)
            ->assertSeeText($drug->name)
            ->assertViewIs('drugs.show');
    }
}
