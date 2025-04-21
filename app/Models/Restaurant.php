<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table = "restaurants";

    protected $fillable = [
        "name",
        "restaurateur_id",
        "employe_id"
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    
    public function restaurateur()
    {
        return $this->belongsTo(User::class, 'restaurateur_id');
    }
    
    public function employe()
    {
        return $this->belongsTo(User::class, 'employe_id');
    }
}
