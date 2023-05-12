<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'image', 'quantity', 'status','price',
    ];

    protected $appends=['image_url'];
    public function getImageUrlAttribute(){
        if($this->image){
            return FacadesStorage::disk('public')->url('product/'.$this->image);
        }
       
       
    }

    public function categories()
{
    return $this->belongsToMany(Category::class);
}

}
