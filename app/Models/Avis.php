<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = 'avis';
    public $timestamps = false;
    protected $fillable = [
        'id_client',
        'id_restaurant',
        'avis',
        'note',
        'rep_avis',
        'date',
    ];

    // Optionnel : relation vers le restaurant
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant');
    }

    // Optionnel : relation vers le client
    public function client()
    {
        return $this->belongsTo(User::class, 'id_client');
    }
}
