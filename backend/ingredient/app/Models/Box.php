<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delivery_date',
    ];
    public $timestamps = false;

    use HasFactory;
    public function recipes() {
        return $this->belongsToMany(Recipe::class, 'box_recipies');
    }
}
