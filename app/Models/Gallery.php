<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'gallery_name'
    ];

    public function getGalleryImages()
    {
        return $this->hasMany(GalleryImage::class,'gallery_id','id');
    }
}
