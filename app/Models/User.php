<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @OA\Schema(
 *     title="User",
 *     required={"name", "email", "password"},
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

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
     *      title="Name",
     *      description="Name",
     *      example="Schuyler Daugherty"
     * )
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email",
     *      example="heidenreich.effie@beahan.com"
     * )
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password"
     * )
     * @var string
     */
    private $password;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
