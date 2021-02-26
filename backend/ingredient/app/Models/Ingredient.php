<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public $timestamps = false;

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'measure',
        'supplier',
        'quantity'
    ];
    public function recipes() {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients')->withPivot('amount');
    }
}
