<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Drug extends Model
{
    use HasFactory;

    protected $table = 'drugs';

    public function ingredient()
    {
        return $this->hasOne(Ingredient::class);
    }

    public function manufacturer()
    {
        return $this->hasOne(Manufacturer::class);
    }
}
