<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Manufacturer",
 *     required={"name", "link"},
 *     @OA\Xml(
 *         name="Manufacturer"
 *     )
 * )
 */
class Manufacturer extends Model
{
    use HasFactory;

    protected $table = 'manufacturers';

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
     *     description="Link",
     *     example="heidenreich.effie@beahan.com"
     * )
     * @var string
     */
    private $link;

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
