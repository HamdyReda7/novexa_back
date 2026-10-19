<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image',
        'link',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // العلاقة مع الكاتيجوري
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
