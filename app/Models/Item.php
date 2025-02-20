<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'name',
        'cost',
        'price',
        'is_active',
        'category_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'cost' => 'integer',
        'price' => 'integer'
    ];

    public function category() //modification du function categories en category
    {
        return $this->belongsTo(Category::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
