<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(required={"name", "price", "manufacturer_id", "ingredient_id"}, @OA\Xml(name="Drug"))
 */
class Drug extends Model
{
    use HasFactory;

    protected $table = 'drugs';

    /**
     * @OA\Property(
     *     format="int64",
     *     description="ID",
     *     example=5
     * )
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     description="Name",
     *     example="Schuyler Daugherty"
     * )
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *      title="Price",
     *      description="Price of drug",
     *      format="int64",
     *      example="7"
     * )
     * @var integer
     */
    private $price;

    /**
     * @OA\Property(
     *      title="Ingredient ID",
     *      description="Ingredient's id",
     *      format="int64",
     *      example="1"
     * )
     * @var integer
     */
    private $ingredient_id;

    /**
     * @OA\Property(
     *      title="Manufacturer ID",
     *      description="Manufacturer's id",
     *      format="int64",
     *      example="9"
     * )
     * @var integer
     */
    private $manufacturer_id;

    /**
     * @OA\Property(
     *      title="Create Date",
     *      description="Create Date",
     *      example="2021-02-13T10:36:05.000000Z"
     * )
     * @var string
     */
    private $created_at;

    /**
     * @OA\Property(
     *      title="Update Date",
     *      description="Update Date",
     *      example="2021-02-13T10:36:05.000000Z"
     * )
     * @var string
     */
    private $updated_at;

    public function ingredient()
    {
        return $this->hasOne(Ingredient::class);
    }

    public function manufacturer()
    {
        return $this->hasOne(Manufacturer::class);
    }
}
