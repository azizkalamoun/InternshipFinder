<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'company_id',
        'image_path',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
