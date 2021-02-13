<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="Manufacturer Resource",
 *     description="Manufacturer resource",
 *     @OA\Xml(
 *         name="ManufacturerResource"
 *     )
 * )
 */
class ManufacturerResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Models\Manufacturer[]
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
