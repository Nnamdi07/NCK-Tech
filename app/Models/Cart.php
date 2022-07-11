<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillabale = [
        'inventory_id',
        'quantity',
        'price',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function inventory(){
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }


}
