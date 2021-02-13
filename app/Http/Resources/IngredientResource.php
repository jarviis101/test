<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="Ingredient Resource",
 *     description="Ingredient resource",
 *     @OA\Xml(
 *         name="IngredientResource"
 *     )
 * )
 */
class IngredientResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Models\Ingredient[]
     */
    private $data;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
