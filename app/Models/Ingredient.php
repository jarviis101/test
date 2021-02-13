<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(required={"name"}, @OA\Xml(name="Ingredient"))
 */
class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    /**
     * @OA\Property(
     *     format="int64",
     *     description="ID",
     *     example=5
     * )
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     description="Name",
     *     example="Schuyler Daugherty"
     * )
     * @var string
     */
    public $name;

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

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
