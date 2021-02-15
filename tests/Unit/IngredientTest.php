<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Ingredient;

class IngredientTest extends TestCase
{
    /** @test */
    public function testSuccessfulIndexIngredient(): void
    {
        $ingredients = Ingredient::orderBy('created_at', 'DESC')->get();
        $this->get(route('ingredients.index'))
            ->assertStatus(200)
            ->assertViewHas('ingredients', $ingredients)
            ->assertViewIs('ingredients.index');
    }

    /** @test */
    public function testSuccessfulCreateIngredient(): void
    {
        $data = [
            'name' => 'TestIngredient'
        ];
        $this->post(route('ingredients.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('ingredients.index'));
    }

    /** @test */
    public function testSuccessfulUpdateIngredient(): void
    {
        $ingredient = Ingredient::factory()->create();
        $this->put(
            route('ingredients.update', ['ingredient' => $ingredient->id]),
            [
                'name' => 'TestChangedName'
            ]
        )->assertStatus(302)
        ->assertRedirect(route('ingredients.index'));
    }

    /** @test */
    public function testSuccessfulDeleteIngredient(): void
    {
        $ingredient = Ingredient::factory()->create();
        $this->delete(route('ingredients.destroy', ['ingredient' => $ingredient->id]))
            ->assertStatus(302)
            ->assertRedirect(route('ingredients.index'));
    }

    /** @test */
    public function testSuccessfulShowIngredient(): void
    {
        $ingredient = Ingredient::factory()->create();
        $this->get(route('ingredients.show', ['ingredient' => $ingredient->id]))
            ->assertStatus(200)
            ->assertViewHas('ingredient', $ingredient)
            ->assertSeeText($ingredient->name)
            ->assertViewIs('ingredients.show');
    }
}
