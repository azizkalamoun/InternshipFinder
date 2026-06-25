<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_company',
        'adresse',
        'logo_img',
        'language',
        'description',
        'phone',
        'email',
        'full_location',
        'linked_in_name',
        'website',
        'rating',
    ];

    // Relation avec la table 'images'
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
