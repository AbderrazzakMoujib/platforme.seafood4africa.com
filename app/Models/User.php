<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;
use App\Models\Country;
use App\Models\Resource;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    

protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'role',
    'raison_social',
    'forme_juridique',
    'activites_principales',
    'adresse',
    'fax',
    'site_web',
    'nom_responsable',
    'titre_responsable',
    'date_creation',
    'chiffre_affaire', 
    'country_id', 
    'category_id',
    'description',
    'profile_picture',
    'background_image',
    'status',
];


    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Check if the user is an admin — uses the 'role' field (single source of truth)
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function pdfs()
    {
        return $this->hasMany(Pdf::class);
    }

    // Define relationship with Images
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Define relationship with Audios
    public function audios()
    {
        return $this->hasMany(Audio::class);
    }

    // Define relationship with Videos
    public function videos()
    {
        return $this->hasMany(Video::class);
    }


}
