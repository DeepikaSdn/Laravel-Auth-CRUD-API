<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category', 'parent_id', 'status',
    ];

    public function products()
{
    return $this->belongsToMany(Product::class);
}

}
