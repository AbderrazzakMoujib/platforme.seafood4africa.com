<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','icon'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user');
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

